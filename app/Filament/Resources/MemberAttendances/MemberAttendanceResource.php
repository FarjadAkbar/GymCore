<?php

namespace App\Filament\Resources\MemberAttendances;

use App\Filament\Resources\MemberAttendances\Pages\ListMemberAttendances;
use App\Filament\Resources\MemberAttendances\Tables\MemberAttendanceTable;
use App\Models\MemberAttendance;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class MemberAttendanceResource extends Resource
{
    protected static ?string $model = MemberAttendance::class;

    public static function getModelLabel(): string
    {
        return __('app.resources.member_attendances.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.resources.member_attendances.plural');
    }

    public static function getNavigationLabel(): string
    {
        return static::getPluralModelLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.navigation.groups.memberships');
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function table(Table $table): Table
    {
        return MemberAttendanceTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemberAttendances::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
