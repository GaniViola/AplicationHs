<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orders;
use App\Models\Service;
use App\Models\OrderDetails;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $services = Service::inRandomOrder()->first();
        $orders = Orders::inRandomOrder()->first();
        $quantity = 1;
        $price = $services->price;
        $subtotal = $price * $quantity;

        return [
            'id_orders'     => $orders,
            'service_id'    => $services,
            'quantity'      => $quantity,
            'price'         => $price,
            'subtotal'      => $subtotal
        ];
    }
}
