<table class="table table-striped">
    @include('cabinet.orders.partials.table._header')
    <tbody>
        @each('cabinet.orders.partials.table._item', $orders, 'order')
    </tbody>
</table>

{{ $orders->links() }}