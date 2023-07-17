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
        Schema::create('ticket_flights', function (Blueprint $table) {
            $table->comment('Перелеты');

            $table->id();
            $table->string('ticket_no', 13)->comment('Номер билета');
            $table->integer('flight_id')->comment('Идентификатор рейса');
            $table->enum('fare_conditions', ['Economy', 'Comfort', 'Business'])->comment('Класс обслуживания');
            $table->decimal('amount', 10, 2)->comment('Стоимость перелета');

            $table->index('ticket_no', 'tf_ticket_idx');
            $table->foreign('ticket_no', 'tf_ticket_fk')->on('tickets')->references('ticket_no')->cascadeOnDelete();
            $table->index('flight_id', 'tf_flights_idx');
            $table->foreign('flight_id', 'tf_flights_fk')->on('flights')->references('flight_id')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE ticket_flights ADD CONSTRAINT ticket_flights_amount_check CHECK ( amount > 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE ticket_flights DROP CONSTRAINT ticket_flights_amount_check;');
        Schema::dropIfExists('ticket_flights');
    }
};
