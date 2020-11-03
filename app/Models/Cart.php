<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\Store;

/**
 * Class Cart
 * @package App\Models
 *
 * @property Store session
 */
class Cart extends Model
{
    use HasFactory;

    /**
     * Illuminate\Contracts\Session\Session
     */
private Session $session;


    /**
     *  cart  key in session
     * @var string
     */
   private const CART_KEY = 'cart';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->session->get(self::CART_KEY, []);
    }

    /**
     * @param int $id
     * @param int $qty
     */
    public function add(int $id, int $qty): void
    {
        $this->session->put($this->identity($id), $qty);

    }

    /**
     * @param int $id
     * @return string
     */
    public function identity(int $id): string
    {
        return self::CART_KEY . '.' . $id;
    }

    public function productsList()
    {
       $cart = $this->list();
       return Product::whereIn('id', array_keys($cart))->get()
           ->map(function (Product $product) use ($cart) {
               return (object)[
                   'id' => $product->id,
                   'name' => $product->name,
                   'price' => $product->price,
                   'qty' => $qty = $cart[$product->id],
                   'total' => $product->price * $qty,
               ];
           });
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCurrentQty(int $id)
    {
        return $this->session->get($this->identity($id), 0);
    }

    /**
     * @param int $id
     */
    public function remove(int $id): void
    {
        $this->session->forget($this->identity($id));
    }

    /**
     *
     */
    public function delete(): void
    {
        $this->session->forget(self::CART_KEY);
    }







    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
