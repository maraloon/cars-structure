<?php


namespace Avangard\CarsStructure\Models;


use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\Published;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarsImages extends UuidModel implements Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_IMAGES;

    protected $fillable = [
        'uuid',
        'cars_body_uuid',
        'cars_color_uuid',
        'cars_modification_uuid',
        'is_autoload',
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

    public function color(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsColor'), 'cars_color_uuid');
    }

    public function modification(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsModification'), 'cars_modification_uuid');
    }
}
