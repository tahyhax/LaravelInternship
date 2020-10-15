<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryApiStoreRequest;
use App\Http\Requests\Dashboard\CategoryApiUpdateRequest;
use App\Http\Resources\Dashboard\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    const PAGINATE_PER_PAGE = 15;

    /**
     * @param Request $request
     * @return CategoryResource
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page') ? : self::PAGINATE_PER_PAGE;
        $categories = Category::query()->orderBy('id', 'DESC')->paginate($per_page);
        return new CategoryResource($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryApiStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryApiStoreRequest $request)
    {
        $category =  Category::create($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryApiUpdateRequest $request, Category $categroy)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
