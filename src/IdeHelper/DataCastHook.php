<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Support\IdeHelper;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\BaseData;
use Spatie\ModelInfo\ModelInfo;

final class DataCastHook implements ModelHookInterface
{
    #[\Override()]
    public function run(ModelsCommand $modelsCommand, Model $model): void
    {
        $modelInfo = ModelInfo::forModel($model);

        foreach ($modelInfo->attributes as $attribute) {
            if ($attribute->cast !== null && \is_subclass_of($attribute->cast, BaseData::class)) {
                $types = ['\\'.$attribute->cast];

                if ($attribute->nullable) {
                    $types[] = 'null';
                }

                $modelsCommand->setProperty($attribute->name, \implode('|', $types));
            }
        }
    }
}
