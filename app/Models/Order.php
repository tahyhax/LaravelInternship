<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PaymentMethod $paymentMethod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('qty')->as('orderItem');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . $this->last_name;
    }
}
