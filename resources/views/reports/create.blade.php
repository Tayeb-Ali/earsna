<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.reports.create.header') }}
    </x-slot>

    <form action="{{ route('reports.store') }}" method="POST" class="space-y-4 pb-8">
        @csrf

        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <div class="grid grid-cols-3 gap-x-6">
                    <!-- begin::From -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-between">
                            <x-label for="date" :value="__('page.reports.form.from.label')" />

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input
                            type="text"name="from" placeholder="{{ __('page.reports.form.from.placeholder') }}"
                            class="date-picker w-full text-sm rounded-sm placeholder-slate-300 border-none cursor-pointer shadow-sm mt-2 outline-none focus:ring-0" readonly
                            x-init="$el.value = ''"
                        />

                        @error('from')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::From -->

                    <!-- begin::To -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-between">
                            <x-label for="date" :value="__('page.reports.form.to.label')" />

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input
                            type="text" name="to" placeholder="{{ __('page.reports.form.to.placeholder') }}"
                            class="date-picker w-full text-sm rounded-sm placeholder-slate-300 border-none cursor-pointer shadow-sm mt-2 outline-none focus:ring-0" readonly
                            x-init="$el.value = ''"
                        />

                        @error('to')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::To -->

                    <!-- begin::Type -->
                    <div class="col-span-1">
                        <x-label for="type" :value="__('page.reports.form.type.label')" />

                        <x-select name="type" placeholder="{{ __('page.reports.form.type.placeholder') }}">
                            @foreach ([ 'all', 'expenses', 'revenues'] as $type)
                                <li
                                    class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                                    @click="$store.selection.select($el, '{{ $type }}'); visible = false"
                                >
                                    {{ __('page.reports.form.type.items.' .  $type) }}
                                </li>
                            @endforeach
                        </x-select>

                        @error('type')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::Type -->
                </div>
            </div>
        </div>

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>
                <x-actions.back href="{{ route('reports.index') }}"/>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>

