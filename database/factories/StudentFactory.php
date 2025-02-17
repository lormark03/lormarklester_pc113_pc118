<?php

namespace Database\Factories;
use App\Models\Student;
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
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->state(),
            'age' => fake()->randomDigit(),
            'email_address' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'emergency_contact' => fake()->phoneNumber()
        ];
    }
}
