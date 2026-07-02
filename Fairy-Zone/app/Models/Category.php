<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


#[Fillable(['name', 'description'])]
#[Hidden(['created_at', 'updated_at'])]

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    Protected $table = 'categories';
    


    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($c) => $c->slug = Str::slug($c->name));
        static::updating(fn($c) => $c->isDirty('name') 
            ? $c->slug = Str::slug($c->name) : null);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
