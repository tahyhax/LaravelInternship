<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandApiStoreRequest;
use App\Http\Requests\Dashboard\BrandApiUpdateRequest;
use App\Http\Resources\Dashboard\BrandResource;
use App\Models\Brand;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * @var int $perPage
     */
    protected int $perPage = 10;

    /**
     * @param Request $request
     * @return BrandResource
     */
    public function index(Request $request): BrandResource
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $brands = Brand::query()->orderBy('id', 'DESC')->paginate($perPage);

        return new BrandResource($brands);
    }

    /**
     * @param BrandApiStoreRequest $request
     * @return BrandResource
     */
    public function store(BrandApiStoreRequest $request): BrandResource
    {
        $brand = Brand::create($request->all());

        return new BrandResource($brand);
    }

    /**
     * @param Brand $brand
     * @return BrandResource
     */
    public function show(Brand $brand): BrandResource
    {
        return new BrandResource($brand->load('images'));
    }

    /**
     * @param BrandApiUpdateRequest $request
     * @param Brand $brand
     * @return BrandResource
     */
    public function update(BrandApiUpdateRequest $request, Brand $brand): BrandResource
    {
        $brand->update($request->all());

        return new BrandResource($brand);
    }

    /**
     * @param Brand $brand
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Brand $brand): Response|ResponseFactory
    {
        $brand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
