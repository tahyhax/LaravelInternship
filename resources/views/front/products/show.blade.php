@extends('front.layouts.app')

@section('title', $product->name)

@section('content')
    <div class="col-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="product-image">
                        <img src="{{$product->imageMain}}" alt="{{$product->name}}" width="500" >
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
                            <livewire:cart-add-button
                                    :product-id="$product->id"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-4">

            <p class="font-weight-bold">Bootstrap carousel multiple items is an improved version of the standard bootstrap
                carousel which allows you to put inside more than one element.</p>

            <hr class="my-4">

            <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

                <!--Controls-->
                <div class="controls-top">
                    <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                </div>
                <!--/.Controls-->

                <!--Indicators-->
                <ol class="carousel-indicators">
                    <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                    <li data-target="#multi-item-example" data-slide-to="1"></li>
                    <li data-target="#multi-item-example" data-slide-to="2"></li>
                </ol>
                <!--/.Indicators-->

                <!--Slides-->
                <div class="carousel-inner" role="listbox">

                    <!--First slide-->
                    <div class="carousel-item active">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(35).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/.First slide-->

                    <!--Second slide-->
                    <div class="carousel-item">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/.Second slide-->

                    <!--Third slide-->
                    <div class="carousel-item">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(53).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(45).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 clearfix d-none d-md-block">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(51).jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                            card's content.</p>
                                        <a class="btn btn-primary">Button</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/.Third slide-->

                </div>
                <!--/.Slides-->

            </div>
            <!--/.Carousel Wrapper-->


        </div>
    </div>
@endsection
