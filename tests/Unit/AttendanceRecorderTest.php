<?php

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use App\Models\MemberAttendance;
use App\Services\Attendance\AttendanceRecorder;
use Illuminate\Support\Carbon;

it('links a punch to a member by device user id', function (): void {
    $member = Member::factory()->create([
        'attendance_device_user_id' => '1001',
    ]);

    $attendance = app(AttendanceRecorder::class)->record(
        deviceUserId: '1001',
        punchedAt: Carbon::parse('2026-10-04 09:00:00'),
        source: 'zkteco',
    );

    expect($attendance->member_id)->toBe($member->id);
});

it('dedupes punches within the configured window', function (): void {
    config(['attendance.dedupe_minutes' => 15]);

    $member = Member::factory()->create([
        'attendance_device_user_id' => '2002',
    ]);

    $recorder = app(AttendanceRecorder::class);

    $first = $recorder->record('2002', Carbon::parse('2026-10-04 10:00:00'), 'zkteco');
    $second = $recorder->record('2002', Carbon::parse('2026-10-04 10:05:00'), 'zkteco');

    expect(MemberAttendance::count())->toBe(1)
        ->and($second->id)->toBe($first->id);
});
