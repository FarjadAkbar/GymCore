<?php

namespace App\Filament\Widgets\Analytics;

use App\Filament\Resources\MemberAttendances\MemberAttendanceResource;
use App\Models\MemberAttendance;
use App\Support\AppConfig;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class RecentAttendanceTableWidget extends TableWidget
{
    protected static ?int $sort = -34;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 2,
    ];

    public static function canView(): bool
    {
        return MemberAttendanceResource::canViewAny();
    }

    public function table(Table $table): Table
    {
        $timezone = AppConfig::timezone();
        $today = Carbon::today($timezone);

        return $table
            ->paginated(false)
            ->heading(__('app.widgets.recent_attendance'))
            ->description(__('app.widgets.recent_attendance_description'))
            ->headerActions([
                \Filament\Actions\Action::make('view_all')
                    ->label(__('app.widgets.view_all_attendance'))
                    ->url(MemberAttendanceResource::getUrl('index'))
                    ->link(),
            ])
            ->query(fn (): Builder => MemberAttendance::query()
                ->with('member')
                ->whereDate('punched_at', $today)
                ->latest('punched_at')
                ->limit(8))
            ->columns([
                TextColumn::make('punched_at')
                    ->label(__('app.fields.punched_at'))
                    ->dateTime()
                    ->timezone($timezone),
                TextColumn::make('member.name')
                    ->label(__('app.fields.member'))
                    ->placeholder(__('app.attendance.unmatched_member'))
                    ->searchable(),
                TextColumn::make('device_user_id')
                    ->label(__('app.fields.attendance_device_user_id'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('direction')
                    ->label(__('app.fields.direction'))
                    ->badge()
                    ->placeholder('—'),
                TextColumn::make('source')
                    ->label(__('app.fields.source'))
                    ->badge(),
            ])
            ->emptyStateHeading(__('app.widgets.no_attendance_today'))
            ->emptyStateDescription(__('app.widgets.no_attendance_today_hint'));
    }
}
