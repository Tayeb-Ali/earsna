<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.features.create.header') }}
    </x-slot>

    <form action="{{ route('features.update', $feature->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- begin::Description -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="name" :value="__('page.features.form.description.label')" />

                <textarea
                    name="description" rows="4" placeholder="{{ __('page.features.form.description.placeholder') }}"
                    class="shadow-sm mt-1 p-4 block w-full sm:text-sm border-none rounded-sm
                    resize-none outline-none focus:outline-none focus:border-slate-300 focus:ring-0"
                >{{ $feature->description }}</textarea>

                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Description -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form') }}
                </x-button>

                <x-actions.back href="{{ route('features.index') }}">
                    {{ __('actions.back')}}
                </x-actions.back>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
