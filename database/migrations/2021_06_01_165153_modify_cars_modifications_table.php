<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsModificationsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'id', 'uuid');
        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'body_id', 'cars_body_uuid');
        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'trim_id', 'cars_trim_uuid');

        Schema::table(Tables::CARS_MODIFICATIONS, fn(Blueprint $blueprint) => $blueprint->string('slug')->after('title'));
        Schema::table(Tables::CARS_MODIFICATIONS, fn(Blueprint $blueprint) => $blueprint->string('code', 10)->nullable()->after('slug'));

        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->dropColumn('model_id');
            $table->unique(['cars_body_uuid', 'cars_trim_uuid', 'title'], 'cars_modifications_unique');
        });

        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->foreign('cars_body_uuid')
                ->references('uuid')
                ->on(Tables::CARS_BODIES)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->foreign('cars_trim_uuid')
                ->references('uuid')
                ->on(Tables::CARS_TRIMS);
        });
    }

    public function down()
    {
        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->dropForeign(['cars_body_uuid']);
        });

        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->dropForeign(['cars_trim_uuid']);
            $table->dropIndex('cars_modifications_cars_trim_uuid_foreign');
        });

        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'uuid', 'id');
        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'cars_body_uuid', 'body_id');
        $this->renameColumn(Tables::CARS_MODIFICATIONS, 'cars_trim_uuid', 'trim_id');

        Schema::table(Tables::CARS_MODIFICATIONS, function (Blueprint $table) {
            $table->dropIndex('cars_modifications_unique');
            $table->dropColumn(['slug', 'code']);
            $table->uuid('model_id');
        });
    }
}
