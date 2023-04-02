<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsCategory as CarsCategoryContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsCategory extends UuidModel implements CarsCategoryContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_CATEGORIES;

    protected $casts = [
        'title' => TitleRu::class,
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

    public function models(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsModel'), 'cars_category_uuid');
    }
}
