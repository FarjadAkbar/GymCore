<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm;
use App\Helpers\Helpers;
use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;

class MemberForm
{
    /**
     * Configure the member form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('code')
                                    ->placeholder(__('app.placeholders.member_code'))
                                    ->label(__('app.fields.member_code'))
                                    ->required()
                                    ->readOnly()
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(fn (Get $get) => Helpers::generateLastNumber(
                                        'member',
                                        Member::class,
                                        null,
                                        'code'
                                    )),
                                TextInput::make('attendance_device_user_id')
                                    ->label(__('app.fields.attendance_device_user_id'))
                                    ->helperText(__('app.helpers.attendance_device_user_id'))
                                    ->maxLength(64)
                                    ->unique('members', 'attendance_device_user_id', ignoreRecord: true),
                                TextInput::make('name')
                                    ->label(__('app.fields.full_name'))
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('app.placeholders.example_full_name'))
                                    ->columnSpan(2),
                                TextInput::make('father_name')
                                    ->label(__('app.fields.father_name'))
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label(__('app.fields.email'))
                                    ->email()
                                    ->nullable()
                                    ->markAsRequired(false)
                                    ->live()
                                    ->maxLength(255)
                                    ->placeholder(__('app.placeholders.example_email'))
                                    ->unique('members', 'email', ignoreRecord: true)
                                    ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? $state : null),
                                TextInput::make('contact')
                                    ->label(__('app.fields.contact'))
                                    ->tel()
                                    ->maxLength(20)
                                    ->regex('/^\+?[0-9\s\-\(\)]+$/') // Allows +, digits, spaces, dashes, and parentheses
                                    ->required()
                                    ->hintIcon('heroicon-m-question-mark-circle')
                                    ->hintIconTooltip(__('app.help.phone_format')),
                                TextInput::make('emergency_contact')
                                    ->label(__('app.fields.emergency_contact'))
                                    ->tel()
                                    ->maxLength(20)
                                    ->regex('/^\+?[0-9\s\-\(\)]+$/') // Allows +, digits, spaces, dashes, and parentheses
                                    ->hintIcon('heroicon-m-question-mark-circle')
                                    ->hintIconTooltip(__('app.help.phone_format')),
                                Radio::make('gender')
                                    ->options([
                                        'male' => __('app.options.gender.male'),
                                        'female' => __('app.options.gender.female'),
                                        'other' => __('app.options.gender.other'),
                                    ])
                                    ->label(__('app.fields.gender'))
                                    ->default('male')
                                    ->inline()
                                    ->inlineLabel(false),
                                DatePicker::make('dob')
                                    ->label(__('app.fields.dob'))
                                    ->placeholder(__('app.placeholders.date_example')),
                                TextInput::make('health_issue')
                                    ->label(__('app.fields.health_issues'))
                                    ->maxLength(500)
                                    ->placeholder(__('app.placeholders.health_issues')),
                                Select::make('source')
                                    ->options([
                                        'promotions' => __('app.options.source.promotions'),
                                        'word_of_mouth' => __('app.options.source.word_of_mouth'),
                                        'others' => __('app.options.source.others'),
                                    ])->default('promotions')
                                    ->label(__('app.fields.source'))
                                    ->selectablePlaceholder(false),
                                Select::make('goal')
                                    ->options([
                                        'fitness' => __('app.options.goal.fitness'),
                                        'body_building' => __('app.options.goal.body_building'),
                                        'fatloss' => __('app.options.goal.fatloss'),
                                        'weightgain' => __('app.options.goal.weightgain'),
                                        'others' => __('app.options.goal.others'),
                                    ])->default('fitness')
                                    ->label(__('app.fields.goal'))
                                    ->selectablePlaceholder(false),
                            ])->columns(3)->columnSpan(3),
                    ])->columns(4),
                Section::make(__('app.titles.subscription_and_invoice'))
                    ->visibleOn('create')
                    ->schema([
                        Repeater::make('subscriptions')
                            ->relationship('subscriptions')
                            ->itemLabel('')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->maxItems(1)
                            ->deletable(false)
                            ->extraAttributes(['class' => 'rmv_rept-space'])
                            ->columns(3)
                            ->schema(fn (HasSchemas&Component $livewire): array => SubscriptionForm::configure(Schema::make($livewire))
                                ->getComponents(withActions: false)),
                    ]),
            ]);
    }
}
