<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

if (!\function_exists('float_normalize')) {
    function float_normalize(mixed $number): ?float
    {
        if (\is_string($number)) {
            $number = \trim($number);
        }

        if (empty($number) && !\is_numeric($number)) {
            return null;
        }

        $number = \str_replace(',', '.', \trim((string) $number));

        if (!\is_numeric($number)) {
            return null;
        }

        return (float) $number;
    }
}

if (!\function_exists('float_normalize')) {
    function float_format(mixed $number, int $decimals): ?string
    {
        $number = float_normalize($number);

        if ($number === null) {
            return null;
        }

        return \number_format(
            num: \round($number, $decimals),
            decimals: $decimals,
            decimal_separator: '.',
            thousands_separator: '',
        );
    }
}
