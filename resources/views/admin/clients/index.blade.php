<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.clients.index.header') }}

        <x-actions.add href="{{ route('clients.create') }}" size="p-1" />
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="clients" :columns="['name', 'email', 'phone', 'address', 'businessField']">
        @foreach ($clients as $client)
            @if (isset($client->user))
            <tr>
                <!-- begin::Full Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $client->user->name }}
                    </div>
                </td>
                <!-- end::Full Name -->

                <!-- begin::Email -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $client->user->email }}
                    </div>
                </td>
                <!-- end::Email -->

                <!-- begin::Phone -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : '' }} text-slate-500" dir="ltr">
                        {{ $client->user->phone }}
                    </div>
                </td>
                <!-- end::Phone -->

                <!-- begin::Address -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : '' }} text-slate-500" dir="ltr">
                        {{ $client->address }}
                    </div>
                </td>
                <!-- end::Address -->

                <!-- begin::Business Field -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : '' }} text-slate-500" dir="ltr">
                        {{ $client->businessField->name }}
                    </div>
                </td>
                <!-- end::Business Field -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('clients.edit', $client->id) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete action="{{ route('clients.destroy', $client->id) }}"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
            @endif
        @endforeach

        <x-slot name="pagination">
{{--            {{ $clients->links() }}--}}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-app-layout>
