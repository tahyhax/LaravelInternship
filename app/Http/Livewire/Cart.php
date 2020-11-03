<?php

namespace App\Http\Livewire;

use App\Services\Cart\CartService;
use Illuminate\Support\Collection;
use Livewire\Component;

class Cart extends Component
{

    /**
     * @var array
     */
    public $cart = [];

    /**
     * @var array
     */
    public $products = [];


    /**
     * @var float
     */
    public $total = 0.00;

    /**
     * @var CartService $cartService
     */
    protected $cartService;

    public function __construct()
    {
        $this->cartService = app(CartService::class);
    }


    public function mount()
    {
       $this->hydrate();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function hydrate(): void
    {
//        $this->cart = $this->cartService->cart();
        $this->products = $this->products();
        $this->total = $this->products->sum('total');
    }

     /**
     * @return Collection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function products(): Collection
    {
        return $this->cartService->productsList();
    }

    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function remove(int $id): void
    {
        $this->cartService->remove($id);
        $this->update();
    }

    /**
     * @param int $id
     * @param int $qty
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function add(int $id, int $qty): void
    {
        $this->cartService->add($id, $qty);
        $this->update();
    }


    /**
     * ivent  for  update other carts.
     *
     * @return void
     */
    private function update(): void
    {
        $this->emit('basketUpdated');
    }


    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function increase(int $id): void
    {
        $this->cartService->increase($id);
        $this->update();
//        $this->add($id, $this->cart[$id] + 1);
    }


    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function decrease(int $id): void
    {
//        $qty = $this->cart[$id] - 1;
//        $qty < 1 ?  $this->remove($id) :  $this->add($id, $qty);

        $this->cartService->decrease($id);
        $this->update();
    }


    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function cartService()
    {
        return new CartService();

        return app()->make(CartService::class);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        return  redirect()->route('checkout.show');
    }
    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.cart')
            ->extends('front.layouts.app');
    }
}
