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
        Schema::create('gps_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('distance');
            $table->integer('late_tolerance');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum("status", ['Aktif', "Non-Aktif"]);
            $table->text('address');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_locations');
    }
};
