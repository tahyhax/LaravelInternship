<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandApiStoreRequest;
use App\Http\Requests\Dashboard\BrandApiUpdateRequest;
use App\Http\Resources\Dashboard\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    const PAGINATE_PER_PAGE = 15;

    /**
     * @param $request
     * @return BrandResource
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page') ?: self::PAGINATE_PER_PAGE;
        $brands = Brand::query()->orderBy('id', 'DESC')->paginate($per_page);

        return new BrandResource($brands);
    }

    /**
     * @param BrandApiStoreRequest $request
     * @return BrandResource
     */
    public function store(BrandApiStoreRequest $request)
    {
        $brand = Brand::create($request->all());
//        $brand = new Brand($request->all());
//        $brand->save();

        return new BrandResource($brand);
    }

    /**
     * @param Brand $brand
     * @return BrandResource
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand->load('images'));
    }

    /**
     * @param BrandApiUpdateRequest $request
     * @param Brand $brand
     * @return BrandResource
     */
    public function update(BrandApiUpdateRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        return new BrandResource($brand);
    }

    /**
     * @param Brand $brand
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
