<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cabinet</title>
        <link rel="stylesheet" href="{{mix('css/cabinet/app.css')}}">
    </head>
    <body>
        @include('cabinet.layouts.partials._navbar')

        <div class="container-fluid">
            <div class="row h-100">
                @include('cabinet.layouts.partials._sidebar-left')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="mt-2">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>