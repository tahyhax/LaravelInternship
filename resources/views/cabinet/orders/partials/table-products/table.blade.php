<table class="table table-striped">
    @include('cabinet.orders.partials.table-products._header')
    <tbody>
        @each('cabinet.orders.partials.table-products._item', $products, 'product')
    </tbody>
</table>

{{ $products->links() }}