<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Currency;
use App\Enums\MerchantAvailability;
use App\Enums\TransactionType;
use App\Models\Traits\WalletActions;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;
    use WalletActions;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'phonenumber',
        'whatsappnumber',
        'email',
        'password',

        'bankname',
        'accountname',
        'accountnumber',

        'rate',
        'min_amount',
        'max_amount',
        'availability',
        'payment_type',
        'terms'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'availability' => MerchantAvailability::class,
    ];

    protected $with = ['awg', 'ngn', 'usd'];

    public function avatar()
    {
        $address = strtolower( trim( $this->email ) );

        // Create an SHA256 hash of the final string
        $hash = hash( 'sha256', $address );

        // Grab the actual image URL
        return 'https://www.gravatar.com/avatar/' . $hash;
    }

    /**
     * Relationships
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function awg(): HasOne
    {
        return $this->hasOne(Wallet::class)->where('currency', Currency::AWG);
    }

    public function usd(): HasOne
    {
        return $this->hasOne(Wallet::class)->where('currency', Currency::USD);
    }

    public function ngn(): HasOne
    {
        return $this->hasOne(Wallet::class)->where('currency', Currency::NGN);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Transaction::class)->where('type', TransactionType::WITHDRAWAL);
    }

    public function conversions(): HasMany
    {
        return $this->hasMany(Transaction::class)->where('type', TransactionType::CONVERSION);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Transaction::class)->where('type', TransactionType::ORDER);
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(Transaction::class)->where('type', TransactionType::TRANSFER);
    }

    /**
     * Filament
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['admin', 'compiler']);
    }

    public function getFilamentName(): string
    {
        return "$this->first_name $this->last_name";
    }
}
