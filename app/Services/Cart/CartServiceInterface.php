<?php
namespace App\Services\Cart;

use Illuminate\Support\Collection;

interface CartServiceInterface {

    /**
     * @return Collection
     */
    public function productsList(): Collection;

}
?>