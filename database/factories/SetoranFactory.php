<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orders;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setoran>
 */
class SetoranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $orders = Orders::where('status', 'pending_setoran')->pluck('id');
        $workers = User::where('role', 'worker')->pluck('id');

        return [
            'order_id'         => $orders->random(),
            'worker_id'        => $workers->random(),
            'jumlah_setoran'   => $this->faker->numberBetween(50000, 500000),
            'jumlah_admin'     => $this->faker->numberBetween(10000, 100000),
            'jumlah_pekerja'   => $this->faker->numberBetween(10000, 100000),
            'tanggal_setoran'  => $this->faker->dateTimeBetween('-1 week', 'now'),
            'status_setoran'   => 'selesai',
        ];
    }
}
