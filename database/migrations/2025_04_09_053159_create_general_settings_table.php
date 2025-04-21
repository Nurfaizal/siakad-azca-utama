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
        Schema::create('general_setting', function (Blueprint $table) {
            $table->id('id_general_setting');
            $table->string('name'); // 1
            $table->string('npsn'); // 2
            $table->string('education_form'); // 3
            $table->string('school_status'); // 4
            $table->string('ownership_status'); // 5
            $table->foreignId('id_year'); // 6
            $table->string('neighborhood'); // 7
            $table->string('district'); // 8
            $table->string('province'); // 9
            $table->string('pos_code'); // 10
            $table->text('address'); // 11
            $table->text('phone')->nullable(); // 12
            $table->text('fax')->nullable(); // 13
            $table->string('email')->nullable(); // 14
            $table->text('website')->nullable(); // 15
            $table->text('principal'); // 16
            $table->text('principal_nip')->nullable(); // 17
            $table->text('administration_head')->nullable(); // 18
            $table->text('school_day'); // 19
            $table->text('vision')->nullable(); // 20
            $table->text('mission')->nullable(); // 21
            $table->string('logo'); // 22
            $table->timestamps();

            $table->foreign('id_year')->references('id_year')->on('school_year')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_setting');
    }
};
