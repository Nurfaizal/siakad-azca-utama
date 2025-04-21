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
        Schema::create('guardian', function (Blueprint $table) {
            $table->id('id_guardian');
            $table->unsignedBigInteger('id_student');
            $table->unsignedBigInteger('id_user');
            $table->string('guardian_name');
            $table->text('guardian_phone');
            $table->text('alt_phone')->nullable();
            $table->string('guardian_job');
            $table->text('guardian_address');
            $table->timestamps();

            $table->foreign('id_student')->references('id_student')->on('student')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian');
    }
};
