<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();

        User::create([
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'username' => 'budis',
            'email' => 'budi123@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'gender' => 'laki-laki',
            'date_of_birth' => '2024-01-17 02:32:22',
            'role' => 'user',
            'country' => 'Indonesia',
        ]);
    }
}
