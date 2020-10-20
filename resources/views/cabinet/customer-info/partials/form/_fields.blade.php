<div class="form-group">
    <label for="exampleInputEmail1">{{__('Name')}}</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{old('name', $customer->name)}}">
</div>
<div class="form-group">
    <label for="email">{{__('Email')}}</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{old('email',$customer->email)}}">
</div>
<div class="form-group">
    <label for="email">{{__('Avatar')}}</label>
    <input type="file" class="form-control" name="avatar" accept="image/*" id="avatar" placeholder="avatar">
</div>
<img src="{{$customer->avatar}}" alt="{{$customer->name}}">
{{--<div class="input-group mb-3">--}}
    {{--<div class="input-group-prepend">--}}
        {{--<span class="input-group-text">Upload</span>--}}
    {{--</div>--}}
    {{--<div class="custom-file">--}}
        {{--<input type="file" class="custom-file-input" name="avatar" id="avatar">--}}
        {{--<label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
    {{--</div>--}}
{{--</div>--}}