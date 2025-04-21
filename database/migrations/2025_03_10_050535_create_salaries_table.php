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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id');
            $table->integer('tax')->nullable();
            $table->integer('paid');
            $table->enum('payment_method', ['tunai', 'transfer', 'debit']);
            $table->text('description')->nullable();
            $table->integer('salary_deduction_total')->nullable();
            $table->integer('salary_bonus_total')->nullable();
            $table->enum('month', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
            $table->integer('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
