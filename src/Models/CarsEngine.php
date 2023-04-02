<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsEngine as CarsEngineContract;
use Avangard\CarsStructure\Contracts\HasManyCars;
use Avangard\CarsStructure\Contracts\Published;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsEngine extends UuidModel implements CarsEngineContract, HasManyCars, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_ENGINES;

    protected $casts = [
        'volume'     => 'integer',
        'horsepower' => 'integer',
        'torque'     => 'integer',
    ];

    protected $fillable = [
        'uuid',
        'volume',
        'horsepower',
        'torque',
        'cars_mark_uuid',
        'cars_engine_type_uuid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mark(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsMark'), 'cars_mark_uuid');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsEngineType'), 'cars_engine_type_uuid');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(config('cars_structure.car'), 'cars_engine_uuid');
    }
}
