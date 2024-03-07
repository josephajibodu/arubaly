<?php

namespace Database\Seeders;

use App\Models\Conversion;
use App\Models\Order;
use App\Models\Transfer;
use App\Models\Withdrawal;
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

        Withdrawal::factory(20)->create();

        Transfer::factory(20)->create();

        Conversion::factory(20)->create();

//        Order::factory(20)->create();
    }
}
