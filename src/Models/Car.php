<?php

namespace Avangard\CarsStructure\Models;

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\Cars as CarsContract;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Vin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class Car extends UuidModel implements CarsContract, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS;

    protected $casts = [
        'vin'             => Vin::class,
        'dealer_order'    => 'integer',
        'price'           => 'double',
        'price_special'   => 'double',
        'price_trade_in'  => 'double',
        'price_prepay'    => 'double',
        'production_year' => 'integer',
        'mileage'         => 'float',
        'is_stock'        => 'boolean',
        'is_trade_in'     => 'boolean',
        'is_star_class'   => 'boolean',
        'is_used_car'     => 'boolean',
        'is_demo'         => 'boolean',
        'is_test'         => 'boolean',
    ];

    protected $fillable = [
        'uuid',
        'cars_organization_uuid',
        'cars_body_uuid',
        'cars_modification_uuid',
        'cars_engine_uuid',
        'cars_drive_uuid',
        'cars_transmission_uuid',
        'cars_color_uuid',
        'cars_interior_uuid',
        'vin',
        'dealer_order',
        'price',
        'price_special',
        'price_trade_in',
        'price_prepay',
        'production_year',
        'mileage',
        'is_stock',
        'is_trade_in',
        'is_star_class',
        'is_used_car',
        'is_demo',
        'is_test',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /** Мутация над Vin номером */
    public function getVinMaskedAttribute(): string
    {
        return Str::of($this->vin)
            ->substr(0, 7)
            ->append('*******')
            ->append(substr($this->vin, -2));
    }

    public function body(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsBody'), 'cars_body_uuid');
    }

    public function modification(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsModification'), 'cars_modification_uuid');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsColor'), 'cars_color_uuid');
    }

    public function engine(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsEngine'), 'cars_engine_uuid');
    }

    public function drive(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsDrive'), 'cars_drive_uuid');
    }

    public function transmission(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsTransmission'), 'cars_transmission_uuid');
    }

    public function interior(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsInterior'), 'cars_interior_uuid');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(config('cars_structure.carsOrganization'), 'cars_organization_uuid');
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(config('cars_structure.carsOption'), Tables::CAR_CARS_OPTION, 'car_uuid', 'cars_option_uuid');
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('is_used_car', false);
    }

    public function scopeWithAll(Builder $query): Builder
    {
        return $query->with(
            'modification.options.parameter',
            'modification.trim',
            'body.model',
            'body.model.mark',
            'body.model.category',
            'body.number',
            'body.type',
            'engine.type',
            'drive',
            'transmission',
            'color',
            'interior',
            'options.group',
        );
    }
}
