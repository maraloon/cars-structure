<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsBody
{
    public function model(): BelongsTo;

    public function type(): BelongsTo;

    public function number(): BelongsTo;

    public function modifications(): HasMany;
}
