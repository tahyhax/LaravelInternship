<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Product;
use App\Traits\Filterable;

class MainController extends Controller
{
    use Filterable;
    /**
     * @var int $perPage
     */
    protected $perPage = 12;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
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
