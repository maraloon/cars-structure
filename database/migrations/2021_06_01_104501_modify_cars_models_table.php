<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsModelsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_MODELS, 'id', 'uuid');
        $this->renameColumn(Tables::CARS_MODELS, 'mark_id', 'cars_mark_uuid');
        $this->renameColumn(Tables::CARS_MODELS, 'category_id', 'cars_category_uuid');

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->foreign('cars_mark_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MARKS)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->foreign('cars_category_uuid')
                ->references('uuid')
                ->on(Tables::CARS_CATEGORIES)
                ->onDelete('cascade');
        });
    }

    public function down()
    {

        $this->renameColumn(Tables::CARS_MODELS, 'uuid', 'id');
        $this->renameColumn(Tables::CARS_MODELS, 'cars_mark_uuid', 'mark_id');
        $this->renameColumn(Tables::CARS_MODELS, 'cars_category_uuid', 'category_id');

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->dropUnique('cars_models_slug_unique');
        });

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->dropForeign(['cars_mark_uuid']);
            $table->dropIndex('cars_models_cars_mark_uuid_foreign');
        });

        Schema::table(Tables::CARS_MODELS, function (Blueprint $table) {
            $table->dropForeign(['cars_category_uuid']);
            $table->dropIndex('cars_models_cars_category_uuid_foreign');
        });
    }
}
