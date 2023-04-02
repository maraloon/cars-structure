<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarCarsOptionTable extends BaseMigration
{
    public function up()
    {

        $this->renameColumn('car_cars_option', 'car_id', 'car_uuid');
        $this->renameColumn('car_cars_option', 'cars_option_id', 'cars_option_uuid');

        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
            $table->index('car_uuid');
        });

        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->foreign('car_uuid')
                ->references('uuid')
                ->on(Tables::CARS)
                ->onDelete('cascade');
        });

        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->foreign('cars_option_uuid')
                ->references('uuid')
                ->on(Tables::CARS_OPTIONS)
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->dropForeign(['car_uuid']);
            $table->dropIndex('car_cars_option_car_uuid_index');
        });

        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->dropForeign(['cars_option_uuid']);
            $table->dropIndex('car_cars_option_cars_option_uuid_foreign');
        });

        $this->renameColumn('car_cars_option', 'car_uuid', 'car_id');
        $this->renameColumn('car_cars_option', 'cars_option_uuid', 'cars_option_id');

        Schema::table('car_cars_option', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });
    }
}
