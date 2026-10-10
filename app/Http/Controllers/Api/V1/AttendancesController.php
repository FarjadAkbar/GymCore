<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\AttendanceResource;
use App\Models\MemberAttendance;
use App\Services\Api\QueryFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttendancesController extends ApiController
{
    private const RESOURCE_KEY = 'attendances';

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->requirePermission($request, 'ViewAny:MemberAttendance');

        $query = MemberAttendance::query()->with('member');

        QueryFilters::applyIndexFilters($query, $request, self::RESOURCE_KEY);

        $perPage = QueryFilters::perPage($request);

        return AttendanceResource::collection($query->paginate($perPage));
    }

    public function show(Request $request, MemberAttendance $attendance): AttendanceResource
    {
        $this->requirePermission($request, 'View:MemberAttendance');

        $attendance->loadMissing('member');

        return new AttendanceResource($attendance);
    }
}
