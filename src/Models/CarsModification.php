<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsModification as CarsModificationContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\Traits\SetAttribute;
use Avangard\CarsStructure\Traits\SetSlugAttribute;
use Avangard\CarsStructure\ValueObjects\Types\Code;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarsModification extends UuidModel implements CarsModificationContract, Published
{
    use SoftDeletes, SetAttribute, SetSlugAttribute;

    protected $table = Tables::CARS_MODIFICATIONS;

    protected $casts = [
        'title' => Title::class,
        'code'  => Code::class,
    ];

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'code',
        'cars_body_uuid',
        'cars_trim_uuid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function body(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsBody'), 'cars_body_uuid');
    }

    public function trim(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsTrim'), 'cars_trim_uuid');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(config('cars_structure.car'), 'cars_modification_uuid');
    }

    public function options(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                config('cars_structure.carsModificationParameter'),
                Tables::CARS_MODIFICATION_OPTIONS, 'cars_modification_uuid',
                'cars_modification_parameter_uuid')
            ->withPivot('value');
    }
}
