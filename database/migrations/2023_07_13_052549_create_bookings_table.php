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
        Schema::create('bookings', function (Blueprint $table) {
            $table->comment('Бронирования');

            $table->string('book_ref', 6)->primary()->comment('Номер бронирования');
            $table->timestampTz('book_date')->comment('Дата бронирования');
            $table->decimal('total_amount', 10, 2)->comment('Полная сумма бронирования');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
