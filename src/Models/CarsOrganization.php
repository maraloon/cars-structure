<?php


namespace Avangard\CarsStructure\Models;


use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Contracts\HasManyCars;
use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class CarsOrganization extends UuidModel implements HasManyCars, Published
{
    use SoftDeletes;

    protected $table = Tables::CARS_ORGANIZATIONS;

    protected $casts = [
        'title' => Title::class,
    ];

    protected $fillable = [
        'title',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(config('cars_structure.car'), 'cars_organization_uuid');
    }
}
