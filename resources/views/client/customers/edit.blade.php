<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.customers.create.header') }}
    </x-slot>

    <form action="{{ route('halls.customers.update', ['hall' => Session::get('hall')->id, 'customer' => $customer->id]) }}" method="POST" class="space-y-4 pb-16">
        @csrf
        @method('PATCH')

        <!-- begin::Full Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.customers.form.name.label')" />

                <x-input
                    type="text" class="w-full mt-1" name="name" value="{{ $customer->user->name }}"
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
                    type="text" class="w-full mt-1" name="email" value="{{ $customer->user->email }}"
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
                    type="text" name="phone" value="{{ $customer->user->phone }}" dir="ltr"
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
        <div class="grid grid-cols-2">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.customers.index', Session::get('hall')->id) }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
