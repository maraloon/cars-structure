<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCarsOptionTable extends Migration
{
    public function up(): void
    {
        Schema::create('car_cars_option', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('car_id');
            $table->uuid('cars_option_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_cars_option');
    }
}