<div class="d-flex rounded shadow-sm">
    @unless ($onlyButton)
        <div class="relative flex-shrink">
            <input
                wire:model="qty"
                type="number"
                min="1"
                id="quantity"
                class="block w-16 border border-gray-400 py-2 px-3 mr-1 rounded"
            />
        </div>
    @endunless
    <button wire:click="add" wire:loading.attr="disabled" class="btn btn-primary d-inline-flex align-items-center">
        <span wire:loading.class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="sr-only">Loading...</span>
        <span class="ml-2">
           {{__('Add to cart')}}
        </span>
    </button>
</div>