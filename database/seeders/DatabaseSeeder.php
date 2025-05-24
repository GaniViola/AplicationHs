<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Service;
use App\Models\Setoran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::factory(8)->create();
        
        User::factory()->create([
            'username' => 'alex',
            'email' => 'taktaoh538@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'bondowoso',
            'phone' => '085388393834',
            'role' => 'customer'
        ]);

        User::factory()->create([
            'username' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'bondowoso',
            'phone' => '085388393834',
            'role' => 'admin'
        ]);
        
        Category::factory()->count(5)->create();
        Service::factory()->count(10)->create();
        Orders::factory()->count(10)->create();
        OrderDetails::factory()->count(10)->create();
        Setoran::factory()->count(10)->create();
    }


}
