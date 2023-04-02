<?php


namespace Avangard\CarsStructure\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class UuidModel extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!($model->{$model->primaryKey} ?? false)) {
                $model->{$model->primaryKey} = (string) Str::uuid();
            }
        });

    }

    public function getRouteKeyName()
    {
        return $this->primaryKey;
    }
}
