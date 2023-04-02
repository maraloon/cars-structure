<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsModificationOptionsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_MODIFICATION_OPTIONS, 'modification_id', 'cars_modification_uuid');
        $this->renameColumn(Tables::CARS_MODIFICATION_OPTIONS, 'modification_parameter_id', 'cars_modification_parameter_uuid');

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
        });

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->foreign('cars_modification_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MODIFICATIONS)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->foreign('cars_modification_parameter_uuid', 'cars_modification_parameter_uuid_foreign')
                ->references('uuid')
                ->on(Tables::CARS_MODIFICATION_PARAMETERS)
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_MODIFICATION_OPTIONS, 'cars_modification_uuid', 'modification_id');
        $this->renameColumn(Tables::CARS_MODIFICATION_OPTIONS, 'cars_modification_parameter_uuid', 'modification_parameter_id');

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->dropForeign(['cars_modification_uuid']);
            $table->dropIndex('cars_modification_options_cars_modification_uuid_foreign');
        });

        Schema::table(Tables::CARS_MODIFICATION_OPTIONS, function (Blueprint $table) {
            $table->dropForeign('cars_modification_parameter_uuid_foreign');
            $table->dropIndex('cars_modification_parameter_uuid_foreign');
        });
    }
}
