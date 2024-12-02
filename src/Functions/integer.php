<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

if (!\function_exists('int_normalize')) {
    function int_normalize(mixed $number): ?int
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

        return (int) $number;
    }
}
