<?php

namespace Tests\Feature;

use Avangard\CarsStructure\Models\Car;
use Avangard\CarsStructure\ValueObjects\Types\Vin;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class CarsEloquentTest extends TestCase
{
    public function testCreateCar()
    {
        $data = $this->getData();

        $generation_array = $this->replaceGeneration($data->generation, $data->body_number);

        $cars_category     = $this->service()->createCategory($data->category);
        $cars_organization = $this->service()->createOrganization($data->organization);
        $cars_mark         = $this->service()->createMark($data->mark, $data->mark_ru);
        $cars_model        = $this->service()->createModel($cars_mark, $cars_category, $data->model);
        $cars_body_type    = $this->service()->createBodyType($data->body_type);
        $cars_body_number  = null;

        if ($body_number = Arr::get($generation_array, 'body_number')) {
            $cars_body_number = $this->service()->createBodyNumber($body_number)->uuid;
        }

        $cars_body = $this->service()
            ->createBody($cars_model,
                $cars_body_type,
                $cars_body_number,
                Arr::get($generation_array, 'generation'),
                Arr::get($generation_array, 'restyling'),
                $data->model_yearfrom,
                $data->model_yearTo
            );

        $cars_trim = $this->service()->createTrim($data->trim);

        $cars_modification = $this->service()->createModification($cars_body, $cars_trim, $data->modification, $data->modification_code);
        $this->service()->createModificationOptions($cars_modification, $data->modification_parameters);

        $cars_drive        = $this->service()->createDrive($data->drive);
        $cars_color        = $this->service()->createColor($data->color->name, $data->color->code);
        $cars_interior     = $this->service()->createInterior($data->interior->name, $data->interior->code);
        $cars_transmission = $this->service()->createTransmission($data->transmission);

        $cars_engine_type = $this->service()->createEngineType($data->engine->fuel);
        $cars_engine      = $this->service()->createEngine($cars_mark, $cars_engine_type, $data->engine->volume, $data->engine->horsepower);


        $car = new Car();

        $car->body()->associate($cars_body);
        $car->modification()->associate($cars_modification);
        $car->engine()->associate($cars_engine);
        $car->color()->associate($cars_color);
        $car->interior()->associate($cars_interior);
        $car->drive()->associate($cars_drive);
        $car->transmission()->associate($cars_transmission);
        $car->organization()->associate($cars_organization);

        $car->fill([
            'vin'             => new Vin($data->vin),
            'dealer_order'    => '123123123',
            'price'           => $data->price,
            'price_special'   => $data->price_special,
            'price_trade_in'  => $data->price_trade_in,
            'production_year' => $data->year,
            'mileage'         => $data->millage,
            'is_stock'        => $data->is_stock,
            'is_trade_in'     => $data->is_trade_in,
            'is_star_class'   => $data->is_star,
            'is_used_car'     => $data->is_used,
            'is_demo'         => $data->is_demo,
            'is_test'         => $data->is_test,
        ]);

        $car->save();

        $this->assertEquals($car->vin, $data->vin);

    }

    private function getData()
    {
        $data = file_get_contents(__DIR__ . '/data.json');

        return json_decode($data);
    }

    private function replaceGeneration($generation, $body_number)
    {
        $restyling = Str::contains($generation, 'Рестайлинг');

        if (!$body_number || (!Str::contains($generation, $body_number) && $generation)) {
            preg_match_all('/\((.*?)\)/', $generation, $matches);
            $body_number = trim(Arr::first(Arr::flatten($matches)), '()');
        }

        preg_match_all('/\b[IVX]+\b/', $generation, $matches);

        $generation = Arr::first(Arr::flatten($matches)) ?: 'I';

        return compact('restyling', 'generation', 'body_number');
    }
}
