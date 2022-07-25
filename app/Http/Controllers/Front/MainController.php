<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\Filterable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MainController extends Controller
{
    use Filterable;
    /**
     * @var int $perPage
     */
    protected int $perPage = 12;

    /**
     * @return Factory|View
     */
    public function __invoke(): Factory|View
    {
        return view('front.main.index')->with(
            [
                'products' =>
                    Product::query()->with('imagesMain')
                        ->orderByDesc('id')
                        ->paginate($this->perPage),

                'sliderProducts' =>
                    Product::query()->whereHas('imagesMain')
                        ->orderByDesc('id')
                        ->limit(5)
                        ->get()
            ]
        );
    }
}
