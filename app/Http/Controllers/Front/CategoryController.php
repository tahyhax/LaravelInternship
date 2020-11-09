<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Category;


class CategoryController extends Controller
{

    /**
     * @var int $perPage
     */
    protected $perPage = 10;


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
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
