<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Template · Bootstrap</title>

    {{--<style>--}}
        {{--.bd-placeholder-img {--}}
            {{--font-size: 1.125rem;--}}
            {{--text-anchor: middle;--}}
            {{---webkit-user-select: none;--}}
            {{---moz-user-select: none;--}}
            {{---ms-user-select: none;--}}
            {{--user-select: none;--}}
        {{--}--}}

        {{--@media (min-width: 768px) {--}}
            {{--.bd-placeholder-img-lg {--}}
                {{--font-size: 3.5rem;--}}
            {{--}--}}
        {{--}--}}
    {{--</style>--}}


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{mix('css/dashboard/app.css')}}">

    {{--<style type="text/css">/* Chart.js */--}}
        {{--@-webkit-keyframes chartjs-render-animation {--}}
            {{--from {--}}
                {{--opacity: 0.99--}}
            {{--}--}}
            {{--to {--}}
                {{--opacity: 1--}}
            {{--}--}}
        {{--}--}}

        {{--@keyframes chartjs-render-animation {--}}
            {{--from {--}}
                {{--opacity: 0.99--}}
            {{--}--}}
            {{--to {--}}
                {{--opacity: 1--}}
            {{--}--}}
        {{--}--}}

        {{--.chartjs-render-monitor {--}}
            {{---webkit-animation: chartjs-render-animation 0.001s;--}}
            {{--animation: chartjs-render-animation 0.001s;--}}
        {{--}</style>--}}
</head>
<body>
@include('dashboard.layouts.partials._navbar')

<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.partials._sidebar-left')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>
    </div>
</div>
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"--}}
        {{--integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"--}}
        {{--crossorigin="anonymous"></script>--}}
{{--<script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>--}}
{{--<script src="/docs/4.5/dist/js/bootstrap.bundle.min.js"--}}
        {{--integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"--}}
        {{--crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>--}}
{{--<script src="dashboard.js"></script>--}}

{{--<div at-magnifier-wrapper="">--}}
    {{--<div class="at-theme-light">--}}
        {{--<div class="at-base notranslate" translate="no">--}}
            {{--<div class="Z1-AJ" style="top: 0px; left: 0px;"></div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
</body>
</html>