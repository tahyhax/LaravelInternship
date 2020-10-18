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
        $per_page = $request->get('per_page') ?: self::PAGINATE_PER_PAGE;
        $categories = Category::query()->orderBy('id', 'DESC')->paginate($per_page);

        return new CategoryResource($categories);
    }

    /**
     * @param CategoryApiStoreRequest $request
     * @return CategoryResource
     */
    public function store(CategoryApiStoreRequest $request)
    {
        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        $category->load('images');
        return new CategoryResource($category);
    }

    /**
     * @param CategoryApiUpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(CategoryApiUpdateRequest $request, Category $category)
    {
        $category->update($request->all());

        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
