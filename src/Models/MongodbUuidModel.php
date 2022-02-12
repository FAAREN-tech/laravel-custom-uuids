<?php

namespace FaarenTech\LaravelCustomUuids\Models;

use FaarenTech\LaravelCustomUuids\Helpers\UuidHelper;
use FaarenTech\LaravelCustomUuids\Interfaces\HasCustomUuidInterface;
use Jenssegers\Mongodb\Eloquent\Model as BaseModel;

abstract class MongodbUuidModel extends BaseModel
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
