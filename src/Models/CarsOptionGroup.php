<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\CarsOptionGroup as CarsOptionGroupContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsOptionGroup extends UuidModel implements CarsOptionGroupContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_OPTION_GROUPS;

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

    public function options(): HasMany
    {
        return $this->hasMany(config('cars_structure.carsOption'), 'cars_option_group_uuid');
    }
}
