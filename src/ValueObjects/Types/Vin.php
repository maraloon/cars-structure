<?php


namespace Avangard\CarsStructure\ValueObjects\Types;


use Avangard\CarsStructure\ValueObjects\ValueObject;
use Illuminate\Support\Str;

final class Vin extends ValueObject
{
    protected function transformInput($value): string
    {
        return Str::upper($value);
    }

    protected function rules(): array
    {
        return [
            $this->key => ['string', 'regex:/[0-9A-Z]{17}/'],
        ];
    }
}
