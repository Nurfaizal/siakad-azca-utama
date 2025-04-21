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
        Schema::create('salary_bonuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("salary_id")->nullable();
            $table->string("salary_bonus_description")->nullable();
            $table->integer("salary_bonus")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_bonuses');
    }
};
