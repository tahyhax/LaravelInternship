@extends('front.layouts.app')

@section('content')
    <div class="col-7">
        @include('front.checkout.partials.from._checkout', ['paymentMethods' => $paymentMethods])
    </div>
    <div class="col-5">
        @include('front.checkout.partials._cart-table', ['products' => $products])
    </div>

@endsection