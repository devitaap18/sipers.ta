<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriAset;

class KategoriAsetSeeder extends Seeder
{
    public function run()
    {
        KategoriAset::insert([
            ['nama' => 'Elektronik', 'kode' => 'ELK'],
            ['nama' => 'Furnitur', 'kode' => 'FUR'],
            ['nama' => 'Kendaraan', 'kode' => 'KND'],
        ]);
    }
}
