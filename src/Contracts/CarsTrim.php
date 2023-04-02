<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsTrim
{
    public function modifications(): HasMany;
}
