<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsMarksTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_MARKS, 'id', 'uuid');

        Schema::table(Tables::CARS_MARKS, function (Blueprint $table) {
            $table->string('title_ru')->nullable()->change();
            $table->unique('slug');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_MARKS, 'uuid', 'id');

        Schema::table(Tables::CARS_MARKS, function (Blueprint $table) {
            $table->string('title_ru')->nullable(false)->change();
            $table->dropUnique('cars_marks_slug_unique');
        });
    }
}
