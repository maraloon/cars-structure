<?php


namespace Tests\Services;


use Avangard\CarsStructure\Models\CarsBody;
use Avangard\CarsStructure\Models\CarsBodyNumber;
use Avangard\CarsStructure\Models\CarsBodyType;
use Avangard\CarsStructure\Models\CarsCategory;
use Avangard\CarsStructure\Models\CarsColor;
use Avangard\CarsStructure\Models\CarsDrive;
use Avangard\CarsStructure\Models\CarsEngine;
use Avangard\CarsStructure\Models\CarsEngineType;
use Avangard\CarsStructure\Models\CarsInterior;
use Avangard\CarsStructure\Models\CarsMark;
use Avangard\CarsStructure\Models\CarsModel;
use Avangard\CarsStructure\Models\CarsModification;
use Avangard\CarsStructure\Models\CarsModificationParameter;
use Avangard\CarsStructure\Models\CarsOrganization;
use Avangard\CarsStructure\Models\CarsTransmission;
use Avangard\CarsStructure\Models\CarsTrim;
use Avangard\CarsStructure\ValueObjects\Types\Basename;
use Avangard\CarsStructure\ValueObjects\Types\Code;
use Avangard\CarsStructure\ValueObjects\Types\Title;
use Avangard\CarsStructure\ValueObjects\Types\TitleEn;
use Avangard\CarsStructure\ValueObjects\Types\TitleRu;
use Tests\ValueObjects\RomanNumber;

class CarsEloquentService
{

    public static function make(): CarsEloquentService
    {
        return new static();
    }

    /**
     * @param string $title
     * @param $title_ru
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsMark
     */
    public function createMark(string $title, $title_ru)
    {
        return CarsMark::query()->create([
            'title'    => new TitleEn($title, 'title'),
            'title_ru' => new TitleRu($title_ru),
        ]);
    }

    /**
     * @param \Avangard\CarsStructure\Models\CarsMark $cars_mark
     * @param \Avangard\CarsStructure\Models\CarsCategory $cars_category
     * @param string $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsModel
     */
    public function createModel(CarsMark $cars_mark, CarsCategory $cars_category, string $title)
    {
        return CarsModel::query()->create([
            'cars_mark_uuid'     => $cars_mark->uuid,
            'cars_category_uuid' => $cars_category->uuid,
            'title'              => new Title($title),
        ]);
    }

    /**
     * @param \Avangard\CarsStructure\Models\CarsModel $cars_model
     * @param \Avangard\CarsStructure\Models\CarsBodyType $cars_body_type
     * @param $cars_body_number
     * @param string $generation
     * @param $restyling
     * @param $year
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsBody
     */
    public function createBody(CarsModel $cars_model, CarsBodyType $cars_body_type, $cars_body_number, string $generation, $restyling, $year_from, $year_to)
    {

        return CarsBody::query()
            ->create([
                'year_from'             => $year_from,
                'year_to'               => $year_to === now()->format('Y') ? null : $year_to,
                'generation'            => (new RomanNumber($generation))->value(),
                'restyling'             => $restyling,
                'cars_model_uuid'       => $cars_model->uuid,
                'cars_body_type_uuid'   => $cars_body_type->uuid,
                'cars_body_number_uuid' => $cars_body_number,
            ]);
    }

    /**
     * @param \Avangard\CarsStructure\Models\CarsBody $cars_body
     * @param \Avangard\CarsStructure\Models\CarsTrim $cars_trim
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsModification
     */
    public function createModification(CarsBody $cars_body, CarsTrim $cars_trim, string $title, string $code)
    {
        return CarsModification::query()
            ->create([
                'title'          => new Title($title),
                'code'           => new Code($code),
                'cars_body_uuid' => $cars_body->uuid,
                'cars_trim_uuid' => $cars_trim->uuid,
            ]);
    }

    /**
     * @param \Avangard\CarsStructure\Models\CarsModification $cars_modification
     * @param array $options
     */
    public function createModificationOptions(CarsModification $cars_modification, array $options)
    {
        $titles     = collect($options)->pluck('title');
        $parameters = [];

        CarsModificationParameter::query()
            ->whereIn('title', $titles)
            ->get()
            ->transform(function ($item) use ($options, &$parameters) {
                $parameters[$item->uuid] = ['value' => collect($options)->where('title', $item->title)->first()->value];
            });

        $cars_modification->options()->sync($parameters);
    }

    /**
     * @param $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsDrive
     */
    public function createDrive($title)
    {
        return CarsDrive::query()
            ->create([
                'title' => new TitleRu($title, 'title'),
            ]);
    }

    /**
     * @param $title
     * @param $code
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsColor
     */
    public function createColor($title, $code)
    {
        return CarsColor::query()
            ->create([
                'title'    => new Title($title),
                'code'     => new Code($code),
                'basename' => new Basename(SearchColorService::init()->basename($title)),
                'hex'      => SearchColorService::init()->hex($title),
            ]);
    }

    /**
     * @param $title
     * @param $code
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsInterior
     */
    public function createInterior($title, $code)
    {
        $dto = array_merge(
            (new Title($title))->toDTO(),
            (new Code($code))->toDTO(),
            (new Basename(SearchColorService::init()->basename($title)))->toDTO()
        );

        return CarsInterior::query()
            ->create($dto);
    }

    /**
     * @param $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsTransmission
     */
    public function createTransmission($title)
    {
        return CarsTransmission::query()
            ->create([
                'title' => new TitleRu($title, 'title'),
            ]);
    }

    /**
     * @param $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsEngineType
     */
    public function createEngineType($title)
    {
        return CarsEngineType::query()
            ->create([
                'title' => new Title($title),
            ]);
    }

    public function createEngine(CarsMark $cars_mark, CarsEngineType $cars_engine_type, $volume, $horsepower, $torque = 0)
    {
        $cars_mark_uuid        = $cars_mark->uuid;
        $cars_engine_type_uuid = $cars_engine_type->uuid;

        return CarsEngine::query()
            ->create(compact('cars_mark_uuid', 'cars_engine_type_uuid', 'volume', 'horsepower', 'torque'));

    }

    /**
     * @param string $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsCategory
     */
    public function createCategory(string $title)
    {
        $title = new TitleRu($title, 'title');

        return CarsCategory::query()
            ->create(compact('title'));
    }

    /**
     * @param string $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsOrganization
     */
    public function createOrganization(string $title)
    {
        return CarsOrganization::query()
            ->create([
                'title' => new Title($title),
            ]);
    }

    /**
     * @param $code
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsBodyNumber
     */
    public function createBodyNumber($code)
    {
        return CarsBodyNumber::query()
            ->create([
                'number' => new Code($code),
            ]);
    }

    /**
     * @param $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsBodyType
     */
    public function createBodyType($title)
    {
        return CarsBodyType::query()
            ->create([
                'title' => new TitleRu($title, 'title'),
            ]);
    }

    /**
     * @param $title
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|CarsTrim
     */
    public function createTrim($title)
    {
        return CarsTrim::query()
            ->create([
                'title' => new Title($title),
            ]);
    }
}
