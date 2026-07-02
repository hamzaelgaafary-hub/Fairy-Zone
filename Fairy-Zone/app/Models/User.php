<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Panel;

#[Fillable(['name', 'email', 'phone', 'role', 'password'])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function defaultAddress(): HasOne
    {
        return $this->hasOne(UserAddress::class)
                    ->where('is_default', true);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        
        return $this->role === 'admin';

        // أو إذا كان لديك حقل في جدول المستخدمين اسمه is_admin:
        // return $this->is_admin === true;
    }
}
