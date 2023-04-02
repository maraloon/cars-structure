<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsInteriorsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_INTERIORS, 'id', 'uuid');

        Schema::table(Tables::CARS_INTERIORS, function (Blueprint $table) {
            $table->string('basename')->nullable()->change();
            $table->unique(['code', 'title']);
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_INTERIORS, 'uuid', 'id');

        Schema::table(Tables::CARS_INTERIORS, function (Blueprint $table) {
            $table->string('basename')->nullable(false)->change();
            $table->dropUnique(['code', 'title']);
        });
    }
}
