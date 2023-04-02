<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsDrivesTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_DRIVES, 'id', 'uuid');

        Schema::table(Tables::CARS_DRIVES, function (Blueprint $table) {
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_DRIVES, 'uuid', 'id');

        Schema::table(Tables::CARS_DRIVES, function (Blueprint $table) {
            $table->dropUnique('cars_drives_title_unique');
        });
    }
}
