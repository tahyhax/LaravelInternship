<?php

namespace App\Http\Livewire;

use App\Models\Product;
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


    public function mount()
    {
       $this->hydrate();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function hydrate(): void
    {
        $this->cart = $this->cartService()->list();
        $this->products = tap(
            $this->products(),
            function(Collection $products) {
                return $this->total = $products->sum('total');
            }
        )->toArray();
    }

    /**
     * @return Collection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function products(): Collection
    {
        if (empty($this->cart)) {
            return new Collection;
        }

        return $this->cartService()->productsList();
//            ->map(function (Product $product) {
//                return (object)[
//                    'id' => $product->id,
//                    'name' => $product->name,
//                    'price' => $product->price,
//                    'qty' => $qty = $this->cart[$product->id],
//                    'total' => $product->price * $qty,
//                ];
//            });
    }

    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function remove(int $id): void
    {
        $this->cartService()->remove($id);
        $this->update();
    }


    /**
     * Update basket.
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

        $this->cartService()->add($id, $this->cart[$id] + 1);
        $this->update();
    }


    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function decrease(int $id): void
    {
        if (($qty = $this->cart[$id] - 1) < 1) {
            $this->remove($id);
        } else {
            $this->cartService()->add($id, $qty);
            $this->update();
        }
    }


    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function cartService()
    {
        return app()->make(\App\Models\Cart::class);
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
//            ->extends('layouts.app');
//            ->layout('front.layouts.app', ['title' => 'Cart'])
//            ->layout('front.layouts.app')
//            ->slot('main');
            ->extends('front.layouts.app');
//            ->section('content');
    }
}
