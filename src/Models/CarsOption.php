<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsOption as CarsOptionContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Code;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsOption extends UuidModel implements CarsOptionContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_OPTIONS;

    protected $casts = [
        'code'  => Code::class,
        'title' => Title::class,
    ];

    protected $fillable = [
        'uuid',
        'code',
        'title',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsOptionGroup'), 'cars_option_group_uuid');
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(config('cars_structure.car'), Tables::CAR_CARS_OPTION, 'cars_option_uuid', 'car_uuid');
    }
}
