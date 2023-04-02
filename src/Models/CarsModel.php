<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsModel as CarsModelContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\Traits\SetAttribute;
use Avangard\CarsStructure\Traits\SetSlugAttribute;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsModel extends UuidModel implements CarsModelContract, Published
{
    use SoftDeletes, SetAttribute, SetSlugAttribute;

    protected $table = Tables::CARS_MODELS;

    protected $casts = [
        'title' => Title::class,
    ];

    protected $fillable = [
        'uuid',
        'slug',
        'title',
        'cars_mark_uuid',
        'cars_category_uuid',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsCategory'), 'cars_category_uuid');
    }

    public function bodies(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsBody'), 'cars_model_uuid');
    }
}
