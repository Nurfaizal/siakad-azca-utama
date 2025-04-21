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
        Schema::create('schedule_subjects', function (Blueprint $table) {
            $table->id("id_schedule");
            $table->foreignId("id_class");
            $table->foreignId("id_subject");
            $table->foreignId("id_staff");
            $table->enum("day", ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"]);
            $table->string("location");
            $table->string("link")->nullable();
            $table->time("start_time");
            $table->time("end_time");
            $table->enum("status", ["Aktif", "Non-Aktif"]);
            $table->timestamps();

            $table->foreign('id_staff')->references('id_staff')->on('staff')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_subject')->references('id_subject')->on('subject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_class')->references('id_class')->on('classes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_subjects');
    }
};
