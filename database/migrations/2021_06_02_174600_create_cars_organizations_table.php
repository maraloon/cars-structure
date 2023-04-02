<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsOrganizationsTable extends BaseMigration
{
    public function up()
    {
        Schema::create(Tables::CARS_ORGANIZATIONS, function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('title')->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(Tables::CARS_ORGANIZATIONS);
    }
}
