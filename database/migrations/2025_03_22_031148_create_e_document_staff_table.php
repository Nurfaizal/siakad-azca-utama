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
        Schema::create('e_document_staff', function (Blueprint $table) {
            $table->id('id_e_document_staff');
            $table->foreignId('id_staff');
            $table->foreignId('id_category');
            $table->string('file');
            $table->timestamps();

            $table->foreign('id_staff')->references('id_staff')->on('staff')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_category')->references('id_category')->on('document_category')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_document_staff');
    }
};
