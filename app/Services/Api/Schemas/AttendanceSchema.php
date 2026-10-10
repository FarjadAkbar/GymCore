<?php

namespace App\Services\Api\Schemas;

use App\Models\MemberAttendance;

final class AttendanceSchema
{
    private function __construct() {}

    /**
     * @return array{
     *   searchable: list<string>,
     *   sortable: list<string>,
     *   default_sort: string,
     *   status_column: string|null,
     *   includes: list<string>,
     *   filters: array<string, array{type: string, column: string}>
     * }
     */
    public static function queryRules(): array
    {
        return [
            'searchable' => ['device_user_id', 'device_serial'],
            'sortable' => ['id', 'punched_at', 'created_at'],
            'default_sort' => '-punched_at',
            'status_column' => null,
            'includes' => ['member'],
            'filters' => [
                'member_id' => ['type' => 'exact', 'column' => 'member_id'],
                'source' => ['type' => 'exact', 'column' => 'source'],
                'punched_at' => ['type' => 'datetime_range', 'column' => 'punched_at'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function resource(MemberAttendance $attendance): array
    {
        return [
            'id' => (int) $attendance->id,
            'member_id' => $attendance->member_id,
            'device_user_id' => $attendance->device_user_id,
            'punched_at' => $attendance->punched_at->toISOString(),
            'direction' => $attendance->direction,
            'device_serial' => $attendance->device_serial,
            'verify_type' => $attendance->verify_type,
            'status_code' => $attendance->status_code,
            'source' => $attendance->source,
            'created_at' => $attendance->created_at?->toISOString(),
        ];
    }
}
