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
        Schema::table('dictionary_table_values', function (Blueprint $table) {
            $table->integer('correct_point')->default(0);
            $table->integer('incorrect_point')->default(1);
            $table->integer('proportionality')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictionary_table_values', function (Blueprint $table) {
            $table->dropColumn('correct_point');
            $table->dropColumn('incorrect_point');
            $table->dropColumn('proportionality');
        });
    }
};
