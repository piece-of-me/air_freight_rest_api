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
        Schema::create('tickets', function (Blueprint $table) {
            $table->comment('Билеты');

            $table->string('ticket_no', 13)->primary()->comment('Номер билета');
            $table->string('book_ref', 6)->comment('Номер бронирования');
            $table->string('passenger_id', 20)->comment('Идентификатор пассажира');
            $table->text('passenger_name')->comment('Имя пассажира');
            $table->jsonb('contact_data')->nullable()->comment('Контактные данные пассажира');

            $table->index('book_ref', 'ticket_booking_idx');
            $table->foreign('book_ref', 'ticket_booking_fk')->on('bookings')->references('book_ref')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
