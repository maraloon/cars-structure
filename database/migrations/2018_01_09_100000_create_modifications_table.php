<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModificationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('modifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->uuid('model_id');
            $table->uuid('body_id');
            $table->uuid('trim_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifications');
    }
}