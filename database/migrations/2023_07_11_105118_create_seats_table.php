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
        Schema::create('seats', function (Blueprint $table) {
            $table->comment('Места');

            $table->id();
            $table->char('aircraft_code', 3)->comment('Код самолета, IATA');
            $table->string('seat_no', 10)->comment('Номер места');
            $table->enum('fare_conditions', ['Economy', 'Comfort', 'Business'])->comment('Класс обслуживания');

            $table->index('aircraft_code', 'seat_aircraft_idx');
            $table->foreign('aircraft_code', 'seat_aircraft_fk')->on('aircrafts')->references('aircraft_code')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
