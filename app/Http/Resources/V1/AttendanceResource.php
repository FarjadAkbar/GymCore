<?php

namespace App\Http\Resources\V1;

use App\Services\Api\Schemas\AttendanceSchema;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\MemberAttendance
 */
class AttendanceResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\MemberAttendance $attendance */
        $attendance = $this->resource;

        return AttendanceSchema::resource($attendance);
    }
}
