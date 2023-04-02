<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsOptionGroupsTable extends Migration
{
    public function up(): void
    {
        Schema::create('cars_option_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars_option_groups');
    }
}