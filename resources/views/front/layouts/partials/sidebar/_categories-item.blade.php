<a href="{{route('category.show', ['category' => $category->slug])}}" class="list-group-item list-group-item-action">
    {{$category->name}}
</a>
@if($category->children)
    <div class="sidebar-list-group list-group">
        @each('front.layouts.partials.sidebar._categories-item', $category->children, 'category')
    </div>
@endif
