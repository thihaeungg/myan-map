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
        Schema::create('state_city', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->nullable()->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_city');
    }
};
