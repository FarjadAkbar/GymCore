<?php

namespace App\Support\Website;

use App\Enums\Status;
use App\Helpers\Helpers;
use App\Models\Plan;
use App\Support\Data;
use Illuminate\Support\Facades\Storage;

final class WebsiteContext
{
    private function __construct() {}

    /**
     * @return array<string, mixed>
     */
    public static function shared(): array
    {
        $settings = Helpers::getSettings();
        $general = is_array($settings['general'] ?? null) ? $settings['general'] : [];

        $gymName = Data::string($general['gym_name'] ?? '') ?: 'Gymie';
        $logoPath = Data::nullableString($general['gym_logo'] ?? null);
        $hasCustomLogo = filled($logoPath);

        return [
            'gymName' => $gymName,
            'gymEmail' => Data::nullableString($general['gym_email'] ?? null),
            'gymContact' => Data::nullableString($general['gym_contact'] ?? null),
            'gymAddress' => Data::nullableString($general['address'] ?? null),
            'hasCustomLogo' => $hasCustomLogo,
            'logoUrl' => $hasCustomLogo ? Storage::disk('public')->url($logoPath) : null,
            'plans' => Plan::query()
                ->where('status', Status::Active)
                ->orderBy('amount')
                ->get(),
        ];
    }
}
