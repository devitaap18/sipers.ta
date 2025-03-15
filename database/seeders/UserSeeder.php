<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Pak Budi',
                'username' => 'budiadmin',
                'nik' => '1001',
                'role' => 'admin',
            ],
            [
                'name' => 'Pak Ari',
                'username' => 'arivp',
                'nik' => '1002',
                'role' => 'vp',
            ],
            [
                'name' => 'Pak James',
                'username' => 'jamesbpo',
                'nik' => '1003',
                'role' => 'bpo',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
