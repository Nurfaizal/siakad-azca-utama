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
        Schema::create('level', function (Blueprint $table) {
            $table->id('id_level');
            $table->unsignedBigInteger('id_user');
            $table->enum('level', ['yayasan', 'admin', 'guru sma', 'guru smp', 'guru sd', 'guru tk', 'staff', 'siswa', 'wali']);
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level');
    }
};
