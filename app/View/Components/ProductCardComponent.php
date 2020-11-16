<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductCardComponent extends Component
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.products.product-card')
            ->with(['product' => $this->product]);
    }
}
