<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductApiStoreRequest;
use App\Http\Requests\Dashboard\ProductApiUpdateRequest;
use App\Http\Resources\Dashboard\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{

    const PAGINATE_PER_PAGE = 15;

    /**
     * @param Request $request
     * @return ProductResource
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page') ?: self::PAGINATE_PER_PAGE;
        $products = Product::query()->orderBy('id', 'DESC')->paginate($per_page);

        return new ProductResource($products);
    }

    /**
     * @param ProductApiStoreRequest $request
     * @return ProductResource
     */
    public function store(ProductApiStoreRequest $request)
    {
        $product = new Product($request->all());
        $product->brand()->associate($request->get('brand'));

        //TODO как будет правильно push или sync| он скорее всего не сохраняет и провто записывается данные
//        $product->push();

        $product->save();
        $product->categories()->sync($request->get('categories', []));


        return new ProductResource($product->load(['brand', 'categories', 'images']));
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        $product->load(['categories', 'brand', 'images']);

        return new ProductResource($product);

    }

    /**
     * @param ProductApiUpdateRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductApiUpdateRequest $request, Product $product)
    {
        $product->brand()->associate($request->get('brand'));
        $product->update($request->all());
        $product->categories()->sync($request->get('categories', []));

        //NOTE Transform the resource into an HTTP response. ->response()
        //TODO  https://laravel.com/docs/8.x/eloquent-resources
        //TODO'posts' => PostResource::collection($this->posts), разобратся как работает
        return new ProductResource($product->load(['categories', 'brand', 'images']));

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
