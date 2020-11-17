<div class="d-flex flex-column align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="col-12 d-flex  align-items-center ">
        <div class="d-flex ">
            <a href="/" class="my-0 mr-md-auto font-weight-normal d-flex align-items-center">
                <img class="mr-2" src="https://www.iconbolt.com/iconsets/font-awesome-solid/user-graduate.svg"
                     alt="{{$companyName}}"
                     width="24"
                     height="24">
                <h5 class="m-0 d-none d-sm-block">{{$companyName}}</h5>
            </a>
        </div>

        <div class="d-flex flex-grow-1 mx-2">
            @include('front.layouts.partials.header._search')


        </div>

        <div class="d-flex">
            <div class="mx-2 d-flex align-items-center">
                <livewire:cart-header/>
            </div>
            <div>
                @include('front.layouts.partials.header._navbar')
            </div>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center no-gutters">
        <div class=" col-lg-9 col-md-8 col-sm-12">
            @include('front.layouts.partials.header._header-menu')
        </div>
    </div>
</div>
