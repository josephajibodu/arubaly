<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'josephajibodu@gmail.com',
            'username' => 'cremirdevio',
        ]);

        User::factory(10)->create();
        User::factory(25)->merchant()->create();

        $this->call([
            TransactionSeeder::class
        ]);
    }
}
