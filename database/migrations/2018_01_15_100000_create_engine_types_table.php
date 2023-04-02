<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineTypesTable extends Migration
{
    public function up(): void
    {
        Schema::create('engine_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engine_types');
    }
}