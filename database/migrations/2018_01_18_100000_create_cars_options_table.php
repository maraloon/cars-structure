<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsOptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('cars_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 50);
            $table->string('title');

            $table->uuid('cars_option_group_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars_options');
    }
}