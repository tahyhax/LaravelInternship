<div>
    <a href="/cart" data-turbolinks-action="replace" class="d-flex m-1 h4">
        <i class="fa fa-shopping-cart mr-1"></i>
        @if($qty)
            <span class="badge badge-pill badge-primary">{{$qty}}</span>
        @endif
    </a>
</div>
