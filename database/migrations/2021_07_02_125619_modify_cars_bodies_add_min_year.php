<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsBodiesAddMinYear extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_BODIES, 'year', 'year_to');

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->year('year_from');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_BODIES, 'year_to', 'year');

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->dropColumn('year_from');
        });
    }
}
