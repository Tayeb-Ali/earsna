<!-- begin::Activate Form -->
<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    @method('PATCH')

    <input type="hidden" name="action" value="suspend">

    <!-- begin::Form Button -->
    <div class="flex justify-center">
        <x-button
            bgColor="bg-yellow-200/50 hover:bg-yellow-200"
            size="px-3 py-1"
            textColor="text-yellow-600"
        >
            {{ __('actions.suspend') }}
        </x-button>
    </div>
    <!-- end::Form Button -->
</form>
<!-- end::Activate Form -->
