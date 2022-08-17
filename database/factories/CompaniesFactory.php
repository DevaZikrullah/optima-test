<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            // 'logo' => $this->faker->image('storage/app/public', 100, 100, null, false),
            'logo' => $this->faker->imageUrl(100,100),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'website' => 'https://' . $this->faker->word() . '.com',
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
