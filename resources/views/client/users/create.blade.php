<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.users.create.header') }}
    </x-slot>

    <form action="{{ route('client.users.store') }}" method="POST" class="space-y-4 pb-8">
        @csrf

        <!-- begin::Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.users.form.name.label')" />

                <div>
                    <x-input
                        type="text" name="name" value="{{ old('name') }}" class="w-full"
                        placeholder="{{ __('page.users.form.name.placeholder') }}"
                    />

                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
             </div>
        </div>
        <!-- end::Name -->

        <!-- begin::Email -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="email" :value="__('page.users.form.email.label')" />

                <div>
                    <x-input
                        type="text" name="email" value="{{ old('email') }}" class="w-full"
                        placeholder="{{ __('page.users.form.email.placeholder') }}"
                    />

                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <!-- end::Email -->

        <!-- begin::Phone -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="phone" :value="__('page.users.form.phone.label')" />

                <div>
                    <x-input
                        type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                        placeholder="{{ __('page.users.form.phone.placeholder') }}"
                        dir="ltr"
                    />

                    @error('phone')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <!-- end::Phone -->

        <!-- begin::Role -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="role" :value="__('page.users.form.role.label')" />

                <x-select
                    name="role"
                    :value="old('role')"
                    :display="old('role') ? __('page.users.roles.' . old('role')) : null"
                    :placeholder="__('actions.select.placeholder')"
                >
                    @foreach ($roles as $role)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $role->title }}'); visible = false"
                        >
                            {{ ucwords(__('page.users.roles.' . $role->title )) }}
                        </li>
                    @endforeach
                </x-select>

                @error('role')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Role -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('client.users.index') }}"/>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
