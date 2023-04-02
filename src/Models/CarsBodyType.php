<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsBodyType as CarsBodyTypeContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\Traits\SetAttribute;
use Avangard\CarsStructure\Traits\SetSlugAttribute;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsBodyType extends UuidModel implements CarsBodyTypeContract, Published
{
    use SoftDeletes, SetAttribute, SetSlugAttribute;

    protected $table = Tables::CARS_BODY_TYPES;

    protected $casts = [
        'title' => TitleRu::class,
    ];

    protected $fillable = [
        'uuid',
        'title',
        'slug',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bodies(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsBody'));
    }
}
