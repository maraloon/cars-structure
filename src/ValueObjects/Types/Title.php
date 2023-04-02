<?php


namespace Avangard\CarsStructure\ValueObjects\Types;


use Avangard\CarsStructure\ValueObjects\ValueObject;
use Illuminate\Support\Str;

final class Title extends ValueObject
{
    protected function transformInput($value): string
    {
        return Str::of(e($value))
            ->trim()
            ->lower()
            ->ucfirst();
    }

    protected function rules(): array
    {
        return [
            $this->key => ['string', 'max:180'],
        ];
    }
}
