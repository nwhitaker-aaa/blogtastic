<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Cocur\Slugify\Slugify;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $slugify = new Slugify();
        $title = fake()->text(10);
        return [
            'title' => $title,
            'slug' => $slugify->slugify($title),
            'author' => fake()->name(),
            'description' => fake()->sentence(),
            'details' => fake()->paragraph(20),
            'created_at' => now(),
        ];
    }
}
