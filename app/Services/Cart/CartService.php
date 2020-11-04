<?php

namespace App\Services\Cart;

// если по нормальному то сделать еще  сервис и добавить его в DI. в данном случае  ето over engineering
use App\Models\Product;
use Illuminate\Support\Collection;
use App\Services\Cart\Repositories\CartRepositoryInterface;

class CartService
{
    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @return Collection
     */
    public function productsList(): Collection
    {
        $cart = $this->cartRepository->cart();

        if (!$cart) {
            return new Collection;
        }

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
     * @param $id
     * @param $qty
     */
    public function add(int $id, int $qty)
    {
        $currentQty = $this->getCurrentQty($id);
        $qty = $currentQty + $qty;

        return $qty ? $this->cartRepository->add($id, $qty): $this->cartRepository->remove($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCurrentQty(int $id): int
    {
        return $this->cartRepository->getCurrentQty($id);
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return array_sum($this->cartRepository->cart());
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function increase(int $id)
    {
//        $qty = $this->getCurrentQty($id) + 1;

        return $this->add($id, 1);
    }


    /**
     * @param int $id
     */
    public function decrease(int $id)
    {
//        $qty = $this->cartRepository->getCurrentQty($id) - 1;

        return $this->add($id, -1);
    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {
        return $this->cartRepository->remove($id);
    }

    /**
     * delete  all  cart
     */
    public function delete()
    {
        return $this->cartRepository->delete();
    }
}