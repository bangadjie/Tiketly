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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('asal_keberangkatan');
            $table->string('tujuan_keberangkatan');
            $table->dateTime('keberangkatan');
            $table->dateTime('kedatangan');
            $table->double('harga');
            $table->foreignId('id_kereta')->constrained('kereta')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
