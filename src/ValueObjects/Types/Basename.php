<?php


namespace Avangard\CarsStructure\ValueObjects\Types;


use Avangard\CarsStructure\ValueObjects\ValueObject;

final class Basename extends ValueObject
{
    protected function transformInput($value): string
    {
        return trim(e($value));
    }

    protected function rules(): array
    {
        return [
            $this->key => ['string', 'max:50'],
        ];
    }
}
