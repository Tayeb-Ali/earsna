<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.businessFields.create.header') }}
    </x-slot>

    <form action="{{ route('business-fields.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- begin::Title -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="name" :value="__('page.businessFields.form.name.label')" />

                <x-input
                    type="text" class="w-full" name="name" value="{{ old('name') }}"
                    placeholder="{{ __('page.businessFields.form.name.placeholder') }}"
                />

                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::title -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-2 max-w-[560px] flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('business-fields.index') }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
