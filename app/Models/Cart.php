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

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->session->get('cart', []);
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
        return 'cart.' . $id;
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
