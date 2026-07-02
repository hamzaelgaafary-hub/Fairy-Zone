<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;




#[Fillable([
    'name', 
    'slug', 
    's_code',
    'description', 
    'price', 
    'sale_price', 
    'is_featured', 
    'is_active',
    'stock', 
    'category_id',
    'product_id',
    'image',
    'is_primary',
    'sort_order'
    
    ])]
#[Hidden(['created_at', 'updated_at'])]

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    Protected $table = 'products';
    
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'price'       => 'decimal:2',
    ];

    //          slug يستخدم هذا الكود لتوليد 
    // تلقائيًا عند إنشاء أو تحديث المنتج بناءً على الاسم 

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($p) => $p->slug = Str::slug($p->name));
        static::updating(fn($p) => $p->isDirty('name') 
            ? $p->slug = Str::slug($p->name) : null);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query->when($filters['category'] ?? null, fn($q, $v) =>
            $q->where('category_id', $v))
        ->when($filters['search'] ?? null, fn($q, $v) =>
            $q->where('name', 'like', "%{$v}%"))
        ->when($filters['sort'] ?? null, fn($q, $v) => match($v) {
            'price_asc'  => $q->orderBy('price'),
            'price_desc' => $q->orderByDesc('price'),
            'newest'     => $q->latest(),
            default      => $q
        });

        return $query;
    }


}
