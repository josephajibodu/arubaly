<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\MerchantAvailability;
use App\Enums\TransactionType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * Relationships
     */
    public function user(): HasMany
    {
        return $this->hasMany(Wallet::class);
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
        return true;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
