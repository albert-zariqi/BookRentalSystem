<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $available_genres = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        return [
            'name' => $this->faker->word(),
            'style' => $available_genres[rand(0, 7)]
        ];
    }
}
