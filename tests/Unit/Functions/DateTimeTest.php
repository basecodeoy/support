<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Config;
use function BaseCodeOy\Support\Functions\now_tz;

beforeEach(function (): void {
    Config::set('app.timezone', 'UTC');
});

it('returns the current time in the given timezone', function (): void {
    $now = now_tz('America/New_York');

    expect($now->timezone->getName())->toBe('America/New_York');
});

it('returns the current time in the default timezone when no timezone is given', function (): void {
    $now = now_tz();

    expect($now->timezone->getName())->toBe('UTC');
});

it('returns the current time in the configured default timezone when null is passed', function (): void {
    Config::set('app.timezone', 'Asia/Tokyo');

    $now = now_tz(null);

    expect($now->timezone->getName())->toBe('Asia/Tokyo');
});

it('returns the correct time in different timezones', function (): void {
    $utcTime = now()->setTimezone('UTC')->format('Y-m-d H:i');
    $tokyoTime = now_tz('Asia/Tokyo')->format('Y-m-d H:i');
    expect($utcTime)->not()->toBe($tokyoTime);

    $newYorkTime = now_tz('America/New_York')->format('Y-m-d H:i');
    expect($newYorkTime)->not()->toBe($tokyoTime);
});
