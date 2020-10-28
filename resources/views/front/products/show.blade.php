@extends('front.layouts.app')

@section('title', $product->name)

@section('content')
    <div class="col-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="product-image">
                        <x-carousel-component :items="$product->images"></x-carousel-component>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">
                        {{$product->name}}

                        {{--<i class="fa fa-star fa-2x text-primary"></i>--}}
                        {{--<i class="fa fa-star fa-2x text-primary"></i>--}}
                        {{--<i class="fa fa-star fa-2x text-primary"></i>--}}
                        {{--<i class="fa fa-star fa-2x text-primary"></i>--}}
                        {{--<i class="fa fa-star fa-2x text-muted"></i>--}}
                        {{--<span class="fa fa-2x"><h5>(109) Votes</h5></span>--}}
                        {{--<a href="javascript:void(0);">109 customer reviews</a>--}}
                    </h2>
                    <div>
                        <span>{{__('Product by:')}} <a href="javascript:void(0);">{{$product->brand->name}}</a></span>
                        <span>{{__('Sku:')}} {{$product->sku}}</span>
                    </div>
                    <hr/>
                    <h3 class="price-container">
                        <span class="text-danger">@money($product->price)</span>
                        <small>*includes tax</small>
                    </h3>

                    @include('front.products.partials._products-item-certified')

                    <hr/>

                    @include('front.products.partials._products-item-info', ['product' => $product])

                    <hr/>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                            <a href="javascript:void(0);"
                               class="btn btn-success btn-lg">{{__('Add to cart (:price)', ['price'=> $product->price])}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
