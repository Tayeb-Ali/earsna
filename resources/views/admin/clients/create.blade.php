<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intel-tel-input-rtl@1.0.0/build/css/intlTelInput.min.css">
    @endsection

    <x-slot name="header" class="py-6 px-4">
        {{ __('page.clients.create.header') }}
    </x-slot>

    <form action="{{ route('clients.store', ['redirect' => $redirect]) }}" method="POST" class="space-y-4 pb-8 px-4">
        @csrf

        <!-- begin::Full Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="name" :value="__('page.clients.form.name.label')" />

                <x-input
                    type="text" class="w-full mt-2" name="name" value="{{ old('name') }}"
                    placeholder="{{ __('page.clients.form.name.placeholder') }}"
                />

                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Full Name -->

        <!-- begin::Email -->
        <div class="grid grid-cols-2 mt-8">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="email" :value="__('page.clients.form.email.label')" />

                <x-input
                    type="text" class="w-full mt-2" name="email" value="{{ old('email') }}"
                    placeholder="{{ __('page.clients.form.email.placeholder') }}"
                />

                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Email -->

        <!-- begin::Phone -->
        <div class="grid grid-cols-2 mt-8">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="phone" :value="__('page.clients.form.phone.label')" class="mb-2"/>

                <input type="hidden" name="phone">
                <x-input
                    type="tel" id="phone" value="{{ old('phone') }}" dir="ltr"
                    class="min-w-full {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    x-init="$el.value=''"
                />
                <p id="phoneError" class="mt-1 text-xs text-red-500"></p>

                @error('phone')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Phone -->

        <!-- begin::Address -->
        <div class="grid grid-cols-2 mt-8">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="address" :value="__('page.clients.form.address.label')" />

                <x-input
                    type="text" class="w-full mt-2" name="address" value="{{ old('address') }}"
                    placeholder="{{ __('page.clients.form.address.placeholder') }}"
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

                @error('business_field_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Business Field -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-2 max-w-[560px] flex items-center space-x-2 justify-end">
                <x-actions.back href="{{ route('clients.index') }}" />

                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/intel-tel-input-rtl@1.0.0/build/js/intlTelInput.min.js"></script>
        <script>
            const input = document.querySelector("#phone");
            const requestData = document.querySelector("input[name=phone]");
            const error = document.querySelector("#phoneError");

            const iti = intlTelInput(input, {
                customContainer: 'w-full',
                initialCountry: 'SD',
                utilsScript: 'https://cdn.jsdelivr.net/npm/intel-tel-input-rtl@1.0.0/build/js/utils.js',
            });

            input.onblur = () => {
                if (iti.isValidNumber()) {
                    requestData.value = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                    iti.setNumber(iti.getNumber(intlTelInputUtils.numberFormat.E164));
                } else {
                    if (iti.getValidationError() === intlTelInputUtils.validationError.INVALID_COUNTRY_CODE) {
                        error.textContent = 'The country code is invalid';
                    }

                    if (iti.getValidationError() === intlTelInputUtils.validationError.TOO_SHORT) {
                        error.textContent = 'The phone number is too short';
                    }

                    if (iti.getValidationError() === intlTelInputUtils.validationError.TOO_LONG) {
                        error.textContent = 'The phone number is too long';
                    }

                    if (iti.getValidationError() === intlTelInputUtils.validationError.INVALID_LENGTH) {
                        error.textContent = 'The phone number length is invalid';
                    }
                }
            }
        </script>
    @endsection
</x-app-layout>
