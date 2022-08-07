<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.services.create.header') }}
    </x-slot>

    <form action="{{ route('halls.services.store', Session::get('hall')->id) }}" method="POST" class="space-y-4 pb-8">
        @csrf

        <!-- begin::Description -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="description" :value="__('page.services.form.description.label')" />

                <x-textarea
                    type="text" class="w-full mt-1" name="description" value="{{ old('description') }}"
                    placeholder="{{ __('page.services.form.description.placeholder') }}"
                />

                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Description -->

        <!-- begin::Price -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="price" :value="__('page.services.form.price.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="price" value="{{ old('price') }}"
                    placeholder="{{ __('page.services.form.price.placeholder') }}"
                />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Price -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.bookings.create', Session::get('hall')->id) }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
