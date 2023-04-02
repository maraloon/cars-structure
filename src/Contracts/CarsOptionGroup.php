<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsOptionGroup
{
    public function options(): HasMany;
}
