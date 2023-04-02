<?php

use Avangard\CarsStructure\Models\Car;
use Avangard\CarsStructure\Models\CarsBody;
use Avangard\CarsStructure\Models\CarsBodyNumber;
use Avangard\CarsStructure\Models\CarsBodyType;
use Avangard\CarsStructure\Models\CarsCategory;
use Avangard\CarsStructure\Models\CarsColor;
use Avangard\CarsStructure\Models\CarsDrive;
use Avangard\CarsStructure\Models\CarsEngine;
use Avangard\CarsStructure\Models\CarsEngineType;
use Avangard\CarsStructure\Models\CarsImages;
use Avangard\CarsStructure\Models\CarsInterior;
use Avangard\CarsStructure\Models\CarsMark;
use Avangard\CarsStructure\Models\CarsModel;
use Avangard\CarsStructure\Models\CarsModification;
use Avangard\CarsStructure\Models\CarsModificationParameter;
use Avangard\CarsStructure\Models\CarsOption;
use Avangard\CarsStructure\Models\CarsOptionGroup;
use Avangard\CarsStructure\Models\CarsOrganization;
use Avangard\CarsStructure\Models\CarsTransmission;
use Avangard\CarsStructure\Models\CarsTrim;

return [
    'car'                       => Car::class,
    'carsBody'                  => CarsBody::class,
    'carsBodyType'              => CarsBodyType::class,
    'carsBodyNumber'            => CarsBodyNumber::class,
    'carsCategory'              => CarsCategory::class,
    'carsColor'                 => CarsColor::class,
    'carsDrive'                 => CarsDrive::class,
    'carsEngine'                => CarsEngine::class,
    'carsEngineType'            => CarsEngineType::class,
    'carsImages'                => CarsImages::class,
    'carsInterior'              => CarsInterior::class,
    'carsMark'                  => CarsMark::class,
    'carsModel'                 => CarsModel::class,
    'carsModification'          => CarsModification::class,
    'carsModificationParameter' => CarsModificationParameter::class,
    'carsOption'                => CarsOption::class,
    'carsOptionGroup'           => CarsOptionGroup::class,
    'carsOrganization'          => CarsOrganization::class,
    'carsTransmission'          => CarsTransmission::class,
    'carsTrim'                  => CarsTrim::class,
];
