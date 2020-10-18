<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentMethodApiStoreRequest;
use App\Http\Requests\Dashboard\PaymentMethodApiUpdateRequest;
use App\Http\Resources\Dashboard\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Response;


class PaymentMethodController extends Controller
{
    /**
     * @return PaymentMethodResource
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::query()->orderBy('id', 'DESC')->get();

        return new PaymentMethodResource($paymentMethods);
    }

    /**
     * @param PaymentMethodApiStoreRequest $request
     * @return PaymentMethodResource
     */
    public function store(PaymentMethodApiStoreRequest $request)
    {
        $paymentMethod = PaymentMethod::create($request->all());

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return mixed
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param PaymentMethodApiUpdateRequest $request
     * @param PaymentMethod $paymentMethod
     * @return mixed
     */
    public function update(PaymentMethodApiUpdateRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->all());

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
