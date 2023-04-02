<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsEngineType as CarsEngineTypeContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsEngineType extends UuidModel implements CarsEngineTypeContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_ENGINE_TYPES;

    protected $casts = [
        'title' => Title::class,
    ];

    protected $fillable = [
        'uuid',
        'title',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function engines(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsEngine'), 'cars_engine_type_uuid');
    }
}
