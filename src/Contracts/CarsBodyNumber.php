<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsBodyNumber
{
    public function bodies(): HasMany;
}
