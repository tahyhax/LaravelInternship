<div class="d-flex flex-column flex-md-row align-items-start p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="col-12 col-md d-flex align-items-center">
        <a href="/" class="my-0 mr-md-auto font-weight-normal d-flex align-items-center">
            <img class="mr-2" src="https://www.iconbolt.com/iconsets/font-awesome-solid/user-graduate.svg"
                 alt="{{$companyName}}"
                 width="24"
                 height="24">
            <h5 class="m-0">{{$companyName}}</h5>
        </a>
    </div>

    <div class="d-flex  w-75">
        <div class="vw-100">
            @include('front.layouts.partials.header._search')
            @include('front.layouts.partials.header._header-menu')
        </div>

    </div>
    <livewire:cart-header/>
    <div class="px-3">
        @include('front.layouts.partials.header._navbar')
    </div>

</div>
