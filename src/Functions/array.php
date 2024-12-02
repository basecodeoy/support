<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

if (!\function_exists('arr_filter_recursive')) {
    /**
     * @param  array<mixed, mixed> $array
     * @return array<mixed, mixed>
     */
    function arr_filter_recursive(array $array, ?\Closure $callback = null, bool $remove_empty_arrays = false): array
    {
        foreach ($array as $key => &$value) { // create reference
            if (\is_array($value)) {
                $value = \call_user_func_array(__FUNCTION__, [$value, $callback, $remove_empty_arrays]);

                if ($remove_empty_arrays && !(bool) $value) {
                    unset($array[$key]);
                }
            } elseif ($callback instanceof \Closure && !$callback($value)) {
                unset($array[$key]);
            } elseif (!(bool) $value) {
                // We don't want to remove `false` values...
                if (\is_bool($value)) {
                    continue;
                }

                // We don't want to remove 0 values...
                if (\is_numeric($value) && $value === 0) {
                    continue;
                }

                unset($array[$key]);
            }
        }

        unset($value); // destroy reference

        return $array;
    }
}

if (!\function_exists('arr_normalize')) {
    /**
     * @return array<int|string, mixed>
     */
    function arr_normalize(mixed $value): array
    {
        if (\is_array($value)) {
            return $value;
        }

        if (\is_object($value)) {
            /** @var array<int|string, mixed> */
            return \json_decode(
                \json_encode($value, \JSON_THROW_ON_ERROR),
                true,
                512,
                \JSON_THROW_ON_ERROR,
            );
        }

        throw new \InvalidArgumentException('Value must be an array or an object');
    }
}

if (!\function_exists('arr_trim')) {
    /**
     * @param  array<mixed>   $array
     * @return array < mixed>
     */
    function arr_trim(array $array): array
    {
        return \array_map(
            fn ($value): mixed => match (true) {
                \is_array($value) => arr_trim($value),
                \is_string($value) => \trim($value),
                default => $value,
            },
            $array,
        );
    }
}
