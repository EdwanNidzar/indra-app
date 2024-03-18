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
        Schema::create('pkls', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('tempat_pkl');
            $table->string('lama_pkl');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('bukti_pembayaran');
            $table->string('surat_pernyataan');
            $table->enum('status', ['approve', 'reject', 'pending'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkls');
    }
};
