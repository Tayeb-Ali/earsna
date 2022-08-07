<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.packages.create.header') }}
    </x-slot>

    <form action="{{ route('packages.store') }}" method="POST" class="space-y-4 pb-8">
        @csrf

        <!-- begin::Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.packages.form.name.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="name" value="{{ old('name') }}"
                    placeholder="{{ __('page.packages.form.name.placeholder') }}"
                />

                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Name -->

        <!-- begin::Features -->
        <div x-data class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="features" :value="__('page.packages.form.features.label')" />

                <div class="hidden lg:flex flex-col mt-1">
                    <div class="-my-2 overflow-x-hidden">
                        <div class="py-2 align-middle inline-block min-w-full">
                            <div class="overflow-hidden shadow-sm sm:rounded-sm">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 space-s-3 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}
                                                text-xs font-medium text-gray-400 uppercase tracking-wider"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="bg-white rounded-sm cursor-pointer border border-slate-300"
                                                    @click="$store.selection.check($el, 'feature')"
                                                >

                                                <span>
                                                    {{ __('page.features.index.table.description') }}
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($features as $feature)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center space-s-4 text-sm text-slate-500">
                                                        <input
                                                            type="checkbox" name="features[]" value="{{ $feature->id }}"
                                                            class="feature bg-white rounded-sm cursor-pointer border border-slate-300 outline-none"
                                                        >

                                                        <span class="line-clamp-1 text-xs">
                                                            {{ $feature->description }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @error('features')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Features -->

        <!-- begin::Price -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <div class="flex items-center space-s-6">
                    <x-label for="price" :value="__('page.packages.form.price.label')" />
                    <div class="flex items-center space-s-1 text-slate-400 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ __('page.packages.form.price.note') }}</p>
                    </div>
                </div>

                <x-input
                    type="text" class="w-full mt-1" name="price" value="{{ old('price') }}"
                    placeholder="{{ __('page.packages.form.price.placeholder') }}"
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

                <x-actions.back href="{{ route('packages.index') }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
