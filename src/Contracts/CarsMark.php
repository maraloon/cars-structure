<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface CarsMark
{
    public function models(): HasMany;

    public function engines(): HasMany;
}
