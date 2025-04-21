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
        Schema::create('student_note', function (Blueprint $table) {
            $table->id('id_student_note');
            $table->unsignedBigInteger('id_class');
            $table->unsignedBigInteger('id_student');
            $table->text('note');
            $table->string('image');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->timestamps();

            $table->foreign('id_class')->references('id_class')->on('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_student')->references('id_student')->on('student')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_note');
    }
};
