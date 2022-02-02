<?php

namespace FaarenTech\LaravelCustomUuids\Models;

use FaarenTech\LaravelCustomUuids\Helpers\UuidHelper;
use FaarenTech\LaravelCustomUuids\Interfaces\HasCustomUuidInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class UuidModel extends BaseModel
{
    protected $primaryKey = "uuid";
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function (HasCustomUuidInterface $model) {
            $model->attributes['uuid'] = UuidHelper::getUuidForModel($model);
        });
    }
}
