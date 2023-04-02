<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('vin');
            $table->string('dealer_order_id');
            $table->integer('price');
            $table->integer('price_special');
            $table->integer('price_trade_in');
            $table->year('production_year')->nullable();
            $table->integer('mileage');
            $table->boolean('is_stock');
            $table->boolean('is_trade_in');
            $table->boolean('is_star_class');
            $table->boolean('is_used_car');
            $table->boolean('is_demo');
            $table->boolean('is_test');

            $table->uuid('model_id');
            $table->uuid('body_id');
            $table->uuid('modification_id');
            $table->uuid('engine_id');
            $table->uuid('drive_id');
            $table->uuid('transmission_id');
            $table->uuid('color_id');
            $table->uuid('interior_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
}