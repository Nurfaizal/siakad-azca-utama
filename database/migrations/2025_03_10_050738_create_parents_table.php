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
        Schema::create('parent', function (Blueprint $table) {
            $table->id('id_parent');
            $table->unsignedBigInteger('id_student');
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_job')->nullable();
            $table->text('father_address')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_job')->nullable();
            $table->text('mother_address')->nullable();
            $table->timestamps();

            $table->foreign('id_student')->references('id_student')->on('student')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent');
    }
};
