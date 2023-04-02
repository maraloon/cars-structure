<?php


namespace Avangard\CarsStructure\Contracts;


interface Transferable
{
    /**
     * Get the instance as Data Transfer.
     *
     * @return array
     */
    public function toDTO();
}
