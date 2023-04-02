<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarsTable extends BaseMigration
{
    public function up()
    {
        $this->renameColumn(Tables::CARS, 'id', 'uuid');
        $this->renameColumn(Tables::CARS, 'body_id', 'cars_body_uuid');
        $this->renameColumn(Tables::CARS, 'modification_id', 'cars_modification_uuid');
        $this->renameColumn(Tables::CARS, 'engine_id', 'cars_engine_uuid');
        $this->renameColumn(Tables::CARS, 'drive_id', 'cars_drive_uuid');
        $this->renameColumn(Tables::CARS, 'transmission_id', 'cars_transmission_uuid');
        $this->renameColumn(Tables::CARS, 'color_id', 'cars_color_uuid');
        $this->renameColumn(Tables::CARS, 'interior_id', 'cars_interior_uuid');
        $this->renameColumn(Tables::CARS, 'dealer_order_id', 'dealer_order');

        Schema::table(Tables::CARS, fn(Blueprint $blueprint) => $blueprint->uuid('cars_organization_uuid')->after('is_test'));

        Schema::table(Tables::CARS, function (Blueprint $table) {
            $table->dropColumn('model_id');

            $table->string('dealer_order')->nullable()->change();
            $table->string('vin', 17)->nullable()->change();
            $table->unsignedDecimal('price', 10, 2)->default(0)->change();
            $table->unsignedDecimal('price_special', 10, 2)->default(0)->change();
            $table->unsignedDecimal('price_trade_in', 10, 2)->default(0)->change();
            $table->decimal('mileage', 10, 0)->default(0)->change();
            $table->boolean('is_stock')->default(false)->change();
            $table->boolean('is_trade_in')->default(false)->change();
            $table->boolean('is_star_class')->default(false)->change();
            $table->boolean('is_used_car')->default(false)->change();
            $table->boolean('is_demo')->default(false)->change();
            $table->boolean('is_test')->default(false)->change();
        });
    }

    public function down()
    {

        $this->renameColumn(Tables::CARS, 'uuid', 'id');
        $this->renameColumn(Tables::CARS, 'cars_body_uuid', 'body_id');
        $this->renameColumn(Tables::CARS, 'cars_modification_uuid', 'modification_id');
        $this->renameColumn(Tables::CARS, 'cars_engine_uuid', 'engine_id');
        $this->renameColumn(Tables::CARS, 'cars_drive_uuid', 'drive_id');
        $this->renameColumn(Tables::CARS, 'cars_transmission_uuid', 'transmission_id');
        $this->renameColumn(Tables::CARS, 'cars_color_uuid', 'color_id');
        $this->renameColumn(Tables::CARS, 'cars_interior_uuid', 'interior_id');
        $this->renameColumn(Tables::CARS, 'dealer_order', 'dealer_order_id');


        Schema::table(Tables::CARS, function (Blueprint $table) {

            $table->dropColumn('cars_organization_uuid');
            $table->uuid('model_id');

            $table->string('vin')->nullable(false)->change();
            $table->string('dealer_order_id')->nullable(false)->change();
            $table->integer('price')->change();
            $table->integer('price_special')->change();
            $table->integer('price_trade_in')->change();
            $table->integer('mileage')->change();
            $table->boolean('is_stock')->change();
            $table->boolean('is_trade_in')->change();
            $table->boolean('is_star_class')->change();
            $table->boolean('is_used_car')->change();
            $table->boolean('is_demo')->change();
            $table->boolean('is_test')->change();
        });
    }
}
