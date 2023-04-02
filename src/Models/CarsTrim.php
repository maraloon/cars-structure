<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsTrim as CarsTrimContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\Traits\SetAttribute;
use Avangard\CarsStructure\Traits\SetSlugAttribute;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsTrim extends UuidModel implements CarsTrimContract, Published
{
    use SoftDeletes, SetAttribute, SetSlugAttribute;

    protected $table = Tables::CARS_TRIMS;

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

    public function modifications(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsModification'), 'cars_trim_uuid');
    }
}
