<?php

namespace Database\Seeders\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Usuario Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
        ])->assignRole('superadmin');

        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@usuario.com',
            'password' => bcrypt('secret'),
        ])->assignRole('user');
    }
}
