<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsAddPricePrepay extends BaseMigration
{
    public function up()
    {
        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->unsignedDecimal('price_prepay')->default(0)->after('price_trade_in');
        });
    }

    public function down()
    {
        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropColumn('price_prepay');
        });
    }
}
