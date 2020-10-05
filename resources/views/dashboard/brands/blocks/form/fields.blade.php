<div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{$post->title}}">
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body" rows="10" placeholder="post body" >{{$post->body}}</textarea>
</div>