<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsCategoriesTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_CATEGORIES, 'id', 'uuid');

        Schema::table(Tables::CARS_CATEGORIES, function (Blueprint $table) {
            $table->unique('title');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_CATEGORIES, 'uuid', 'id');

        Schema::table(Tables::CARS_CATEGORIES, function (Blueprint $table) {
            $table->dropUnique('cars_categories_title_unique');
        });
    }
}
