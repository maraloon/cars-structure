<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface CarsModification
{
    public function body(): BelongsTo;

    public function trim(): BelongsTo;

    public function options(): BelongsToMany;
}
