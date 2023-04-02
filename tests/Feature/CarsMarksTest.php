<?php


namespace Tests\Feature;


use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Models\CarsMark;
use Avangard\CarsStructure\ValueObjects\Types\TitleEn;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Tests\TestCase;

class CarsMarksTest extends TestCase
{
    public function testCreateCarsMark()
    {
        CarsMark::query()->create([
            'title_ru' => new TitleRu('Мерседес-Бенц'),
            'title'    => new TitleEn('Mercedes-Benz'),
        ]);

        $this->assertDatabaseHas(Tables::CARS_MARKS,
            [
                'title'    => 'Mercedes-Benz',
                'title_ru' => 'Мерседес-Бенц',
            ]);
    }

    public function testDataCarsMark()
    {
        $cars_mark           = new CarsMark();
        $cars_mark->title    = new TitleEn('BMW');
        $cars_mark->title_ru = new TitleRu('БМВ');
        $cars_mark->save();

        $this->assertDatabaseHas(Tables::CARS_MARKS,
            [
                'title'    => 'BMW',
                'title_ru' => 'БМВ',
            ]);
    }

    public function testDTOCarsMark()
    {
        $dto = array_merge(
            (new TitleEn('Audi', 'title'))->toDTO(),
            (new TitleRu('Ауди', 'title_ru'))->toDTO()
        );

        CarsMark::query()
            ->create($dto);

        $this->assertDatabaseHas(Tables::CARS_MARKS,
            [
                'title'    => 'Audi',
                'title_ru' => 'Ауди',
            ]);
    }
}
