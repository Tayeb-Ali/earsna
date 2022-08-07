<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.users.edit.header', ['user' => $user->name]) }}
    </x-slot>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4 pb-8">
        @csrf
        @method('PATCH')

        <!-- begin::Name -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
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

        <!-- begin::Phone -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="phone" :value="__('page.users.form.phone.label')" />

                <div class="flex items-center">
                    {{-- <span class="block border border-slate-400 bg-slate-200 text-slate-500 text-xs p-3 shadow-lg">+966</span> --}}

                    <div class="flex-1">
                        <x-input
                            type="text" name="phone" value="{{ $user->phone }}" dir="ltr"
                            class="w-full {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
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
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="role" :value="__('page.users.form.role.label')" />

                <x-select name="role" value="{{ $user->getRoleNames()->first() }}" display="{{ __('page.users.form.role.items.' . $user->getRoleNames()->first()) }}" placeholder="{{ __('page.users.form.role.placeholder') }}">
                    @foreach (['admin', 'accountant', 'data_entry'] as $role)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $role }}'); visible = false"
                        >
                            {{ __('page.users.form.role.items.' . $role) }}
                        </li>
                    @endforeach
                </x-select>

                @error('client_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Role -->

        <!-- begin::Permissions -->
        <div x-data class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="permissions" :value="__('permissions.title')" />

                <div class="hidden lg:flex flex-col mt-2">
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
                                                    class="permission bg-white rounded-sm cursor-pointer border border-slate-300"
                                                    @click="$store.selection.check($el, 'permission')"
                                                >

                                                <span>
                                                    {{ __('permissions.label') }}
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center space-s-4 text-sm text-slate-500">
                                                        <input
                                                            type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                            class="permission bg-white rounded-sm cursor-pointer border border-slate-300 outline-none"
                                                            {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}
                                                        >

                                                        <span class="line-clamp-1 text-xs">
                                                            {{ __('permissions.' . $permission->name) }}
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

                @error('permissions')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Permissions -->

        <!-- begin::Form Buttons -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-2 max-w-[560px] flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('users.index') }}"/>
            </div>
        </div>
        <!-- end::Form Buttons -->
    </form>
</x-app-layout>
