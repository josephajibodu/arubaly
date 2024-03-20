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
        if (! $admin = User::where('email', 'josephajibodu@gmail.com')->first()) {
            $admin = User::factory()->merchant()->create([
                'email' => 'josephajibodu@gmail.com',
                'username' => 'cremirdevio',
            ]);
        }

//        User::factory(10)->create();
//        $merchants = User::factory(25)->merchant()->create();
//        $compilers = User::factory(5)->merchant()->create();
//
        Role::firstOrCreate(['name' => 'merchant']);
        Role::firstOrCreate(['name' => 'compiler']);
        Role::firstOrCreate(['name' => 'admin']);
//
        $admin->assignRole('admin', 'merchant');
//
//        foreach ($merchants as $merchant) {
//            $merchant->assignRole($merchantRole);
//        }
//
//        foreach ($compilers as $compiler) {
//            $compiler->assignRole($compilerRole);
//        }
//
//        $this->call([
//            TransactionSeeder::class,
//        ]);
    }
}
