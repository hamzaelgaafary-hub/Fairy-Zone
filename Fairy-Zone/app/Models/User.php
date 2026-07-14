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
        
       // التحقق من لوحة الإدارة
        if ($panel->getId() === 'admin') {
            return $this->role === 'admin'; // افترض وجود حقل role في قاعدة البيانات
        }

        // التحقق من لوحة المستخدم
        if ($panel->getId() === 'user') {
            return $this->role === 'user';
        }
        return false;
    }
}
