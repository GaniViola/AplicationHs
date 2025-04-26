<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true); // contoh: "Premium Cleaning Service"

        return [
            'category_id' => mt_rand(1, 5), // otomatis buat category kalau belum ada
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 1000), // harga antara 100 - 1000
            'image' => $this->faker->imageUrl(640, 480, 'business', true), // contoh image URL
        ];
    }
}
