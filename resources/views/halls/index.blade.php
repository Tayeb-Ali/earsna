<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.halls.index.header') }}

        <x-actions.add href="{{ route('halls.create') }}"/>
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="halls" :columns="['name', 'city', 'address', 'capacity', 'client']">
        @foreach ($halls as $hall)
            <tr>
                <!-- begin::Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $hall->name }}
                    </div>
                </td>
                <!-- end::Name -->

                <!-- begin::City -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $hall->city }}
                    </div>
                </td>
                <!-- end::City -->

                <!-- begin::Address -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $hall->address }}
                    </div>
                </td>
                <!-- end::Address -->

                <!-- begin::Capacity -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $hall->capacity }}
                    </div>
                </td>
                <!-- end::Capacity -->

                <!-- begin::Client -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $hall->client->user->name }}
                    </div>
                </td>
                <!-- end::Client -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('halls.edit', $hall->id) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('halls.destroy', $hall->id)"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $halls->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->

</x-app-layout>
