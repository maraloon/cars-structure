<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModificationParametersTable extends Migration
{
    public function up(): void
    {
        Schema::create('modification_parameters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->timestamps();
            $table->softDeletes();
        });

        $this->addDefaultParameters();
    }

    public function down(): void
    {
        Schema::dropIfExists('modification_parameters');
    }

    protected function addDefaultParameters(): void
    {
        $data = [
            'Вместимость багажника',
            'Вместимость топливного бака, л',
            'Габаритные размеры (Д/Ш/В), мм',
            'Собственная масса, кг',
            'Смешанный режим потребления топлива, л/100км, мех.',
            'Максимальная скорость, км/ч',
            'Разгон 0-100 км/ч, с, мех. КП / (АКП)',
            'Клиренс',
        ];

        foreach ($data as $title) {
            DB::table('modification_parameters')
                ->insert([
                    'id'    => Str::uuid(),
                    'title' => $title]);
        }
    }
}
