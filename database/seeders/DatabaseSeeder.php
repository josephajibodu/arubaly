<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
        $merchants = User::factory(25)->merchant()->create();

        $merchantRole = Role::create(['name' => 'merchant']);
        $compilerRole = Role::create(['name' => 'compiler']);
        Role::create(['name' => 'admin']);

        foreach ($merchants as $merchant) {
            $merchant->assignRole($merchantRole);
        }

        $this->call([
            TransactionSeeder::class,
        ]);
    }
}
