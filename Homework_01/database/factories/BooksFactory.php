<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description'=>fake()->sentence(5),
            'author_id' => \App\Models\Author::factory(), // assumes you have an Author model/factory
            'published_year' => fake()->year(),
            
        ];
    }
}
