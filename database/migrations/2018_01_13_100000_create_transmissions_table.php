<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransmissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transmissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('number');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transmissions');
    }
}