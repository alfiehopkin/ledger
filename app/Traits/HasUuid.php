<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    public function getIncrementing() { return false; }
    public function getKeyType() { return 'string'; }

    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}