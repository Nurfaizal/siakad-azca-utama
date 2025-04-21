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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('id_staff'); // 1
            $table->string('nip'); // 2
            $table->string('name'); // 3
            $table->unsignedBigInteger('id_user'); // 4
            $table->string('place_birth'); // 5
            $table->date('birth_date'); // 6
            $table->enum('gender', ['Laki-laki', 'Perempuan']); // 7
            $table->text('address'); // 8
            $table->string('image')->nullable(); // 9
            $table->date('join_date'); // 10
            $table->date('end_date'); // 11
            $table->string('no_ktp'); // 12
            $table->string('phone'); // 13
            $table->string('education'); // 14
            $table->decimal('salary', total: 10, places: 0); // 15
            $table->unsignedBigInteger('id_division'); // 16
            $table->string('status'); // 17
            $table->string('part'); // 18
            $table->string('card_number'); // 19
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_division')->references('id_division')->on('staff_division')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
