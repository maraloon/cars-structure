<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface CarsOption
{
    public function group(): BelongsTo;

    public function cars(): BelongsToMany;
}
