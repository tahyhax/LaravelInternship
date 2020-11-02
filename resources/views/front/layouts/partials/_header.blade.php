<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="col-12 col-md d-flex align-items-center">
        <a href="/" class="my-0 mr-md-auto font-weight-normal d-flex align-items-center">
            <img class="mr-2" src="https://www.iconbolt.com/iconsets/font-awesome-solid/user-graduate.svg" alt="" width="24" height="24">
            <h5 class="m-0">{{$companyName}}</h5>
        </a>
    </div>

    <div class="d-flex  w-75">
        @include('front.layouts.partials._search')
    </div>
    <livewire:cart-header/>
    <div class="px-3">
        @include('front.layouts.partials._navbar')
    </div>

</div>
