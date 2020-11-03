<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Cart as mCart;


class CartAddButton extends Component
{

    /**
     * @var
     */
    public $onlyButton;

    /**
     * @var
     */
    public $productId;

    /**
     * @var
     */
    public $qty = 1;

    /**
     * @var int
     */
    public $currentQty = 0;

    /**
     * @param int $productId
     * @param bool $onlyButton
     */
    public function mount(int $productId, bool $onlyButton = false): void
    {
        $this->productId = $productId;
        $this->onlyButton = $onlyButton;
    }

    /**
     * Hydrate component.
     *
     * @return void
     */
    public function hydrate(): void
    {
//        $cart = new mCart; //сделать  пепозиторий

        $this->currentQty = app(mCart::class)->getCurrentQty($this->productId);
    }

    /**
     * Add product to the basket.
     *
     * @return void
     */
    public function add(): void
    {
//        $cart = new mCart; //сделать  пепозиторий
//        app(mCart::class)
        $qty = $this->currentQty + (int) $this->qty;

        if (!$qty) {
            return;
        }

        app(mCart::class)->add($this->productId, $qty);
        $this->emit('basketUpdated');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.cart-add-button');
    }
}
