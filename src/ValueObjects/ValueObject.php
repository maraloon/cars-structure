<?php


namespace Avangard\CarsStructure\ValueObjects;


use Avangard\CarsStructure\Casts\CastValueObject;
use Avangard\CarsStructure\Contracts\Transferable;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidatesWhenResolvedTrait;

abstract class ValueObject implements Castable, Arrayable, Transferable
{
    use ValidatesWhenResolvedTrait;

    protected $key;

    private $value;

    public function __construct($value, string $key = null)
    {
        $this->key   = $key ?: Str::snake(class_basename($this));
        $this->value = $this->transformInput($value);
        $this->validateResolved();
    }

    /**
     * @param array $arguments
     *
     * @return \Avangard\CarsStructure\Casts\CastValueObject
     */
    public static function castUsing(array $arguments)
    {
        return new CastValueObject(static::class);
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return \Avangard\CarsStructure\ValueObjects\ValueObject[]
     */
    public function toDTO()
    {
        return [$this->key => $this];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->value();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator()
    {
        return Validator::make(
            $this->validationData(),
            $this->rules(),
            $this->messages());
    }

    /**
     * @return array messages [key.method => "message"]
     */
    protected function messages(): array
    {
        return [];
    }

    /**
     * @return array rules [ field => [ rules... ] ] || [ filed => "rule|rule" ]
     */
    abstract protected function rules(): array;

    /**
     * Transform value before validate
     *
     * @param $value
     *
     * @return mixed
     */
    abstract protected function transformInput($value);

    /**
     * $reflection
     *
     * @return array
     */
    private function validationData(): array
    {
        return [$this->key => $this->value];
    }
}
