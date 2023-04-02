<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsBodyNumber as CarsBodyNumberContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Code;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsBodyNumber extends UuidModel implements CarsBodyNumberContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_BODY_NUMBERS;

    protected $fillable = [
        'uuid',
        'number',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'number' => Code::class,
    ];

    public function bodies(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsBody'));
    }
}
