<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsEngineTypesTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_ENGINE_TYPES, 'id', 'uuid');

        Schema::table(Tables::CARS_ENGINE_TYPES, function (Blueprint $table) {
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_ENGINE_TYPES, 'uuid', 'id');

        Schema::table(Tables::CARS_ENGINE_TYPES, function (Blueprint $table) {
            $table->dropUnique('cars_engine_types_title_unique');
        });
    }
}
