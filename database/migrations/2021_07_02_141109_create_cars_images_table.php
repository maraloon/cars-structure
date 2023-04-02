<?php

use Avangard\CarsStructure\Constants\Tables;
use Avangard\CarsStructure\Support\Database\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsImagesTable extends BaseMigration
{
    public function up()
    {
        Schema::create(Tables::CARS_IMAGES, function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->uuid('cars_body_uuid');
            $table->uuid('cars_color_uuid');
            $table->uuid('cars_modification_uuid')->nullable();

            $table->boolean('is_autoload')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['cars_body_uuid', 'cars_color_uuid', 'cars_modification_uuid'], 'cars_images_unique');
        });

        Schema::table(Tables::CARS_IMAGES, function (Blueprint $table) {
            $table->foreign('cars_body_uuid')
                ->references('uuid')
                ->on(Tables::CARS_BODIES)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_IMAGES, function (Blueprint $table) {
            $table->foreign('cars_color_uuid')
                ->references('uuid')
                ->on(Tables::CARS_COLORS)
                ->onDelete('cascade');
        });

        Schema::table(Tables::CARS_IMAGES, function (Blueprint $table) {
            $table->foreign('cars_modification_uuid')
                ->references('uuid')
                ->on(Tables::CARS_MODIFICATIONS)
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists(Tables::CARS_IMAGES);
    }
}
