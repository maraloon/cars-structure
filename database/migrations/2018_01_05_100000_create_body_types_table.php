<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyTypesTable extends Migration
{
    public function up(): void
    {
        Schema::create('body_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('body_types');
    }
}