<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use function BaseCodeOy\Support\Functions\int_normalize;

it('returns null for empty input', function (): void {
    expect(int_normalize(''))->toBeNull();
});

it('returns null for non-numeric input', function (): void {
    expect(int_normalize('abc'))->toBeNull();
});

it('returns an integer for numeric input', function (): void {
    expect(int_normalize('123'))->toBe(123);
    expect(int_normalize(123))->toBe(123);
    expect(int_normalize('123.45'))->toBe(123);
    expect(int_normalize('123,45'))->toBe(123);
});

it('trims the input before conversion', function (): void {
    expect(int_normalize(' 123 '))->toBe(123);
});

it('handles comma as decimal separator', function (): void {
    expect(int_normalize('123,45'))->toBe(123);
});

it('handles dot as decimal separator', function (): void {
    expect(int_normalize('123.45'))->toBe(123);
});

it('returns null for input with only whitespace', function (): void {
    expect(int_normalize('    '))->toBeNull();
});

it('returns null for input with special characters', function (): void {
    expect(int_normalize('@#&'))->toBeNull();
});
