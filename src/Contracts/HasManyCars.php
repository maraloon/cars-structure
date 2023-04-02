<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasManyCars
{
    public function cars(): HasMany;
}
