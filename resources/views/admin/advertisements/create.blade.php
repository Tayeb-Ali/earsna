<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.advertisements.create.header') }}
    </x-slot>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('advertisements.store') }}" method="POST" class="space-y-4 pb-8" enctype="multipart/form-data">
        @csrf

        <!-- begin::Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="name" :value="__('page.advertisements.form.name.label')" />

                <div>
                    <x-input
                        type="text" class="w-full" name="name" value="{{ old('name') }}"
                        placeholder="{{ __('page.advertisements.form.name.placeholder') }}"
                    />

                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
             </div>
        </div>
        <!-- end::Name -->

        <!-- begin::Start / End Dates -->
        <div x-data class="grid grid-cols-2 items-end">
            <div class="col-span-1">
                <div class="grid grid-cols-2 gap-x-6">
                    <!-- begin::Start Date -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-between">
                            <x-label for="start_date" :value="__('page.advertisements.form.start_date.label')" />

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input
                            type="text" name="start_date" placeholder="{{ __('page.advertisements.form.start_date.placeholder') }}"
                            class="date-picker w-full text-sm rounded-sm placeholder-slate-300 border-none cursor-pointer shadow-sm mt-2 outline-none focus:ring-0" readonly
                            x-init="$el.value = ''"
                        />

                        @error('start_date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::Start Date -->

                    <!-- begin::End Date -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-between">
                            <x-label for="end_date" :value="__('page.advertisements.form.end_date.label')" />

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input
                            type="text" name="end_date" placeholder="{{ __('page.advertisements.form.end_date.placeholder') }}"
                            class="date-picker w-full text-sm rounded-sm placeholder-slate-300 border-none cursor-pointer shadow-sm mt-2 outline-none focus:ring-0" readonly
                            x-init="$el.value = ''"
                        />

                        @error('end_date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::End Date -->
                </div>
            </div>
        </div>
        <!-- end::Start / End Dates -->

        <!-- begin::Price -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="price" :value="__('page.advertisements.form.price.label')" />

                <x-input
                    type="text" class="w-full" name="price" value="{{ old('price') }}"
                    placeholder="{{ __('page.advertisements.form.price.placeholder') }}"
                />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Price -->

        <!-- begin::Status -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="status" :value="__('page.bookings.form.status.label')" />

                <x-select
                    name="status" value="{{ old('status') }}"
                    placeholder="{{ __('actions.select.placeholder') }}"
                >
                    @foreach (['active', 'suspended'] as $status)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $status }}'); visible = false"
                        >
                            {{ __('status.' . $status) }}
                        </li>
                    @endforeach
                </x-select>

                @error('status')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Status -->

        <!-- begin::Images -->
        <div x-data="{ show: false }" class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <div class="flex space-s-2">
                    <label for="images" class="relative cursor-pointer bg-green-400 hover:bg-green-500 py-2 px-4 rounded-md font-medium text-sm text-white focus-within:outline-none transition duration-150 ease-in-out">
                        <span>{{ app()->getLocale() === 'ar' ? 'تحميل الصور' : 'Upload images' }}</span>

                        <input
                            id="images" name="images[]" type="file" multiple class="sr-only"
                            @change="$el.files.length > 0 ? show=true : show=false"
                        >
                    </label>

                    <p class="text-sm text-green-500 mt-2"x-show="show">
                        {{ app()->getLocale() === 'ar' ? 'تم إختيار صور للتحميل' : 'Files have been selected for upload' }}
                    </p>
                </div>

                <p class="text-xs text-slate-400 mt-2">
                    {{ app()->getLocale() === 'ar' ? 'الصور يجب أن تكون من نوع PNG, JPG, JPEG وحجمها لا يزيد عن 10MB' : 'Images must be of type PNG, JPG, JPEG and its max size is 10MB' }}
                </p>
            </div>
        </div>
        <!-- end::Images -->

        <div class="grid grid-cols-2 py-4">
            <div class="col-span-1"><hr></div>
        </div>

        <!-- begin::Owner Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="owner_name" :value="__('page.advertisements.form.owner_name.label')" />

                <div>
                    <x-input
                        type="text" class="w-full" name="owner_name" value="{{ old('owner_name') }}"
                        placeholder="{{ __('page.advertisements.form.owner_name.placeholder') }}"
                    />

                    @error('owner_name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
             </div>
        </div>
        <!-- end::Owner Name -->

        <!-- begin::Owner Phone -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="owner_phone" :value="__('page.advertisements.form.owner_phone.label')" />

                <div class="flex items-center">
                    <div class="flex-1">
                        <x-input
                            type="text" name="owner_phone" value="{{ old('owner_phone') }}" dir="ltr"
                            class="w-full {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                            placeholder="{{ __('page.advertisements.form.owner_phone.placeholder') }}"
                        />

                        @error('owner_phone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Owner Phone -->

        <!-- begin::Business Field -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <div class="flex items-center justify-between">
                    <x-label for="business_field" class="" :value="__('page.clients.form.businessField.label')" />

                    <!-- begin::Add -->
                    <x-actions.add href="{{ route('business-fields.create') }}" />
                    <!-- end::Add -->
                </div>

                <x-select name="business_field_id" placeholder="{{ __('actions.select.placeholder') }}">
                    @foreach ($business_fields as $business_field)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" business_field="option"
                            @click="$store.selection.select($el, '{{ $business_field->id }}'); visible = false"
                        >
                            {{ $business_field->name }}
                        </li>
                    @endforeach
                </x-select>
            </div>
        </div>
        <!-- end::Business Field -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 py-8">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('advertisements.index') }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
