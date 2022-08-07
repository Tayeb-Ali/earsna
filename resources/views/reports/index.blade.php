<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.reports.index.header') }}

        <x-actions.add href="{{ route('reports.create') }}" />
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="reports" :columns="['from', 'to', 'type', 'average', 'total']">
        @foreach ($reports as $report)
            <tr>
                <!-- begin::To -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ \Illuminate\Support\Carbon::parse($report->from)->toFormattedDateString() }}
                    </div>
                </td>
                <!-- end::To -->

                <!-- begin::To -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ \Illuminate\Support\Carbon::parse($report->to)->toFormattedDateString() }}
                    </div>
                </td>
                <!-- end::To -->

                <!-- begin::Type -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ __('page.reports.form.type.items.' . $report->type) }}
                    </div>
                </td>
                <!-- end::Type -->

                <!-- begin::Median -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $report->average }}
                    </div>
                </td>
                <!-- end::Median -->

                <!-- begin::Total -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $report->total }}
                    </div>
                </td>
                <!-- end::Total -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Show -->
                    <x-actions.show href="{{ route('reports.show', $report->id) }}" />
                    <!-- end::Show -->

                    <!-- begin::PDF -->
                    <x-actions.pdf href="{{ route('reports.pdf', $report->id) }}" />
                    <!-- end::PDF -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('reports.destroy', $report->id)" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $reports->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->

</x-app-layout>
