<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama user
            $table->string('username')->unique(); // Username unik
            $table->string('nik')->unique(); // NIK (Nomor Induk Kerja), unik
            $table->enum('role', ['admin', 'vp', 'bpo'])->default('admin'); // Role pengguna
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
