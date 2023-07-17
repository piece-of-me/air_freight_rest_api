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
        Schema::create('boarding_passes', function (Blueprint $table) {
            $table->comment('Посадочные талоны');

            $table->id();
            $table->char('ticket_no', 13)->comment('Номер билета');
            $table->integer('flight_id')->comment('Идентификатор рейса');
            $table->integer('boarding_no')->comment('Номер посадочного талона');
            $table->string('seat_no', 4)->comment('Номер места');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_passes');
    }
};
