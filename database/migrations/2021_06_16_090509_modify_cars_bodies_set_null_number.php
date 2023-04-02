<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsBodiesSetNullNumber extends BaseMigration
{
    public function up()
    {
        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->foreignUuid('cars_body_number_uuid')
                ->nullable()
                ->change();
        });
    }

    public function down()
    {
        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->foreignUuid('cars_body_number_uuid')
                ->nullable(false)
                ->change();
        });
    }
}
