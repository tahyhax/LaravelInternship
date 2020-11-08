<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CarouselComponent extends Component
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * @var string
     */
    protected $attribute;

    /**
     * CarouselComponent constructor.
     * @param Collection $items
     * @param string $attribute
     */
    public function __construct(Collection $items, $attribute = 'image')
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
