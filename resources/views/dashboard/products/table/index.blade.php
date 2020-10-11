    <table class="table table-striped table-sm">
        @include('dashboard.components.table.partials._thead-list')
        <tbody>
            @each('dashboard.components.table.partials._tbody-list-item', $list, 'item')
        </tbody>
    </table>
