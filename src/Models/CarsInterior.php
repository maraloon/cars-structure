<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\HasManyCars;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Basename;
use Avangard\CarsStructure\ValueObjects\Types\Code;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsInterior extends UuidModel implements HasManyCars, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_INTERIORS;

    protected $casts = [
        'code'     => Code::class,
        'title'    => Title::class,
        'basename' => Basename::class,
    ];

    protected $fillable = [
        'uuid',
        'code',
        'title',
        'basename',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(config('cars_structure.car'), 'cars_interior_uuid');
    }
}
