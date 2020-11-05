<?php

namespace App\Http\Livewire;

use App\Services\Cart\CartService;
use Livewire\Component;
use Illuminate\View\View;

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

    public function __construct()
    {
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
        $this->currentQty = $this->cartService->getCurrentQty($this->productId);
    }

    /**
     * Add product to the cart.
     *
     * @return void
     */
    public function add(): void
    {
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
