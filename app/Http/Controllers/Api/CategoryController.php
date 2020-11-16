<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryApiStoreRequest;
use App\Http\Requests\Dashboard\CategoryApiUpdateRequest;
use App\Http\Resources\Dashboard\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

    /**
     * @var int $perPage
     */
    protected $perPage = 10;

    /**
     * @param Request $request
     * @return CategoryResource
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $categories = Category::query()->with('children')
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return new CategoryResource($categories);
    }

    /**
     * @param CategoryApiStoreRequest $request
     * @return CategoryResource
     */
    public function store(CategoryApiStoreRequest $request)
    {
        /**
         * @var  Category $category
         */
        $category = Category::create($request->all());

        if ($request->hasFile('images')) {
            $imagesList = $category->loadImagesToStore($request->file('images'));
            $category->images()->saveMany($imagesList);
        }

        return new CategoryResource($category->load(['images', 'children']));
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        $category->load(['images', 'children']);
        return new CategoryResource($category);
    }

    /**
     * @param CategoryApiUpdateRequest $request
     * @param Category $category
     * @return CategoryResource|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function update(CategoryApiUpdateRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->update($request->all());

            if ($request->hasFile('images')) {
                $imagesList = $category->loadImagesToStore($request->file('images'));
                $category->images()->delete();
                $category->images()->saveMany($imagesList);
            }

            DB::commit();

        } catch (\Exception $error) {

            DB::rollback();

            return response($error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return new CategoryResource($category->load(['images', 'children']));
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
