<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsColorsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS_COLORS, 'id', 'uuid');

        Schema::table(Tables::CARS_COLORS, function (Blueprint $table) {
            $table->string('basename')->nullable()->change();
            $table->string('hex', 7)->default('#000000')->after('basename');
            $table->boolean('is_metallic')->default(0)->after('hex');
        });
    }

    public function down()
    {
        $this->renameColumn(Tables::CARS_COLORS, 'uuid', 'id');

        Schema::table(Tables::CARS_COLORS, function (Blueprint $table) {
            $table->string('basename')->nullable(false)->change();
            $table->dropColumn('hex');
            $table->dropColumn('is_metallic');
        });
    }
}
