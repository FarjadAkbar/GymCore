<?php

namespace App\Filament\Resources\MemberAttendances\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MemberAttendanceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('punched_at', 'desc')
            ->columns([
                TextColumn::make('punched_at')
                    ->label(__('app.fields.punched_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('member.name')
                    ->label(__('app.fields.member'))
                    ->searchable()
                    ->placeholder(__('app.attendance.unmatched_member')),
                TextColumn::make('device_user_id')
                    ->label(__('app.fields.attendance_device_user_id'))
                    ->searchable()
                    ->copyable(),
                TextColumn::make('direction')
                    ->label(__('app.fields.direction'))
                    ->badge()
                    ->placeholder('—'),
                TextColumn::make('source')
                    ->label(__('app.fields.source'))
                    ->badge(),
                TextColumn::make('device_serial')
                    ->label(__('app.fields.device_serial'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('source')
                    ->label(__('app.fields.source'))
                    ->options([
                        'zkteco' => 'ZKTeco',
                        'api' => 'API',
                        'manual' => __('app.attendance.source_manual'),
                    ]),
            ]);
    }
}
