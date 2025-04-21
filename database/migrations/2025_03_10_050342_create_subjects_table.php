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
        Schema::create('subject', function (Blueprint $table) {
            $table->id('id_subject');
            $table->string('name');
            $table->string('subject_code');
            $table->unsignedBigInteger('id_subcontent');
            $table->enum('level', ['TK', 'SD', 'SMP', 'SMA']);
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->timestamps();

            $table->foreign('id_subcontent')->references('id_subcontent')->on('subject_content')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
