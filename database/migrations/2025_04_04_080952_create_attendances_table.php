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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_user");
            $table->foreignId("id_gps_location");
            $table->time("check_in")->nullable();
            $table->time("check_out")->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->enum("status", ['hadir', 'sakit', 'izin', 'alpha']);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_gps_location')->references('id')->on('gps_locations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
