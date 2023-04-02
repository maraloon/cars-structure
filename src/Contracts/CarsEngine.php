<?php


namespace Avangard\CarsStructure\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface CarsEngine
{
    public function mark(): BelongsTo;

    public function type(): BelongsTo;
}
