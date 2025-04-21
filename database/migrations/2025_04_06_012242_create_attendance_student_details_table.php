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
        Schema::create('attendance_student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_attendance_student");
            $table->foreignId("id_student");
            $table->enum("status", ['hadir', 'sakit', 'izin', 'alpha']);
            $table->timestamps();

            $table->foreign('id_student')->references('id_student')->on('student')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_attendance_student')->references('id_attendance_student')->on('attendance_students')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_student_details');
    }
};
