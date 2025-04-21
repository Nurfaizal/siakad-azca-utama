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
        Schema::create('personal_entry_hour', function (Blueprint $table) {
            $table->id('id_personal');
            $table->unsignedBigInteger('id_staff');
            $table->time('monday_in', precision: 0); // senin
            $table->time('monday_out', precision: 0);
            $table->time('tuesday_in', precision: 0); // selasa
            $table->time('tuesday_out', precision: 0);
            $table->time('wednesday_in', precision: 0); // rabu
            $table->time('wednesday_out', precision: 0);
            $table->time('thursday_in', precision: 0); // kamis
            $table->time('thursday_out', precision: 0);
            $table->time('friday_in', precision: 0); // jumat
            $table->time('friday_out', precision: 0);
            $table->time('saturday_in', precision: 0)->nullable();  // sabtu
            $table->time('saturday_out', precision: 0)->nullable();
            $table->time('sunday_in', precision: 0)->nullable();  // minggu
            $table->time('sunday_out', precision: 0)->nullable();
            $table->timestamps();

            $table->foreign('id_staff')->references('id_staff')->on('staff')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_entry_hour');
    }
};
