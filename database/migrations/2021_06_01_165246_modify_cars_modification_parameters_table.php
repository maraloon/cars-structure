<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsModificationParametersTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_MODIFICATION_PARAMETERS, 'id', 'uuid');

        Schema::table(Tables::CARS_MODIFICATION_PARAMETERS, function (Blueprint $table) {
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_MODIFICATION_PARAMETERS, 'uuid', 'id');

        Schema::table(Tables::CARS_MODIFICATION_PARAMETERS, function (Blueprint $table) {
            $table->dropUnique('cars_modification_parameters_title_unique');
        });
    }
}
