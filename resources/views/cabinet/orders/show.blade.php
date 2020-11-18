@extends('cabinet.layouts.app')
@section('title', 'Order-' . $order->slug)
@section('content')
    <h2>{{__('Order Info')}}</h2>
    <div class="col-10">
        @include('cabinet.orders.partials.info.info', ['order' => $order])
    </div>

    <h2>{{__('Products List')}}</h2>
    @include('cabinet.orders.partials.table-products.table', ['products' => $products])
@endsection