<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('slug');
            $table->string('title');

            $table->uuid('mark_id');
            $table->uuid('category_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
}