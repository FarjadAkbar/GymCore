<?php

namespace App\Filament\Resources\MemberAttendances\Pages;

use App\Filament\Resources\MemberAttendances\MemberAttendanceResource;
use Filament\Resources\Pages\ListRecords;

class ListMemberAttendances extends ListRecords
{
    protected static string $resource = MemberAttendanceResource::class;

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.memberships'),
            MemberAttendanceResource::getNavigationLabel(),
        ];
    }
}
