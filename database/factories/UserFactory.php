<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\MerchantAvailability;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $fn = fake()->firstName,
            'lastname' => $ln = fake()->lastName,
            'username' => fake()->userName,
            'phonenumber' => fake()->phoneNumber,
            'whatsappnumber' => fake()->phoneNumber,
            'bankname' => fake()->randomElement(['Access Bank', 'Opay Ltd', 'Kuda Bank', '9PSB', 'First Bank', 'GTCO']),
            'accountname' => "$fn $ln",
            'accountnumber' => str_pad(rand(1, 9999999999), 10, '0', STR_PAD_LEFT),

            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * merchant account state
     */
    public function merchant(): static
    {
        return $this->state(fn (array $attributes) => [
            'rate' => fake()->numberBetween(100, 345) * 100,
            'min_amount' => fake()->numberBetween(20_000, 50_000) * 100,
            'max_amount' => fake()->numberBetween(100_000, 500_000) * 100,
            'payment_type' => fake()->randomElement(['Bank Transfer']),
            'terms' => fake()->sentence,
            'availability' => fake()->randomElement(MerchantAvailability::values()),
        ]);
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            Wallet::factory()->state(['currency' => Currency::AWG])->create(['user_id' => $user->id]);
            Wallet::factory()->state(['currency' => Currency::NGN])->create(['user_id' => $user->id]);
            Wallet::factory()->state(['currency' => Currency::USD])->create(['user_id' => $user->id]);
        });
    }
}
