<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aset;

class AsetSeeder extends Seeder {
    public function run() {
        Aset::create([
            'nama' => 'Laptop Dell',
            'kode_aset' => 'AST001',
            'kategori_id' => 1, // Sesuaikan dengan kategori yang ada
            'stok' => 10
        ]);
    }
}
