<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsOptionGroupsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_OPTION_GROUPS, 'id', 'uuid');

        Schema::table(Tables::CARS_OPTION_GROUPS, function (Blueprint $table) {
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_OPTION_GROUPS, 'uuid', 'id');

        Schema::table(Tables::CARS_OPTION_GROUPS, function (Blueprint $table) {
            $table->dropUnique(['title']);
        });
    }
}
