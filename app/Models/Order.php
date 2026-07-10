<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'total', 'status', 'payment_method', 'shipping_address', 'phone', 'full_name', 'city', 'notes', 'order_number'])]
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    private static function generateOrderNumber(): string
    {
        $prefix = 'EDM-' . now()->format('ymd');
        $last = static::where('order_number', 'like', "{$prefix}-%")
            ->orderByDesc('id')
            ->value('order_number');

        $next = $last ? (int) substr($last, -4) + 1 : 1;

        return "{$prefix}-" . str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
