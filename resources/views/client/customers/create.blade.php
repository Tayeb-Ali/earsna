<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.customers.create.header') }}
    </x-slot>

    <form action="{{ route('halls.customers.store', Session::get('hall')->id) }}" method="POST" class="space-y-4 pb-8">
        @csrf

        <!-- begin::Full Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.customers.form.name.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="name" value="{{ old('name') }}"
                    placeholder="{{ __('page.customers.form.name.placeholder') }}"
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
                <x-label for="email" :value="__('page.customers.form.email.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="email" value="{{ old('email') }}"
                    placeholder="{{ __('page.customers.form.email.placeholder') }}"
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
                <x-label for="phone" :value="__('page.customers.form.phone.label')" />

                <x-input
                    type="text" name="phone" value="{{ old('phone') }}" dir="ltr"
                    class="w-full mt-1 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    placeholder="{{ __('page.customers.form.phone.placeholder') }}"
                />

                @error('phone')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
             </div>
        </div>
        <!-- end::Phone -->

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
