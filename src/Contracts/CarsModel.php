<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsModel
{
    public function mark(): BelongsTo;

    public function category(): BelongsTo;

    public function bodies(): HasMany;
}
