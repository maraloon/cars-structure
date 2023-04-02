<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsBodyNumbersTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_BODY_NUMBERS, 'id', 'uuid');

        Schema::table(Tables::CARS_BODY_NUMBERS, function (Blueprint $table) {
            $table->dropColumn('is_restyling');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_BODY_NUMBERS, 'uuid', 'id');

        Schema::table(Tables::CARS_BODY_NUMBERS, function (Blueprint $table) {
            $table->boolean('is_restyling')->after('number');
        });
    }
}
