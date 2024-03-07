<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create orders
        Order::factory()->create();
    }
}
