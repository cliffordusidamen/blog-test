<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(10),
            'cover_image' => 'https://via.placeholder.com/800.png',
            'cover_thumbnail' => 'https://via.placeholder.com/200.png',
            'published_at' => now()->subtract('days', mt_rand(1, 10)),
        ];
    }
}
