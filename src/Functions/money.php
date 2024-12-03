<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

use Brick\Money\Money;

if (!\function_exists('money')) {
    function money(string $amount, string $currency): Money
    {
        return Money::of($amount, $currency);
    }
}

if (!\function_exists('money_minor')) {
    function money_minor(string $amount, string $currency): Money
    {
        return Money::ofMinor($amount, $currency);
    }
}

if (!\function_exists('money_format')) {
    function money_format(Money $money, string $locale): string
    {
        return $money->formatTo($locale);
    }
}
