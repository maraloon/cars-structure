<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsTableAddForeignKeys extends BaseMigration
{
    public function up()
    {
        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_body_uuid')
                ->references('uuid')
                ->on(Tables::CARS_BODIES);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_modification_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MODIFICATIONS);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_engine_uuid')
                ->references('uuid')
                ->on(Tables::CARS_ENGINES);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_drive_uuid')
                ->references('uuid')
                ->on(Tables::CARS_DRIVES);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_transmission_uuid')
                ->references('uuid')
                ->on(Tables::CARS_TRANSMISSIONS);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_color_uuid')
                ->references('uuid')
                ->on(Tables::CARS_COLORS);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_interior_uuid')
                ->references('uuid')
                ->on(Tables::CARS_INTERIORS);
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->foreign('cars_organization_uuid')
                ->references('uuid')
                ->on(Tables::CARS_ORGANIZATIONS);
        });
    }

    public function down()
    {
        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_body_uuid']);
            $table->dropIndex('cars_cars_body_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_modification_uuid']);
            $table->dropIndex('cars_cars_modification_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_engine_uuid']);
            $table->dropIndex('cars_cars_engine_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_drive_uuid']);
            $table->dropIndex('cars_cars_drive_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_transmission_uuid']);
            $table->dropIndex('cars_cars_transmission_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_color_uuid']);
            $table->dropIndex('cars_cars_color_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_interior_uuid']);
            $table->dropIndex('cars_cars_interior_uuid_foreign');
        });

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropForeign(['cars_organization_uuid']);
            $table->dropIndex('cars_cars_organization_uuid_foreign');
        });
    }
}
