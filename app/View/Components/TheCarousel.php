<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TheCarousel extends Component
{
    protected $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $items = [1,2,3,4];// hardcode пока не добавится модель для  загрузки  Image
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.the-carousel')
            ->with(['items' => $this->items]);
    }
}
