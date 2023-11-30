<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->comment('Самолеты');

            $table->char('aircraft_code', 3)->primary()->comment('Код самолета, IATA');
            $table->string('model',50)->comment('Модель самолета');
            $table->unsignedSmallInteger('range')->comment('Максимальная дальность полета, км');

            $table->timestamps();
            $table->softDeletes();
        });
        if (env('APP_ENV') !== 'testing') {
            DB::statement('ALTER TABLE aircrafts ADD CONSTRAINT aircrafts_range_check CHECK (range > 0);');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (env('APP_ENV') !== 'testing') {
            DB::statement('ALTER TABLE aircrafts DROP CONSTRAINT aircrafts_range_check;');
        }
        Schema::dropIfExists('aircrafts');
    }
};
