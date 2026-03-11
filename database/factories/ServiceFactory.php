<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
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
        $name = $this->faker->unique()->words(3, true);

        return [
            'category_id' => mt_rand(1, 5),
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'image' => $this->faker->imageUrl(640, 480, 'business', true),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($service) {
            $users = User::where('role', 'worker')->inRandomOrder()->take(rand(1, 3))->pluck('id');
            $service->user()->attach($users);
        });
    }

}
