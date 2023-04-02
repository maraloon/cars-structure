<?php


namespace Avangard\CarsStructure\Exceptions;

use InvalidArgumentException;

final class InvalidType extends InvalidArgumentException
{
    public function __construct(string $model, string $key, string $type)
    {
        parent::__construct('The Eloquent Model "' . $model . '" must use the type "' . $type . '" specified in casts -> ' . $key);
    }
}
