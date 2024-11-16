<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

if (!\function_exists('str_truncate')) {
    function str_truncate(?string $string, int $limit): ?string
    {
        if (empty($string)) {
            return null;
        }

        return \mb_substr($string, 0, $limit);
    }
}

if (!\function_exists('str_contains_asian_characters')) {
    function str_contains_asian_characters(?string $value): bool
    {
        if (empty($value)) {
            return false;
        }

        return (bool) \preg_match('/\p{Han}|\p{Hiragana}|\p{Katakana}|\p{Hangul}/u', $value);
    }
}

if (!\function_exists('str_contains_insensitive')) {
    function str_contains_insensitive(string $haystack, string $needle): bool
    {
        return \str_contains(\mb_strtolower($haystack), \mb_strtolower($needle));
    }
}

if (!\function_exists('str_between')) {
    function str_between(string $haystack, string $start, string $end): bool
    {
        return \str_starts_with($haystack, $start) && \str_ends_with($haystack, $end);
    }
}
