<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="col-12 col-md d-flex align-items-center">
        <a href="/" class="my-0 mr-md-auto font-weight-normal d-flex align-items-center">
            <img class="mr-2" src="https://www.iconbolt.com/iconsets/font-awesome-solid/user-graduate.svg" alt="" width="24" height="24">
            <h5 class="m-0">{{$companyName}}</h5>
        </a>
    </div>

    @include('front.layouts.blocks.navbar')


    @guest
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
    @else
        <div class="btn-group">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    @endguest
</div>