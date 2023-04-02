<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsBodiesTable extends BaseMigration
{
    public function up()
    {

        $this->renameColumn(Tables::CARS_BODIES, 'id', 'uuid');
        $this->renameColumn(Tables::CARS_BODIES, 'model_id', 'cars_model_uuid');
        $this->renameColumn(Tables::CARS_BODIES, 'body_number_id', 'cars_body_number_uuid');
        $this->renameColumn(Tables::CARS_BODIES, 'body_type_id', 'cars_body_type_uuid');


        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->unsignedSmallInteger('generation')
                ->default(1)
                ->after('year')
                ->comment("Поколение модели");

            $table->unsignedSmallInteger('restyling')
                ->default(0)
                ->after('generation')
                ->comment("Рестайлинг может быть произведен несколько раз, пример G-class");

            $table->unique(['cars_model_uuid', 'cars_body_number_uuid', 'cars_body_type_uuid', 'restyling', 'generation'], 'cars_bodies_unique');
        });

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->foreign('cars_model_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MODELS)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->foreign('cars_body_number_uuid')
                ->references('uuid')
                ->on(Tables::CARS_BODY_NUMBERS);
        });

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->foreign('cars_body_type_uuid')
                ->references('uuid')
                ->on(Tables::CARS_BODY_TYPES);
        });
    }

    public function down()
    {

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->dropForeign(['cars_model_uuid']);
        });


        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->dropForeign(['cars_body_number_uuid']);
            $table->dropIndex('cars_bodies_cars_body_number_uuid_foreign');
        });


        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->dropForeign(['cars_body_type_uuid']);
            $table->dropIndex('cars_bodies_cars_body_type_uuid_foreign');
        });

        $this->renameColumn(Tables::CARS_BODIES, 'uuid', 'id');
        $this->renameColumn(Tables::CARS_BODIES, 'cars_model_uuid', 'model_id');
        $this->renameColumn(Tables::CARS_BODIES, 'cars_body_number_uuid', 'body_number_id');
        $this->renameColumn(Tables::CARS_BODIES, 'cars_body_type_uuid', 'body_type_id');

        Schema::table(Tables::CARS_BODIES, function (Blueprint $table) {
            $table->dropIndex('cars_bodies_unique');
            $table->dropColumn(['generation', 'restyling']);
        });

    }
}
