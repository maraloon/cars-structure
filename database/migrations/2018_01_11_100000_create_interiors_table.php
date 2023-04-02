<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteriorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('interiors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 50);
            $table->string('title');
            $table->string('basename');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interiors');
    }
}