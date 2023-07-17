<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->comment('Аэропорты');

            $table->char('airport_code', 3)->primary()->comment('Код аэропорта');
            $table->string('airport_name', 100)->comment('Название аэропорта');
            $table->string('city', 100)->comment('Город');
            $table->double('longitude')->comment('Координаты аэропорта: долгота');
            $table->double('latitude')->comment('Координаты аэропорта: широта');
            $table->string('timezone', 30)->comment('Временная зона аэропорта');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
