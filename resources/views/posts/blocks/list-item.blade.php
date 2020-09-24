<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h5>
        <p class="card-text">{{$post->body}}</p>
        <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
        </p>

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