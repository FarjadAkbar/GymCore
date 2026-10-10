<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MemberAttendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberAttendancePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MemberAttendance');
    }

    public function view(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('View:MemberAttendance');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MemberAttendance');
    }

    public function update(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('Update:MemberAttendance');
    }

    public function delete(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('Delete:MemberAttendance');
    }

    public function restore(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('Restore:MemberAttendance');
    }

    public function forceDelete(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('ForceDelete:MemberAttendance');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MemberAttendance');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MemberAttendance');
    }

    public function replicate(AuthUser $authUser, MemberAttendance $memberAttendance): bool
    {
        return $authUser->can('Replicate:MemberAttendance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MemberAttendance');
    }

}