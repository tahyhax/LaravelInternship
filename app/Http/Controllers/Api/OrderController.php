<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OrderApiChangeStatusRequest;
use App\Http\Requests\Dashboard\OrderApiStoreRequest;
use App\Http\Requests\Dashboard\OrderApiUpdateRequest;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{

    protected int $perPage = 10;

    /**
     * @param Request $request
     * @return OrderResource
     */
    public function index(Request $request): OrderResource
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $requests = Order::query()->with(['user', 'products.brand'])
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return new OrderResource($requests);
    }

    /**
     * @param OrderApiStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderApiStoreRequest $request): OrderResource
    {
        try {
            $order = new Order($request->all());
            $order->user()->associate($request->get('user'));
            $order->paymentMethod()->associate($request->get('paymentMethods'));
            $order->save();

            $order->products()->sync($request->get('orderItems', []));

            event(new OrderCreatedEvent($order));

            return new OrderResource($order->load(['user', 'products.brand']));

        } catch (\Exception $exception) {
            //TODO сделать нормльный $exception
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }


    }

    /**
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order->load(['user', 'products.brand']));
    }

    /**
     * @param OrderApiUpdateRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(OrderApiUpdateRequest $request, Order $order): OrderResource
    {
        $order->user()->associate($request->get('user'));
        $order->paymentMethod()->associate($request->get('paymentMethods'));

        $order->save();

        $order->products()->sync($request->get('orderItems', []));

        return new OrderResource($order->load(['user', 'products.brand']));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateStatus(OrderApiChangeStatusRequest $request, Order $order): OrderResource
    {
        $order->update($request->all());

        return new OrderResource($order->load(['user', 'products.brand']));
    }
}
