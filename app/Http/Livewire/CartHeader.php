<?php

namespace App\Http\Livewire;

use App\Services\Cart\CartService;
use Livewire\Component;

class CartHeader extends Component
{
    public $qty;

    /**
     * @var CartService $cartService
     */
    protected $cartService;

    public function __construct()//CartService $cartService
    {
//        $this->cartService = $cartService;
        $this->cartService = app(CartService::class);
    }


    protected $listeners = [

        'basketUpdated' => 'update',
    ];


    public function mount()
    {
        $this->update();
    }

    public function update()
    {
        $this->qty = $this->cartService->getQty();
//        $this->qty = array_sum(app(\App\Models\Cart::class)->cart());
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.cart-header');
    }
}
