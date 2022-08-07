<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.suppliers.create.header') }}
    </x-slot>

    <form action="{{ route('halls.suppliers.update', ['hall' => Session::get('hall')->id, 'supplier' => $supplier->id]) }}" method="POST" class="space-y-4 pb-16">
        @csrf
        @method('PATCH')

        <!-- begin::Full Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.suppliers.form.name.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="name" value="{{ $supplier->name }}"
                    placeholder="{{ __('page.suppliers.form.name.placeholder') }}"
                />

                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Full Name -->

        <!-- begin::Email -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="email" :value="__('page.suppliers.form.email.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="email" value="{{ $supplier->email }}"
                    placeholder="{{ __('page.suppliers.form.email.placeholder') }}"
                />

                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Email -->

        <!-- begin::Phone -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="phone" :value="__('page.suppliers.form.phone.label')" />

                <x-input
                    type="text" name="phone" value="{{ $supplier->phone }}" dir="ltr"
                    class="w-full mt-1 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    placeholder="{{ __('page.suppliers.form.phone.placeholder') }}"
                />

                @error('phone')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Phone -->

        <!-- begin::Address -->
        <div class="grid grid-cols-2 mt-8">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="address" :value="__('page.suppliers.form.address.label')" />

                <x-input
                    type="text" class="w-full mt-2" name="address" value="{{ $supplier->address }}"
                    placeholder="{{ __('page.suppliers.form.address.placeholder') }}"
                />

                @error('address')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Address -->

        <!-- begin::Business Field -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <div class="flex items-center justify-between">
                    <x-label for="business_field" class="" :value="__('page.suppliers.form.businessField.label')" />

                    <!-- begin::Add -->
                    <x-actions.add href="{{ route('business-fields.create') }}" />
                    <!-- end::Add -->
                </div>

                <x-select name="business_field_id" display="{{ $supplier->businessField->name }}" value="{{ $supplier->business_field_id }}" placeholder="{{ __('actions.select.placeholder') }}">
                    @foreach ($business_fields as $business_field)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" business_field="option"
                            @click="$store.selection.select($el, '{{ $business_field->id }}'); visible = false"
                        >
                            {{ $business_field->name }}
                        </li>
                    @endforeach
                </x-select>

                @error('business_field_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Business Field -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-4">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.suppliers.index', Session::get('hall')->id) }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
