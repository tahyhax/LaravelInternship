<ul class="list-group">
    @foreach($categories as $category)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{route('category.show', ['category' => $category->slug])}}" class="">
                {{$category->name}}
            </a>
            <span class="badge badge-primary badge-pill">{{ $category->products_count}}</span>
        </li>
    @endforeach
</ul>