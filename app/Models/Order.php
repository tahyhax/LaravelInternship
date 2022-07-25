<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $slug
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property int|null $user_id
 * @property int $payment_methods_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PaymentMethod $paymentMethod
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read User|null $user
 * @mixin \Eloquent
 * @property-read mixed $full_name
 */
class Order extends Model
{
    use HasFactory;

    public static $statusList = [
        'approved', 'canceled', 'closed', 'new'
    ];

    protected $fillable = [
        'address', 'status', 'payment_methods_id', 'user_id',
        'slug', 'email', 'phone', 'first_name', 'last_name'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('qty')->as('orderItem');
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . $this->last_name;
    }
}
