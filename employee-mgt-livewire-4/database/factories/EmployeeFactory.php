<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
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
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'department' => fake()->randomElement(['IT', 'HR', 'Finance', 'Marketing', 'Sales', 'Engineering']),
            'position' => fake()->jobTitle(),
            'salary' => fake()->randomFloat(2, 30000, 150000),
            'hire_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'status' => fake()->boolean(80),
        ];
    }
}
