<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        $admin->assignRole('Admin');
    }
}
