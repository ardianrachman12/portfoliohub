<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserView;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '6281221344354',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        UserView::create([
            'user_id' => '1',
            'views' => '0',
        ]);
    }
}
