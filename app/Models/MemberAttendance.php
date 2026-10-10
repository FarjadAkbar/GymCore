<?php

namespace App\Models;

use Database\Factories\MemberAttendanceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $member_id
 * @property string $device_user_id
 * @property Carbon $punched_at
 * @property string|null $direction
 * @property string|null $device_serial
 * @property int|null $verify_type
 * @property int|null $status_code
 * @property string $source
 * @property array<string, mixed>|null $raw_payload
 * @property-read Member|null $member
 */
class MemberAttendance extends Model
{
    /** @use HasFactory<MemberAttendanceFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'member_id',
        'device_user_id',
        'punched_at',
        'direction',
        'device_serial',
        'verify_type',
        'status_code',
        'source',
        'raw_payload',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'punched_at' => 'datetime',
            'raw_payload' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Member, $this>
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
