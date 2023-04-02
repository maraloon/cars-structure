<?php


namespace Avangard\CarsStructure\ValueObjects\Types;


use Avangard\CarsStructure\ValueObjects\ValueObject;
use Illuminate\Support\Str;

final class TitleRu extends ValueObject
{
    protected function transformInput($value): string
    {
        return Str::ucfirst($value);
    }

    protected function rules(): array
    {
        return [
            $this->key => ['string', 'max:180', 'regex:/[А-Яа-яЁё]/u'],
        ];
    }
}
