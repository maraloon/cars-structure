<?php


namespace Avangard\CarsStructure\Exceptions;

use Avangard\CarsStructure\ValueObjects\ValueObject;
use InvalidArgumentException;

final class ClassIsNotValueObject extends InvalidArgumentException
{
    public function __construct(string $class)
    {
        parent::__construct('The class "' . $class . '" is not inherited from the "' . ValueObject::class .
            '" and does not implement the necessary functionality');
    }
}
