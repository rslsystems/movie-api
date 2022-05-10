<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ModelUuid
{
    /**
     * Override the boot function from Laravel so that
     * we give the model a new UUID when we create it.
     */
    protected static function boot()
    {
        parent::boot();

        $creationCallback = function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        };

        static::creating($creationCallback);
    }

    /**
     * Because it is uuid, does not increment
     * @return bool Always false
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Because it is uuid, does not increment
     * @return string Always 'string'
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
