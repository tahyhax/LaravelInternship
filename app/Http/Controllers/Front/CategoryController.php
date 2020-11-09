<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
    public function show(Category $category)
    {
        return view('front.categories.show')->with(
            [
                'category' => $category,
                'products' => $category->products()->paginate($this->perPage)
            ]);
    }

}
