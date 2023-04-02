<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarsModificationParameter extends UuidModel implements Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_MODIFICATION_PARAMETERS;

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
}
