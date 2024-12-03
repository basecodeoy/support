<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\Functions;

use Illuminate\Support\Carbon;

if (!\function_exists('now_tz')) {
    function now_tz(?string $timeZone = null): Carbon
    {
        if ($timeZone === null || $timeZone === '' || $timeZone === '0') {
            $timeZone = (string) config('app.timezone');
        }

        return now()->setTimezone($timeZone);
    }
}
