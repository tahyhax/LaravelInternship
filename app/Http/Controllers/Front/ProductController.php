<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var int
     */
    protected int $perPage = 10;

    /**
     * @param ProductFilters $filters
     * @return Factory|View
     */
    public function index(ProductFilters $filters): Factory|View
    {

        return view('front.products.index')->with(
            [
                'products' =>
                    Product::query()->with(['imagesMain', 'similar'])
                        ->filter($filters)
                        ->orderByDesc('id')
                        ->paginate($this->perPage),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        return view('front.products.show')->with(
            ['product' => $product->load('brand', 'images')]
        );
    }
}
