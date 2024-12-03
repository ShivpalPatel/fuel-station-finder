<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ev_station_id')->constrained('ev_stations')->onDelete('cascade'); // Foreign key to ev_stations
            $table->date('date'); // Slot date
            $table->time('start_time'); // Slot start time
            $table->time('end_time'); // Slot end time
            $table->enum('status', ['available', 'booked'])->default('available'); // Slot status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
