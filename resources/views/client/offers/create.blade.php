<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.offers.create.header') }}
    </x-slot>

    <form action="{{ route('halls.offers.store', Session::get('hall')->id) }}" method="POST" class="space-y-4">
        @csrf

        <!-- begin::Description -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="name" :value="__('page.offers.form.description.label')" />

                <textarea
                    name="description" rows="4" placeholder="{{ __('page.offers.form.description.placeholder') }}"
                    class="shadow-sm mt-1 p-4 block w-full placeholder-slate-300 sm:text-sm border-none rounded-sm
                    resize-none outline-none focus:outline-none focus:border-slate-300 focus:ring-0"
                ></textarea>

                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Description -->

        <!-- begin::Price -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="price" :value="__('page.offers.form.price.label')" />

                <x-input
                    type="text" class="w-full" name="price" value="{{ old('price') }}"
                    placeholder="{{ __('page.offers.form.price.placeholder') }}"
                />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Price -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-2 max-w-[560px] flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.offers.index', Session::get('hall')->id) }}">
                    {{ __('actions.back')}}
                </x-actions.back>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
