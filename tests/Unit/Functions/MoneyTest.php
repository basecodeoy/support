<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Brick\Money\Money;
use function BaseCodeOy\Support\Functions\money;
use function BaseCodeOy\Support\Functions\money_format;
use function BaseCodeOy\Support\Functions\money_minor;

test('money function returns a Money object', function (): void {
    $amount = '100.00';
    $currency = 'USD';

    $money = money($amount, $currency);

    expect($money)->toBeInstanceOf(Money::class);
    expect($money->getAmount()->toInt())->toBe((int) $amount);
    expect($money->getCurrency()->getCurrencyCode())->toBe($currency);
});

test('money_minor function returns a Money object', function (): void {
    $amount = '10000'; // 100.00 in minor units
    $currency = 'USD';

    $money = money_minor($amount, $currency);

    expect($money)->toBeInstanceOf(Money::class);
    expect($money->getMinorAmount()->toInt())->toBe((int) $amount);
    expect($money->getCurrency()->getCurrencyCode())->toBe($currency);
});

test('money_format function formats money object to locale', function (): void {
    $amount = '100.00';
    $currency = 'USD';
    $locale = 'en_US';

    $money = Money::of($amount, $currency);
    $formatted = money_format($money, $locale);

    expect($formatted)->toMatchSnapshot();
});

test('money_format handles different locales correctly', function (): void {
    $amount = '1000.00';
    $currency = 'EUR';
    $locale = 'de_DE';

    $money = Money::of($amount, $currency);
    $formatted = money_format($money, $locale);

    expect($formatted)->toMatchSnapshot();
});

test('money_format handles different currencies and locales', function (): void {
    $amount = '1000.00';
    $currency = 'JPY';
    $locale = 'ja_JP';

    $money = Money::of($amount, $currency);
    $formatted = money_format($money, $locale);

    expect($formatted)->toMatchSnapshot();
});
