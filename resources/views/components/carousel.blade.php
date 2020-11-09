@if($items->count())
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($items as $key => $item)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                    class="{{$loop->first ? 'active' : ''}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($items as $item)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                    {{--//TODO сделать динамический route--}}
                    <a href="{{route('products.show', ['product' => $item])}}">
                        <img class="d-block img-fluid" src="@php echo $item->{$attribute} @endphp " alt="{{$item->name}}">
                    </a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

@else
    <img class="d-block img-fluid" src="https://via.placeholder.com/500x500?text=No+slides" alt="no slides">
@endif


