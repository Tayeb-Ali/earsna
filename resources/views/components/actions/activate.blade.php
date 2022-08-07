<!-- begin::Activate Form -->
<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    @method('PATCH')

    <input type="hidden" name="action" value="activate">

    <!-- begin::Form Button -->
    <div class="flex justify-center">
        <x-button
            bgColor="bg-green-200/50 hover:bg-green-200"
            textColor="text-green-600"
            class="px-3 py-1">
            {{ __('actions.activate') }}
        </x-button>
    </div>
    <!-- end::Form Button -->
</form>
<!-- end::Activate Form -->
