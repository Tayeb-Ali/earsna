<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.advertisements.index.header') }}

        <!-- begin::Add -->
        <x-actions.add href="{{ route('advertisements.create') }}" />
        <!-- end::Add -->
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="advertisements" :columns="['name', 'owner_name', 'start_date', 'end_date', 'price', 'status']">
        @foreach ($advertisements as $advertisement)
            <tr>
                <!-- begin::Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $advertisement->name }}
                    </div>
                </td>
                <!-- end::Name -->

                <!-- begin::Owner Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $advertisement->owner_name }}
                    </div>
                </td>
                <!-- end::Owner Name -->

                <!-- begin::Start Date -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xs  text-slate-500">
                        {{ substr($advertisement->start_date, 0, 10) }}
                    </div>
                </td>
                <!-- end::Start Date -->

                <!-- begin::End Date -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xs  text-slate-500">
                        {{ substr($advertisement->end_date, 0, 10) }}
                    </div>
                </td>
                <!-- end::End Date -->

                <!-- begin::Price -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xs  text-slate-500">
                        {{ number_format($advertisement->price, 2) }}
                    </div>
                </td>
                <!-- end::Price -->

                <!-- begin::Status -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xs  text-slate-500">
                        {{ __('status.' . $advertisement->status) }}
                    </div>
                </td>
                <!-- end::Status -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('advertisements.edit', $advertisement->id) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete action="{{ route('advertisements.destroy', $advertisement->id) }}"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $advertisements->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-app-layout>
