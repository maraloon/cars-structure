<?php


namespace Avangard\CarsStructure\Traits;


trait SetAttribute
{
    public function setManualAttribute($key, $value, $default = null)
    {
        $this->attributes[$key] = $value ?: $default;
    }
}
