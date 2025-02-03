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
        Schema::create('detail_pembelian_tiket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIK');
            $table->foreignId('id_pembelian_tiket')->constrained('pembelian_tiket')->onDelete('cascade');
            $table->foreignId('id_kursi')->constrained('kursi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian_tiket');
    }
};
