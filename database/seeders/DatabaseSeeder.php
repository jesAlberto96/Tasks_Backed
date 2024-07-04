<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Configuration\PermissionSeeder::class);
        $this->call(Configuration\RoleSeeder::class);
        $this->call(User\UserSeeder::class);
    }
}
