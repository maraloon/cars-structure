<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsEnginesTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_ENGINES, 'id', 'uuid');
        $this->renameColumn(Tables::CARS_ENGINES, 'engine_type_id', 'cars_engine_type_uuid');

        Schema::table(Tables::CARS_ENGINES, fn(Blueprint $blueprint) => $blueprint->uuid('cars_mark_uuid')->nullable()->after('torque'));

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->dropColumn(['title', 'position', 'cylinder_number']);
            $table->unsignedSmallInteger('volume')->change();
            $table->unsignedSmallInteger('horsepower')->change();
            $table->unsignedSmallInteger('torque')->nullable()->change();
            $table->unique(['cars_engine_type_uuid', 'cars_mark_uuid', 'volume', 'horsepower'], 'cars_engines_unique');
        });

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->foreign('cars_mark_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MARKS)
                ->onDelete('set null');
        });

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->foreign('cars_engine_type_uuid')
                ->references('uuid')
                ->on(Tables::CARS_ENGINE_TYPES)
                ->onDelete('cascade');
        });
    }

    public function down()
    {

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->dropForeign(['cars_engine_type_uuid']);
        });

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->dropForeign(['cars_mark_uuid']);
            $table->dropIndex('cars_engines_cars_mark_uuid_foreign');
        });

        $this->renameColumn(Tables::CARS_ENGINES, 'uuid', 'id');
        $this->renameColumn(Tables::CARS_ENGINES, 'cars_engine_type_uuid', 'engine_type_id');

        Schema::table(Tables::CARS_ENGINES, function (Blueprint $table) {
            $table->dropUnique('cars_engines_unique');
            $table->float('volume')->change();
            $table->smallInteger('horsepower')->change();
            $table->string('title');
            $table->string('position');
            $table->smallInteger('cylinder_number');
            $table->float('torque')->nullable(false)->change();
            $table->dropColumn('cars_mark_uuid');
        });
    }
}
