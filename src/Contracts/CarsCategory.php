<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsCategory
{
    public function models(): HasMany;
}
