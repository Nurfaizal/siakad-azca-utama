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
        Schema::create('staff_note', function (Blueprint $table) {
            $table->id('id_staff_note');
            $table->unsignedBigInteger('id_staff');
            $table->text('note');
            $table->string('image');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->timestamps();

            $table->foreign('id_staff')->references('id_staff')->on('staff')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_note');
    }
};
