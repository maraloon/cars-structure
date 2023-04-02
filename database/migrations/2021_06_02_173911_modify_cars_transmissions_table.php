<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsTransmissionsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_TRANSMISSIONS, 'id', 'uuid');

        Schema::table('cars_transmissions', function (Blueprint $table) {
            $table->dropColumn('number');
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_TRANSMISSIONS, 'uuid', 'id');

        Schema::table('cars_transmissions', function (Blueprint $table) {
            $table->string('number');
            $table->dropUnique(['title']);
        });
    }
}
