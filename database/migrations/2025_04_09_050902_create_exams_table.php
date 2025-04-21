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
        Schema::create('exams', function (Blueprint $table) {
            $table->id('id_exam');
            $table->string('name'); // 1
            $table->string('code')->unique(); // 1
            $table->foreignId('id_subject'); // 2
            $table->foreignId('id_exam_category'); // 3
            $table->date('exam_date'); // 4
            $table->time("start_time"); // 5
            $table->time("end_time"); // 6
            $table->foreignId('id_room'); // 7
            $table->string('supervisor'); // 8
            $table->string('corrector'); // 9
            $table->boolean('show_poin')->default('0'); // 10
            $table->enum('status', ['Aktif', 'Non-Aktif']); // 11
            $table->text('note'); // 12
            $table->timestamps();

            $table->foreign('id_subject')->references('id_subject')->on('subject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_exam_category')->references('id_exam_category')->on('exam_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_room')->references('id_room')->on('room')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
