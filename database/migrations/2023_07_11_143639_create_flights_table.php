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
        Schema::create('flights', function (Blueprint $table) {
            $table->comment('Рейсы');

            $table->id('flight_id')->comment('Идентификатор рейса');
            $table->string('flight_no', 6)->comment('Номер рейса');
            $table->timestampTz('scheduled_departure')->comment('Время вылета по расписанию');
            $table->timestampTz('scheduled_arrival')->comment('Время прилёта по расписанию');
            $table->string('departure_airport', 3)->comment('Аэропорт отправления');
            $table->string('arrival_airport', 3)->comment('Аэропорт прибытия');
            $table->enum('status', ['On Time', 'Delayed', 'Departed', 'Arrived', 'Scheduled', 'Cancelled'])->comment('Статус рейса');
            $table->string('aircraft_code', 3)->comment('Код самолета, IATA');
            $table->timestampTz('actual_departure')->nullable()->comment('Фактическое время вылета');
            $table->timestampTz('actual_arrival')->nullable()->comment('Фактическое время прилёта');

            $table->index('aircraft_code', 'flight_aircraft_idx');
            $table->foreign('aircraft_code', 'flight_aircraft_fk')->on('aircrafts')->references('aircraft_code')->cascadeOnDelete();
            $table->index('departure_airport', 'flight_departure_airport_idx');
            $table->foreign('departure_airport', 'flight_departure_airport_fk')->on('airports')->references('airport_code')->cascadeOnDelete();
            $table->index('arrival_airport', 'flight_arrival_airport_idx');
            $table->foreign('arrival_airport', 'flight_arrival_airport_fk')->on('airports')->references('airport_code')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
        if (env('APP_ENV') !== 'testing') {
            DB::statement('ALTER TABLE flights ADD CONSTRAINT flights_check CHECK ( scheduled_arrival > scheduled_departure );');
            DB::statement('ALTER TABLE flights ADD CONSTRAINT flights_check1 CHECK (((actual_arrival IS NULL) OR ((actual_departure IS NOT NULL) AND (actual_arrival IS NOT NULL) AND (actual_arrival > actual_departure))));');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (env('APP_ENV') !== 'testing') {
            DB::statement('ALTER TABLE flights DROP CONSTRAINT flights_check1;');
            DB::statement('ALTER TABLE flights DROP CONSTRAINT flights_check;');
        }
        Schema::dropIfExists('flights');
    }
};
