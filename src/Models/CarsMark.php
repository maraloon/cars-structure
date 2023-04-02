<?php

namespace Avangard\CarsStructure\Models;


use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsMark as CarsMarkContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\Traits\SetAttribute;
use Avangard\CarsStructure\Traits\SetSlugAttribute;
use Avangard\CarsStructure\ValueObjects\Types\TitleEn;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsMark extends UuidModel implements CarsMarkContract, Published
{
    use SoftDeletes, SetAttribute, SetSlugAttribute;

    protected $table = Tables::CARS_MARKS;

    protected $casts = [
        'title'    => TitleEn::class,
        'title_ru' => TitleRu::class,
    ];

    protected $fillable = [
        'uuid',
        'slug',
        'title',
        'title_ru',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsModel'), 'cars_mark_uuid');
    }

    public function engines(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsEngine'));
    }
}
