<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 100, 600),
            'image' => 'https://picsum.photos/200/300?random='.$this->faker->numberBetween(1, 100),
        ];
    }
}
