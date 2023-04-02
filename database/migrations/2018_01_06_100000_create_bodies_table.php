<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodiesTable extends Migration
{
    public function up(): void
    {
        Schema::create('bodies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year')->nullable();

            $table->uuid('model_id');
            $table->uuid('body_number_id');
            $table->uuid('body_type_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bodies');
    }
}