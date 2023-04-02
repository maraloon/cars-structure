<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsOptionsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_OPTIONS, 'id', 'uuid');
        $this->renameColumn(Tables::CARS_OPTIONS, 'cars_option_group_id', 'cars_option_group_uuid');

        Schema::table(Tables::CARS_OPTIONS, function (Blueprint $table) {
            $table->uuid('cars_option_group_uuid')->nullable()->change();
            $table->unique(['title', 'code']);
        });

        Schema::table(Tables::CARS_OPTIONS, function (Blueprint $table) {
            $table->foreign('cars_option_group_uuid')
                ->references('uuid')
                ->on('cars_option_groups')
                ->onDelete('set null');
        });
    }

    public function down()
    {

        Schema::table('cars_options', function (Blueprint $table) {
            $table->dropForeign(['cars_option_group_uuid']);
            $table->dropIndex('cars_options_cars_option_group_uuid_foreign');
        });

        $this->renameColumn(Tables::CARS_OPTIONS, 'uuid', 'id');
        $this->renameColumn(Tables::CARS_OPTIONS, 'cars_option_group_uuid', 'cars_option_group_id');

        Schema::table('cars_options', function (Blueprint $table) {
            $table->uuid('cars_option_group_id')->nullable(false)->change();
            $table->dropUnique(['title', 'code']);
        });
    }
}
