<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsBodyTypesTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_BODY_TYPES, 'id', 'uuid');

        Schema::table(Tables::CARS_BODY_TYPES, function (Blueprint $table) {
            $table->unique('title');
            $table->string('slug')->after('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_BODY_TYPES, 'uuid', 'id');

        Schema::table(Tables::CARS_BODY_TYPES, function (Blueprint $table) {
            $table->dropUnique('cars_body_types_title_unique');
            $table->dropColumn('slug');
        });
    }
}
