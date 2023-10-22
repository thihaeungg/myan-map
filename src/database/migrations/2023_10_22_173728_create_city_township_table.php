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
        Schema::create('city_township', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->onDelete('cascade');
            $table->foreignId('township_id')->nullable()->references('id')->on('townships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_township');
    }
};
