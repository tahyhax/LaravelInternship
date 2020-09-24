<div class="card mb-3">
    <div class="card-body">

        <h5 class="card-title mb-1"><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h5>
        <div class="mb-1">
            Creator: <small class="text-muted">{{$post->user->name}}</small>
            {{--// NOTE временно сделано пока не разберуть почему на работает $casts--}}
            Created: <small class="text-muted">{{ $post->created_at->isoFormat('DD/MM/Y hh:m') }}</small>
            @if($post->created_at != $post->updated_at)
                Updated: <small class="text-muted">{{ $post->updated_at->isoFormat('DD/MM/Y hh:mm') }}</small>
            @endif
        </div>
        <p class="card-text">{!! $post->body !!}</p>
    </div>
    <div class="card-footer">
        <div class="button-group d-flex justify-content-end">
            <a class="btn btn-primary mr-1" href="{{route('posts.edit', ['post' => $post->id])}}" role="button">Edit</a>
            <form method="POST" action="{{route('posts.destroy', ['post' => $post->id])}}">
                @csrf
                @method('DELETE')
                <button  type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

</div>