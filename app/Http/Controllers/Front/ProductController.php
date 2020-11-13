<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * @param ProductFilters $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductFilters $filters)
    {

        return view('front.products.index')->with(
            [
                'products' =>
                    Product::query()->with('imagesMain')
                        ->filter($filters)
                        ->orderByDesc('id')
                        ->paginate($this->perPage),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('front.products.show')->with(
            ['product' => $product->load('brand', 'images')]
        );
    }
}
