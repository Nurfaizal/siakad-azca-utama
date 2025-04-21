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
        Schema::create('semester', function (Blueprint $table) {
            $table->id('id_semester');
            $table->string('name');
            $table->string('code');
            $table->foreignId('id_semester_type');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->boolean('final_level')->default('0');
            $table->integer('attendance');
            $table->integer('daily_score');
            $table->integer('mid_term_score');
            $table->integer('final_term_score');
            $table->timestamps();

            $table->foreign('id_semester_type')->references('id_semester_type')->on('semester_type')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester');
    }
};
