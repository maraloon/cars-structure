<?php


namespace Avangard\CarsStructure\ValueObjects\Types;


use Avangard\CarsStructure\ValueObjects\ValueObject;

final class TitleEn extends ValueObject
{
    protected function transformInput($value): string
    {
        return $value;
    }

    protected function rules(): array
    {
        return [
            $this->key => 'string|max:180|regex:/^[a-zA-Z -]*$/',
        ];
    }
}
