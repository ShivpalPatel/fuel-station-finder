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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('brand');  // Car brand (e.g., Tesla, Hyundai)
            $table->string('model');  // Car model (e.g., Model 3, Kona)
            $table->decimal('price_per_unit', 8, 2);  // Price per unit (e.g., per km or hour)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
