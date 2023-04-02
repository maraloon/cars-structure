<?php


namespace Avangard\CarsStructure\Traits;


use Illuminate\Support\Str;

trait SetSlugAttribute
{
    use SetAttribute;

    /**
     * @param $value
     */
    protected function setTitleAttribute($value)
    {
        $this->setManualAttribute('title', trim($value));

        $this->setSlugAttribute($value);
    }

    /**
     * @param $value
     */
    protected function setSlugAttribute($value)
    {
        $this->setManualAttribute('slug', Str::slug(trim($value)));
    }
}
