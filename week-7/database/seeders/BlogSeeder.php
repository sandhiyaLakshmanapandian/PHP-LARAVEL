<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        if ($users->isEmpty()) {
            // If no users exist, create some first
            $users = User::factory(5)->create();
        }

        // Create blogs for each user
        foreach ($users as $user) {
            Blog::factory(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
