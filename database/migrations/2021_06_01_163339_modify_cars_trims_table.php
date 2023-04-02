<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsTrimsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_TRIMS, 'id', 'uuid');

        Schema::table(Tables::CARS_TRIMS, function (Blueprint $table) {
            $table->unique('title');
            $table->string('slug')->after('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_TRIMS, 'uuid', 'id');

        Schema::table(Tables::CARS_TRIMS, function (Blueprint $table) {
            $table->dropUnique('cars_trims_title_unique');
            $table->dropColumn('slug');
        });
    }
}
