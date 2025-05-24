<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersCustomer = User::where('role', 'customer')->pluck('id');
        $usersWorker = User::where('role', 'worker')->pluck('id');
        return [
            'user_id'           => $usersCustomer->random(),
            'total_pembayaran'  => $this->faker->numberBetween(10000, 500000),
            'kembalian'         => $this->faker->numberBetween(10000, 50000),
            'tanggal_pemesanan' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status'            => 'pending_setoran',
            'metode_pembayaran' => $this->faker->randomElement(['tunai', 'non-tunai']),
            'worker_id'         => $usersWorker->random(),
        ];
    }
}
