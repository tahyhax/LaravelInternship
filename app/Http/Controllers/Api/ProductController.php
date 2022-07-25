<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Http\Requests\Dashboard\ProductApiStoreRequest;
use App\Http\Requests\Dashboard\ProductApiUpdateRequest;
use App\Http\Resources\Dashboard\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    protected int $perPage = 10;

    /**
     * @param Request $request
     * @param ProductFilters $filters
     * @return ProductResource
     */
    public function index(Request $request, ProductFilters $filters): ProductResource
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $products = Product::query()->with(['categories', 'brand', 'imagesMain'])->filter($filters)->paginate($perPage);

        return new ProductResource($products);
    }

    /**
     * @param ProductApiStoreRequest $request
     * @return ProductResource
     */
    public function store(ProductApiStoreRequest $request): ProductResource
    {
        $product = new Product($request->all());
        $product->brand()->associate($request->get('brand'));

        //TODO как будет правильно push или sync| он скорее всего не сохраняет и провто записывается данные
//        $product->push();

        $product->save();
        $product->categories()->sync($request->get('categories', []));
        $product->similar()->sync($request->get('similar', []));

        if ($request->hasFile('images')) {
            $imagesList = $product->loadImagesToStore($request->file('images'));
            $product->images()->saveMany($imagesList);
        }

        return new ProductResource($product->load(['brand', 'categories', 'images', 'similar']));
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $product->load(['categories', 'brand', 'images', 'similar']);

        return new ProductResource($product);

    }

    /**
     * @param ProductApiUpdateRequest $request
     * @param Product $product
     * @return ProductResource
     * @throws \Throwable
     */
    public function update(ProductApiUpdateRequest $request, Product $product): ProductResource
    {
        DB::beginTransaction();
        try {

            $product->brand()->associate($request->get('brand'));
            $product->update($request->all());
            $product->categories()->sync($request->get('categories', []));
            $product->similar()->sync($request->get('similar', []));


            $imagesList = $request->hasFile('images')
                ? $product->loadImagesToStore($request->file('images'))
                : [];
            $product->images()->delete();
            $product->images()->saveMany($imagesList);

            DB::commit();

        } catch (\Exception $error) {

            DB::rollBack();

            return response($error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        //NOTE Transform the resource into an HTTP response. ->response()
        //TODO  https://laravel.com/docs/8.x/eloquent-resources
        //TODO'posts' => PostResource::collection($this->posts), разобратся как работает
        return new ProductResource($product->load(['categories', 'brand', 'images', 'similar.brand']));

    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
