<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Admin Sarno',
            'email' => 'Sarno@fic12.com',
            'password' => Hash::make('12345678'),
            'phone' => '081280833537',
            'roles'=> 'ADMIN',
        ]);
    }
}
