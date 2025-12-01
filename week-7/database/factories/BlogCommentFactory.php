<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'blog_id' => \App\Models\Blog::factory(),
            'user_id' => \App\Models\User::factory(),
            'comment' => $this->faker->sentences(2, true),
        ];
    }
}
