<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h5>
        <p class="card-text">{{$post->body}}</p>
        <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
        </p>
    </div>
</div>