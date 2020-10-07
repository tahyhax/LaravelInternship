<div class="list-group">
    @foreach($categories as $category)
        <a href="{{route('category.show', ['category' => $category->slug])}}" class="list-group-item">
            {{$category->name}}
        </a>
    @endforeach
</div>