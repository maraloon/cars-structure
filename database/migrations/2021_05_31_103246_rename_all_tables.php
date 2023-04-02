<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameAllTables extends Migration
{
    public function up()
    {
        Schema::rename('marks', 'cars_marks');
        Schema::rename('categories', 'cars_categories');
        Schema::rename('models', 'cars_models');

        Schema::rename('body_numbers', 'cars_body_numbers');
        Schema::rename('body_types', 'cars_body_types');
        Schema::rename('bodies', 'cars_bodies');
        Schema::rename('trims', 'cars_trims');

        Schema::rename('modification_parameters', 'cars_modification_parameters');
        Schema::rename('modifications', 'cars_modifications');
        Schema::rename('modification_options', 'cars_modification_options');

        Schema::rename('interiors', 'cars_interiors');
        Schema::rename('colors', 'cars_colors');
        Schema::rename('transmissions', 'cars_transmissions');
        Schema::rename('drives', 'cars_drives');

        Schema::rename('engine_types', 'cars_engine_types');
        Schema::rename('engines', 'cars_engines');
    }

    public function down()
    {
        Schema::rename('cars_marks', 'marks');
        Schema::rename('cars_categories', 'categories');
        Schema::rename('cars_models', 'models');

        Schema::rename('cars_body_numbers', 'body_numbers');
        Schema::rename('cars_body_types', 'body_types');
        Schema::rename('cars_bodies', 'bodies');
        Schema::rename('cars_trims', 'trims');

        Schema::rename('cars_modification_parameters', 'modification_parameters');
        Schema::rename('cars_modifications', 'modifications');
        Schema::rename('cars_modification_options', 'modification_options');

        Schema::rename('cars_interiors', 'interiors');
        Schema::rename('cars_colors', 'colors');
        Schema::rename('cars_transmissions', 'transmissions');
        Schema::rename('cars_drives', 'drives');

        Schema::rename('cars_engine_types', 'engine_types');
        Schema::rename('cars_engines', 'engines');
    }
}
