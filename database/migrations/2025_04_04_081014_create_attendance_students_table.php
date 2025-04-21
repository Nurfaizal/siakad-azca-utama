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
        Schema::create('attendance_students', function (Blueprint $table) {
            $table->id('id_attendance_student');
            $table->foreignId("id_schedule");
            $table->time("check_in")->nullable();
            $table->time("check_out")->nullable();
            $table->enum("mode", ['offline', 'online'])->default("offline");
            $table->string("image")->nullable();
            $table->text("description")->nullable();
            $table->string("created_by");
            $table->date("date");
            $table->timestamps();

            $table->foreign('id_schedule')->references('id_schedule')->on('schedule_subjects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_students');
    }
};
