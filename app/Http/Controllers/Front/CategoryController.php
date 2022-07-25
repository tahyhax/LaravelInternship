<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Category;
use Illuminate\Http\Response;


class CategoryController extends Controller
{

    /**
     * @var int $perPage
     */
    protected int $perPage = 10;


    /**
     * @param Category $category
     * @param ProductFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category, ProductFilters $filters)
    {
        return view('front.categories.show')->with(
            [
                'category' => $category,
                'products' => $category->products()->with('imagesMain')
                    ->filter($filters)
                    ->paginate($this->perPage)
            ]);
    }

}
