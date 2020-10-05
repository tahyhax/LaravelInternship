<div class="card mb-3">
    <div class="card-body">

        <h5 class="card-title mb-1"><a href="{{route('posts.show', ['post' => $post->slug])}}">{{$post->title}}</a></h5>
        <div class="mb-1">
            Creator: <small class="text-muted">{{$post->user->name}}</small>
            {{--// NOTE временно сделано пока не разберуcь почему на работает $casts--}}
            Created: <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            @if($post->created_at != $post->updated_at)
                Updated: <small class="text-muted">{{ $post->updated_at->diffForHumans() }}</small>
            @endif
            Views: <small class="text-muted">{{ $post->views }}</small>

        </div>
        <p class="card-text">{!! $post->body !!}</p>
    </div>
    @auth
        <div class="card-footer">
            <div class="button-group d-flex justify-content-end">
                <form method="POST" action="{{route('posts.destroy', ['post' => $post->slug])}}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-primary mr-1" href="{{route('posts.edit', ['post' => $post->slug])}}" role="button">Edit</a>
                    <button  type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
                </form>
            </div>
        </div>
    @endauth


</div>