<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnginesTable extends Migration
{
    public function up(): void
    {
        Schema::create('engines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->float('volume');
            $table->smallInteger('horsepower');
            $table->float('torque');
            $table->string('position');
            $table->smallInteger('cylinder_number');

            $table->uuid('engine_type_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
}