<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.users.index.header') }}

        <x-actions.add href="{{ route('users.create') }}" />
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="users" :columns="['name', 'email', 'phone', 'role']">
        @foreach ($users as $user)
            <tr>
                <!-- begin::Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-s-2 text-sm font-medium text-gray-800">
                        <img src="{{ $user->photo ? asset(str_replace('public', 'storage', $user->photo)) : asset('img/user.png') }}" class="w-10 h-10 object-cover rounded-full" alt="Profile Photo">

                        <span class="block">{{ $user->name }}</span>
                    </div>
                </td>
                <!-- end::Name -->

                <!-- begin::Email -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $user->email }}
                    </div>
                </td>
                <!-- end::Email -->

                <!-- begin::Phone -->
                <td class="px-6 py-4 whitespace-nowrap {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    <div class="text-sm  text-slate-500" dir="ltr">
                        {{ $user->phone }}
                    </div>
                </td>
                <!-- end::Phone -->

                <!-- begin::Permissions -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        <x-modal>
                            <x-slot name="trigger">
                                <a class="cursor-pointer hover:underline" @click="isOpen = ! isOpen">
                                    {{ __('permissions.title') }}
                                </a>
                            </x-slot>

                            <ul class="divide-y space-y-2">
                                @foreach ($user->permissions as $permission)
                                    <li> {{ __('permissions.' . $permission->name) }} </li>
                                @endforeach
                            </ul>
                        </x-modal>
                    </div>
                </td>
                <!-- end::permissions -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('users.edit', $user->id) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('users.destroy', $user->id)" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $users->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->

</x-app-layout>
