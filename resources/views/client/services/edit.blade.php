<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.services.create.header') }}
    </x-slot>

    <form action="{{ route('halls.services.update', ['hall' => Session::get('hall')->id, 'service' => $service->id]) }}" method="POST" class="space-y-4 pb-16">
        @csrf
        @method('PATCH')

        <!-- begin::Description -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="description" :value="__('page.services.form.description.label')" />

                <x-textarea
                    type="text" class="w-full mt-1" name="description" value="{{ $service->description }}"
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
                    type="text" class="w-full mt-1" name="price" value="{{ $service->price }}"
                    placeholder="{{ __('page.services.form.price.placeholder') }}"
                />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Price -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-4">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.services.index', Session::get('hall')->id) }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
