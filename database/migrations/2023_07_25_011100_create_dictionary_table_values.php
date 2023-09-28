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
        Schema::create('dictionary_table_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tableID');
            $table->foreign('tableID')->references('id')->on('dictionary_table_names')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tableName');
            $table->string('english');
            $table->string('hungarian1')->nullable();
            $table->string('hungarian2')->nullable();
            $table->string('hungarian3')->nullable();
            $table->string('hungarian4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary_table_values');
    }
};
