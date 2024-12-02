<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use function BaseCodeOy\Support\Functions\str_between;
use function BaseCodeOy\Support\Functions\str_contains_asian_characters;
use function BaseCodeOy\Support\Functions\str_contains_insensitive;
use function BaseCodeOy\Support\Functions\str_truncate;

it('truncates a string correctly', function (): void {
    expect(str_truncate('Hello, World!', 5))->toBe('Hello');
    expect(str_truncate('Hello, World!', 0))->toBe('');
    expect(str_truncate('Hello', 10))->toBe('Hello');
});

it('returns null for empty or null input in str_truncate', function (): void {
    expect(str_truncate('', 5))->toBeNull();
    expect(str_truncate(null, 5))->toBeNull();
});

it('detects Asian characters in a string', function (): void {
    expect(str_contains_asian_characters('Hello'))->toBeFalse();
    expect(str_contains_asian_characters('こんにちは'))->toBeTrue(); // Japanese
    expect(str_contains_asian_characters('你好'))->toBeTrue(); // Chinese
    expect(str_contains_asian_characters('안녕하세요'))->toBeTrue(); // Korean
});

it('returns false for empty or null input in str_contains_asian_characters', function (): void {
    expect(str_contains_asian_characters(''))->toBeFalse();
    expect(str_contains_asian_characters(null))->toBeFalse();
});

it('performs case-insensitive substring search', function (): void {
    expect(str_contains_insensitive('Hello, World!', 'hello'))->toBeTrue();
    expect(str_contains_insensitive('Hello, World!', 'WORLD'))->toBeTrue();
    expect(str_contains_insensitive('Hello, World!', 'test'))->toBeFalse();
});

it('returns false if needle is not found in str_contains_insensitive', function (): void {
    expect(str_contains_insensitive('Hello, World!', 'xyz'))->toBeFalse();
});

it('returns true if haystack contains start and end in correct order', function (): void {
    expect(str_between('hello world', 'hello', 'world'))->toBeTrue();
    expect(str_between('abcde', 'a', 'e'))->toBeTrue();
    expect(str_between('this is a test', 'this', 'test'))->toBeTrue();
});

it('returns false if haystack does not contain start', function (): void {
    expect(str_between('hello world', 'hi', 'world'))->toBeFalse();
    expect(str_between('abcde', 'f', 'e'))->toBeFalse();
});

it('returns false if haystack does not contain end', function (): void {
    expect(str_between('hello world', 'hello', 'planet'))->toBeFalse();
    expect(str_between('abcde', 'a', 'f'))->toBeFalse();
});

it('returns false if start comes after end', function (): void {
    expect(str_between('hello world', 'world', 'hello'))->toBeFalse();
    expect(str_between('abcde', 'e', 'a'))->toBeFalse();
});
