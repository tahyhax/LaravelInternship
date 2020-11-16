<div class="card mb-3">
    <div class="card-body">

        <h5 class="card-title mb-1"><a href="{{route('posts.show', ['post' => $post->slug])}}">{{$post->title}}</a></h5>
        <div class="mb-1">
            Creator:
            <small class="text-muted">{{$post->user->name}}</small>
            {{--// NOTE временно сделано пока не разберуcь почему на работает $casts--}}
            Created:
            <small class="text-muted">{{ $post->created_at}}</small>
            @if($post->created_at != $post->updated_at)
                Updated:
                <small class="text-muted">{{ $post->updated_at }}</small>
            @endif
            Views:
            <small class="text-muted">{{ $post->views }}</small>

        </div>
        <p class="card-text">{!! $post->body !!}</p>
    </div>
</div>