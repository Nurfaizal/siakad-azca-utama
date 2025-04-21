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
        Schema::create('student', function (Blueprint $table) {
            $table->id('id_student');
            $table->unsignedBigInteger('id_class');
            $table->bigInteger('nisn')->nullable();
            $table->bigInteger('nis');
            $table->string('name');
            $table->unsignedBigInteger('id_user');
            $table->text('address');
            $table->text('place_birth');
            $table->text('birth_date');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('family_status');
            $table->string('child_order');
            $table->text('phone');
            $table->unsignedBigInteger('id_religion');
            $table->text('prev_school')->nullable();
            $table->string('study_program')->nullable();
            $table->bigInteger('examinee_number')->nullable();
            $table->bigInteger('card_number')->nullable();
            $table->string('image')->nullable();
            $table->date('receive_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_class')->references('id_class')->on('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_religion')->references('id_religion')->on('religion')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
