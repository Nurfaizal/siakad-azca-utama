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
        Schema::create('dues_group', function (Blueprint $table) {
            $table->id('id_dues_group');
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['bulanan', 'non-bulanan']);
            $table->decimal('amount', total: 10, places: 0);
            $table->date('due_date');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_group');
    }
};
