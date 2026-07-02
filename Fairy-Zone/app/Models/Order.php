<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


#[Fillable([
    'user_id',
    'total_amount',
    'order_number',
    'payment_method',
    'status',
    'notes',
    'shipping_name',
    'shipping_phone',
    'shipping_address',
    'shipping_city',
    'shipping_state',
    ])]
#[Hidden(['created_at', 'updated_at'])]

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;



    Protected $table = 'orders';

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($o) => 
            $o->order_number = 'ORD-' . strtoupper(Str::random(8))
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    /* 
    تم استبدالة باضافة مباشرة من العميل حتي لا يتم 
    فقد او ـاثر الطلبات القديمة في حالة تم حذف العنوان المسجل 
    public function address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }
    */

}
