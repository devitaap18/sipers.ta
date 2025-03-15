<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('departemen');
            $table->date('tanggal_pemohon');
            $table->string('perihal');
            $table->text('deskripsi');
            $table->enum('status_vp', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('deskripsi_status_vp')->nullable();
            $table->enum('status_bpo', ['belum diproses', 'sedang diproses', 'selesai'])->default('belum diproses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};
