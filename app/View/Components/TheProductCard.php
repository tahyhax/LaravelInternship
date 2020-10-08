<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class TheProductCard extends Component
{
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
        return view('components.products.the-product-card')
            ->with(['product' => $this->product]);
    }
}
