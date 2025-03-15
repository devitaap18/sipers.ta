<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode_aset')->unique();
            $table->foreignId('kategori_id')->constrained('kategori_aset')->onDelete('cascade');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('asets');
    }
};
