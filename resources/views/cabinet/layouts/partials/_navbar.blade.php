<nav class="navbar  navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{route('cabinet.main.index')}}">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav flex-row px-3">
        <li class="nav-item text-nowrap mr-2">
            <a class="nav-link" href="{{ route('main.index') }}">
                {{__('Site')}}
            </a>
        </li>
    </ul>
</nav>