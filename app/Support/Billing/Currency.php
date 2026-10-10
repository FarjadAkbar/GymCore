<?php

namespace App\Support\Billing;

use App\Support\Data;
use Illuminate\Support\Number;
use NumberFormatter;

/**
 * Currency helpers for formatting and symbol resolution.
 */
final class Currency
{
    private const INR_DISPLAY_SYMBOL = 'Rs.';

    /**
     * Resolve a currency code from settings.
     *
     * @param  array<string, mixed>  $settings
     */
    public static function codeFromSettings(array $settings, string $defaultCode = 'INR'): string
    {
        $general = is_array($settings['general'] ?? null) ? $settings['general'] : [];
        $currency = $general['currency'] ?? null;

        return filled($currency) ? Data::string($currency, $defaultCode) : $defaultCode;
    }

    /**
     * Format a currency value using the app's configured formatting.
     */
    public static function format(?float $value, string $currencyCode): string
    {
        if (self::isInr($currencyCode)) {
            return self::INR_DISPLAY_SYMBOL.Number::format($value ?? 0, maxPrecision: 0);
        }

        return (string) Number::currency($value ?? 0, $currencyCode, null, 0);
    }

    /**
     * Resolve a currency symbol for a currency code.
     */
    public static function symbol(string $currencyCode): string
    {
        if (self::isInr($currencyCode)) {
            return self::INR_DISPLAY_SYMBOL;
        }

        $formatter = new NumberFormatter('en'."@currency={$currencyCode}", NumberFormatter::CURRENCY);

        return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL) ?: '';
    }

    private static function isInr(string $currencyCode): bool
    {
        return strtoupper($currencyCode) === 'INR';
    }
}
