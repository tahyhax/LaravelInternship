<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartHeader extends Component
{
    public $qty;

    protected $listeners = [

        'basketUpdated' => 'update',
    ];


    public function mount()
    {
        $this->update();
    }

    public function update()
    {
        $this->qty = array_sum(app(\App\Models\Cart::class)->cart());
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.cart-header');
    }
}
