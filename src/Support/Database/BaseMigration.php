<?php

namespace Avangard\CarsStructure\Support\Database;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

abstract class BaseMigration extends Migration
{
    abstract public function up();

    abstract public function down();

    protected function renameColumn(string $table, string $from, string $to)
    {
        Schema::table($table, fn(Blueprint $blueprint) => $blueprint->renameColumn($from, $to));
    }
}
