<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModificationOptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('modification_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');

            $table->uuid('modification_id');
            $table->uuid('modification_parameter_id');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modification_options');
    }
}