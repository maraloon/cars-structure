<?php


namespace Avangard\CarsStructure\Casts;


use Avangard\CarsStructure\Exceptions\InvalidType;
use Avangard\CarsStructure\Exceptions\ClassIsNotValueObject;
use Avangard\CarsStructure\ValueObjects\ValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

final class CastValueObject implements CastsAttributes
{
    /** @var \Avangard\CarsStructure\ValueObjects\ValueObject|string|null */
    protected $valueObject;

    public function __construct($class)
    {
        if (!$class instanceof ValueObject) {
            throw new ClassIsNotValueObject($class);
        }

        $this->valueObject = $class;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new $this->valueObject($value, $key);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return mixed
     * @throws \Exception
     */
    public function set($model, string $key, $value, array $attributes)
    {
        $this->checkType($model, $key, $value);

        return $this->setValue($value);
    }

    /**
     * @param \Avangard\CarsStructure\ValueObjects\ValueObject $object
     *
     * @return mixed
     * @throws \Exception
     */
    protected function setValue(ValueObject $object)
    {
        return $object->value();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param $key
     * @param $value
     *
     * @throws \Exception
     */
    protected function checkType(Model $model, $key, $value): void
    {
        $type = Arr::get($model->getCasts(), $key);

        if (!$value instanceof $type) {
            throw new InvalidType(get_class($model), $key, $type);
        }
    }
}
