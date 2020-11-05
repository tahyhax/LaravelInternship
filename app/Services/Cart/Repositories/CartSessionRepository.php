<?php

namespace App\Services\Cart\Repositories;

use Illuminate\Contracts\Session\Session;

/**
 * Class CartRepository
 * @package App\Services\Cart\Repositories
 *
 * @property Session session;
 */
class CartSessionRepository implements CartRepositoryInterface
{
    /**
     * @var Session 
     */
    private $session;


    /**
     * cart  key in session
     * @var string
     */
    private const CART_KEY = 'cart';


    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param int $id
     * @return string
     */
    private function identity(int $id): string
    {
        return self::CART_KEY . '.' . $id;
    }


    /**
     * Get all items in the cart.
     *
     * @return array
     */
    public function cart()
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
     * @return mixed
     */
    public function getCurrentQty(int $id): int
    {
        return $this->session->get($this->identity($id), 0);
    }

    /**
     * @param int $id
     */
    public function remove(int $id): void
    {
        $this->session->remove($this->identity($id));
    }

    /**
     * delete  all  cart
     */
    public function delete(): void
    {
        $this->session->forget(self::CART_KEY);
    }
}