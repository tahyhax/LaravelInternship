<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CarouselComponent extends Component
{
    /**
     * @var Collection | LengthAwarePaginator
     */
    protected $items;

    /**
     * @var string
     */
    protected $attribute;

    /**
     * CarouselComponent constructor.
     * @param Collection | LengthAwarePaginator $items
     * @param string $attribute
     */
    public function __construct( $items, $attribute = 'imageMain')
    {
        $this->items = $items;
        $this->attribute = $attribute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.carousel')
            ->with(['items' => $this->items, 'attribute' => $this->attribute]);
    }
}
