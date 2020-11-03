<?php

namespace App\Http\Livewire;

use App\Services\Cart\CartService;
use Livewire\Component;
use Illuminate\View\View;
//use App\Models\Cart as mCart;


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


    protected $cartService;

    public function __construct()//CartService $cartService
    {
//        $this->cartService = $cartService;
        $this->cartService = app(CartService::class);
    }


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

        $this->currentQty = $this->cartService->getCurrentQty($this->productId);
    }

    /**
     * Add product to the basket.
     *
     * @return void
     */
    public function add(): void
    {
//        $qty = $this->currentQty + (int) $this->qty;
//
//        if (!$qty) {
//            return;
//        }

        $this->cartService->add($this->productId, $this->qty);
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
