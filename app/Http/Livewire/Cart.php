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


    public function hydrate(): void
    {
        $this->products = $this->products();
        $this->total = $this->products->sum('total');
    }

    /**
     * @return Collection
     */
    private function products(): Collection
    {
        return $this->cartService->productsList();
    }

    /**
     * @param int $id
     */
    public function remove(int $id): void
    {
        $this->cartService->remove($id);
        $this->update();
    }

    /**
     * @param int $id
     * @param int $qty
     */
    public function add(int $id, int $qty): void
    {
        $this->cartService->add($id, $qty);
        $this->update();
    }


    /**
     * event  for  update other carts.
     *
     * @return void
     */
    private function update(): void
    {
        $this->emit('basketUpdated');
    }


    /**
     * @param int $id
     */
    public function increase(int $id): void
    {
        $this->cartService->increase($id);
        $this->update();
    }


    /**
     * @param int $id
     */
    public function decrease(int $id): void
    {
        $this->cartService->decrease($id);
        $this->update();
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
