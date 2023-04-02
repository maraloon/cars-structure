<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsBody as CarsBodyContract;
use Avangard\CarsStructure\Contracts\Published;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsBody extends UuidModel implements CarsBodyContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_BODIES;

    protected $casts = [
        'year_from'  => 'integer',
        'year_to'    => 'integer',
        'generation' => 'integer',
        'restyling'  => 'integer',
    ];

    protected $fillable = [
        'uuid',
        'year_from',
        'year_to',
        'generation',
        'restyling',
        'cars_model_uuid',
        'cars_body_type_uuid',
        'cars_body_number_uuid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsModel'), 'cars_model_uuid');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsBodyType'), 'cars_body_type_uuid');
    }

    public function number(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsBodyNumber'), 'cars_body_number_uuid');
    }

    public function modifications(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsModification'), 'cars_body_uuid');
    }
}
