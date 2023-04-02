<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyNumbersTable extends Migration
{
    public function up(): void
    {
        Schema::create('body_numbers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number');
            $table->boolean('is_restyling');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('body_numbers');
    }
}