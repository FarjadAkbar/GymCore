<?php

namespace App\Services\Attendance;

use App\Models\Member;
use App\Models\MemberAttendance;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class AttendanceRecorder
{
    /**
     * Record a punch from a biometric device or API.
     *
     * @param  array<string, mixed>  $rawPayload
     */
    public function record(
        string $deviceUserId,
        CarbonInterface $punchedAt,
        string $source,
        ?string $deviceSerial = null,
        ?int $verifyType = null,
        ?int $statusCode = null,
        ?string $direction = null,
        array $rawPayload = [],
    ): MemberAttendance {
        $deviceUserId = trim($deviceUserId);

        if ($this->isDuplicate($deviceUserId, $punchedAt, $deviceSerial)) {
            return MemberAttendance::query()
                ->where('device_user_id', $deviceUserId)
                ->where('punched_at', Carbon::instance($punchedAt))
                ->when(
                    $deviceSerial !== null,
                    fn ($query) => $query->where('device_serial', $deviceSerial)
                )
                ->firstOrFail();
        }

        $member = $this->resolveMember($deviceUserId);

        if ($member !== null && $this->wasRecentlyRecorded($member, $punchedAt)) {
            return MemberAttendance::query()
                ->where('member_id', $member->id)
                ->latest('punched_at')
                ->firstOrFail();
        }

        return MemberAttendance::create([
            'member_id' => $member?->id,
            'device_user_id' => $deviceUserId,
            'punched_at' => $punchedAt,
            'direction' => $direction ?? $this->directionFromStatusCode($statusCode),
            'device_serial' => $deviceSerial,
            'verify_type' => $verifyType,
            'status_code' => $statusCode,
            'source' => $source,
            'raw_payload' => $rawPayload === [] ? null : $rawPayload,
        ]);
    }

    public function resolveMember(string $deviceUserId): ?Member
    {
        foreach ((array) config('attendance.match_member_by', ['attendance_device_user_id', 'code']) as $column) {
            if (! in_array($column, ['attendance_device_user_id', 'code'], true)) {
                continue;
            }

            $member = Member::query()->where($column, $deviceUserId)->first();

            if ($member !== null) {
                return $member;
            }
        }

        return null;
    }

    private function isDuplicate(string $deviceUserId, CarbonInterface $punchedAt, ?string $deviceSerial): bool
    {
        return MemberAttendance::query()
            ->where('device_user_id', $deviceUserId)
            ->where('punched_at', Carbon::instance($punchedAt))
            ->when(
                $deviceSerial !== null,
                fn ($query) => $query->where('device_serial', $deviceSerial)
            )
            ->exists();
    }

    private function wasRecentlyRecorded(Member $member, CarbonInterface $punchedAt): bool
    {
        $dedupeMinutes = max(0, (int) config('attendance.dedupe_minutes', 15));

        if ($dedupeMinutes === 0) {
            return false;
        }

        $latest = MemberAttendance::query()
            ->where('member_id', $member->id)
            ->latest('punched_at')
            ->first();

        if ($latest === null) {
            return false;
        }

        return $latest->punched_at->diffInMinutes(Carbon::instance($punchedAt), absolute: true) < $dedupeMinutes;
    }

    private function directionFromStatusCode(?int $statusCode): ?string
    {
        return match ($statusCode) {
            0 => 'in',
            1 => 'out',
            default => null,
        };
    }
}
