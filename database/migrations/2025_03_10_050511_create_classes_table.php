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
        Schema::create('classes', function (Blueprint $table) {
            $table->id('id_class');
            $table->string('name');
            $table->enum('level', ['TK', 'SD', 'SMP', 'SMA']);
            $table->unsignedBigInteger('id_skill')->nullable();
            $table->time('time_in', precision: 0);
            $table->time('time_out', precision: 0);
            $table->unsignedBigInteger('id_staff');
            $table->unsignedBigInteger('id_year');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->timestamps();

            $table->foreign('id_skill')->references('id_skill')->on('skill_program')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_staff')->references('id_staff')->on('staff')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_year')->references('id_year')->on('school_year')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
