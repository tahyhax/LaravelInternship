<form method="GET" class="w-100">
    {{--@csrf--}}
    <input class="form-control  form-control" name="search" type="text" placeholder="Search" aria-label="Search" value="{{request()->get('search')}}">
</form>