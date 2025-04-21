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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id');
            $table->text('question');
            $table->string('question_image')->nullable();
            $table->enum('type', ['multi', 'binary', 'essay']);
            $table->integer('point')->default(0);
            $table->timestamps();

            $table->foreign('exam_id')->references('id_exam')->on('exams')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
