<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $s1 = $this->faker->numberBetween(50,100);
            $s2 = $this->faker->numberBetween(50,100);
            $s3 = $this->faker->numberBetween(50,100);
            $s4 = $this->faker->numberBetween(50,100);
            $s5 = $this->faker->numberBetween(50,100);
            $total=$s1+$s2+$s3+$s4+$s5;
            $percentage=round(($total/500)*100,2);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'department' => $this->faker->randomElement(['CSE','IT','ECE']),
            'subject1' => $s1,
            'subject2' => $s2,
            'subject3' => $s3,
            'subject4' => $s4,
            'subject5' => $s5,
            'total'=>$total,
            'percentage'=>$percentage,
        ];
    }
}
