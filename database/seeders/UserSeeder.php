<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Staf Agen X',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => 'user.png'
        ]);
    }
}
