<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.users.edit.header', ['user' => $user->name]) }}
    </x-slot>

    <form action="{{ route('client.users.update', $user->id) }}" method="POST" class="space-y-4 pb-8">
        @csrf
        @method('PATCH')

        <!-- begin::Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="name" :value="__('page.users.form.name.label')" />

                <div>
                    <x-input
                        type="text" class="w-full mt-1" name="name" value="{{ $user->name }}"
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
                        type="text" class="w-full mt-1" name="email" value="{{ $user->email }}"
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

                <div class="flex items-center">
                    {{-- <span class="block border border-slate-400 bg-slate-200 text-slate-500 text-xs p-3 shadow-lg">+966</span> --}}

                    <div class="flex-1">
                        <x-input
                            type="text" class="w-full {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                            name="phone" value="{{ $user->phone }}" dir="ltr"
                            placeholder="{{ __('page.users.form.phone.placeholder') }}"
                        />

                        @error('phone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Phone -->

        <!-- begin::Role -->
        <div class="grid grid-cols-2 pb-28">
            <x-label for="role" :value="__('page.users.form.role.label')" />

            <x-select
                name="role"
                :value="{{ $user->role }}"
                :display="__('page.users.roles.' . $user->role)"
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
        </div>
        <!-- end::Role -->

        <!-- begin::Form Buttons -->
        <div class="grid grid-cols-2">
            <div class="col-span-1 flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('client.users.index') }}" />
            </div>
        </div>
        <!-- end::Form Buttons -->
    </form>
</x-app-layout>
