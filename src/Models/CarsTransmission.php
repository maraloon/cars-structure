<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\HasManyCars;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsTransmission extends UuidModel implements HasManyCars, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_TRANSMISSIONS;

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

    public function cars(): HasMany
    {
        return $this->hasMany(config('cars_structure.car'), 'cars_transmission_uuid');
    }
}
