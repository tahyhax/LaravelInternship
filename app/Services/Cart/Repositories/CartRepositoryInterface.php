<?php

namespace App\Services\Cart\Repositories;

interface CartRepositoryInterface {

    /**
     * Get all items in the cart.
     *
     * @return array
     */
    public function cart();

    /**
     * @param int $id
     * @param int $qty
     */
    public function add(int $id, int $qty);

    /**
     * @param int $id
     * @return string
     */
    public function identity(int $id): string;

    /**
     * @param int $id
     * @return mixed
     */
    public function getCurrentQty(int $id): int;

    /**
     * @param int $id
     */
    public function remove(int $id): void;

    /**
     * delete  all  cart
     */
    public function delete(): void;
}

?>