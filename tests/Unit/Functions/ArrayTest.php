<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use function BaseCodeOy\Support\Functions\arr_filter_recursive;
use function BaseCodeOy\Support\Functions\arr_normalize;
use function BaseCodeOy\Support\Functions\arr_trim;

it('filters array recursively', function (): void {
    $array = [
        'a' => 1,
        'b' => '',
        'c' => [
            'd' => 0,
            'e' => false,
            'f' => '',
            'g' => null,
        ],
        'h' => null,
    ];

    $filtered = arr_filter_recursive($array);
    expect($filtered)->toBe([
        'a' => 1,
        'c' => [
            'd' => 0,
            'e' => false,
        ],
    ]);
});

it('filters array recursively with callback', function (): void {
    $array = [
        'a' => 1,
        'b' => 2,
        'c' => [
            'd' => 3,
            'e' => 4,
        ],
        'f' => 5,
    ];

    $filtered = arr_filter_recursive($array, fn ($value): bool => $value % 2 === 0);
    expect($filtered)->toBe([
        'b' => 2,
        'c' => [
            'e' => 4,
        ],
    ]);
});

it('removes empty arrays if specified', function (): void {
    $array = [
        'a' => [
            'b' => [],
        ],
        'c' => [
            'd' => '',
        ],
    ];

    $filtered = arr_filter_recursive($array, null, true);
    expect($filtered)->toBe([]);
});

it('normalizes an array', function (): void {
    $object = (object) ['a' => 1, 'b' => 2];
    $normalized = arr_normalize($object);
    expect($normalized)->toBe(['a' => 1, 'b' => 2]);

    $array = ['c' => 3, 'd' => 4];
    $normalized = arr_normalize($array);
    expect($normalized)->toBe($array);
});

it('throws an exception if value is not an array or object in arr_normalize', function (): void {
    expect(fn (): array => arr_normalize('string'))->toThrow(InvalidArgumentException::class);
});

it('trims strings in an array', function (): void {
    $array = [
        'a' => '  hello  ',
        'b' => '  world',
        'c' => [
            'd' => 'test  ',
            'e' => '   ',
        ],
        'f' => 123,
    ];

    $trimmed = arr_trim($array);
    expect($trimmed)->toBe([
        'a' => 'hello',
        'b' => 'world',
        'c' => [
            'd' => 'test',
            'e' => '',
        ],
        'f' => 123,
    ]);
});
