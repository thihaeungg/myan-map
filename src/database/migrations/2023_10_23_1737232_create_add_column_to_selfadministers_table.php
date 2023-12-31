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
        Schema::table('selfadministers', function (Blueprint $table) {
            $table->foreignId('capital_id')->nullable()->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selfadministers', function (Blueprint $table) {
            $table->dropForeign(['capital_id']);
        });

        Schema::table('selfadministers', function($table) {
            $table->dropColumn('capital_id');
        });
    }
};
