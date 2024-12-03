<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use function BaseCodeOy\Support\Functions\float_format;
use function BaseCodeOy\Support\Functions\float_normalize;

it('returns null for empty input in float_normalize', function (): void {
    expect(float_normalize(''))->toBeNull();
});

it('returns null for non-numeric input in float_normalize', function (): void {
    expect(float_normalize('abc'))->toBeNull();
});

it('returns a float for numeric input in float_normalize', function (): void {
    expect(float_normalize('123'))->toBe(123.0);
    expect(float_normalize(123))->toBe(123.0);
    expect(float_normalize('123.45'))->toBe(123.45);
    expect(float_normalize('123,45'))->toBe(123.45);
});

it('trims the input before conversion in float_normalize', function (): void {
    expect(float_normalize(' 123 '))->toBe(123.0);
});

it('handles comma as decimal separator in float_normalize', function (): void {
    expect(float_normalize('123,45'))->toBe(123.45);
});

it('handles dot as decimal separator in float_normalize', function (): void {
    expect(float_normalize('123.45'))->toBe(123.45);
});

it('returns null for input with only whitespace in float_normalize', function (): void {
    expect(float_normalize('    '))->toBeNull();
});

it('returns null for input with special characters in float_normalize', function (): void {
    expect(float_normalize('@#&'))->toBeNull();
});

it('formats the number correctly in float_format', function (): void {
    expect(float_format('123.456', 2))->toBe('123.46');
    expect(float_format('123,456', 2))->toBe('123.46');
    expect(float_format('123.4', 2))->toBe('123.40');
    expect(float_format('123', 2))->toBe('123.00');
    expect(float_format(' 123.456 ', 2))->toBe('123.46');
});

it('returns null for invalid input in float_format', function (): void {
    expect(float_format('abc', 2))->toBeNull();
    expect(float_format('', 2))->toBeNull();
    expect(float_format('    ', 2))->toBeNull();
});
