<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.reports.show.header', ['report' => $report->id]) }}
    </x-slot>

    <!-- begin::Information -->
    <div class="grid grid-cols-4 text-sm mb-6">
        <div class="col-span-1 space-y-1">
            <div class="flex items-center justify-between">
                <span class="block text-slate-400">
                    {{ __('page.reports.index.table.from') }} :
                </span>
                <span class="block">
                    {{ substr($report->from, 0, 11) }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="block text-slate-400">
                    {{ __('page.reports.index.table.to') }} :
                </span
                <span class="block">
                    {{ substr($report->to, 0, 11) }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="block text-slate-400">
                    {{ __('page.reports.index.table.type') }} :
                </span
                <span class="block">
                    {{ __('page.reports.form.type.items.' . $report->type) }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="block text-slate-400">
                    {{ __('page.reports.index.table.average') }} :
                </span
                <span class="block">
                    {{ $report->average }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="block text-slate-400">
                    {{ __('page.reports.index.table.total') }} :
                </span
                <span class="block">
                    {{ $report->total }}
                </span>
            </div>
        </div>
    </div>
    <!-- end::Information -->

    <!-- begin::Expenses -->
    @if (isset($expenses))
        <div>
            <x-label for="expenses" :value="__('page.expenses.index.header')" class="mb-2" />

            <x-table page="expenses" :columns="['description', 'date', 'payment_method', 'amount']">
                @foreach ($expenses as $expense)
                    <tr>
                        <!-- begin::Name -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-s-2 text-sm font-medium text-gray-800">
                                {{ $expense->description }}
                            </div>
                        </td>
                        <!-- end::Description -->

                        <!-- begin::Date -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ \Illuminate\Support\Carbon::parse($expense->date)->toFormattedDateString() }}
                            </div>
                        </td>
                        <!-- end::Date -->

                        <!-- begin::Payment Method -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ __('page.expenses.form.payment_method.items.' . $expense->payment_method) }}
                            </div>
                        </td>
                        <!-- end::Payment Method -->

                        <!-- begin::Amount -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ $expense->amount }}
                            </div>
                        </td>
                        <!-- end::Amount -->

                        <!-- begin::Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end"></td>
                        <!-- end::Actions -->
                    </tr>
                @endforeach

                <x-slot name="pagination"></x-slot>
            </x-table>
        </div>
    @endif
    <!-- end::Expenses -->

    <!-- begin::Revenues -->
    @if (isset($revenues))
        <div>
            <x-label for="expenses" :value="__('page.expenses.index.header')" class="mb-2" />

            <x-table page="revenues" :columns="['description', 'date', 'payment_method', 'amount']">
                @foreach ($revenues as $revenue)
                    <tr>
                        <!-- begin::Name -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-s-2 text-sm font-medium text-gray-800">
                                {{ $revenue->description }}
                            </div>
                        </td>
                        <!-- end::Description -->

                        <!-- begin::Date -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ \Illuminate\Support\Carbon::parse($revenue->date)->toFormattedDateString() }}
                            </div>
                        </td>
                        <!-- end::Date -->

                        <!-- begin::Payment Method -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ __('page.revenues.form.payment_method.items.' . $revenue->payment_method) }}
                            </div>
                        </td>
                        <!-- end::Payment Method -->

                        <!-- begin::Amount -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm  text-slate-500">
                                {{ $revenue->amount }}
                            </div>
                        </td>
                        <!-- end::Amount -->

                        <!-- begin::Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end"></td>
                        <!-- end::Actions -->
                    </tr>
                @endforeach

                <x-slot name="pagination"></x-slot>
            </x-table>
        </div>
    @endif
    <!-- end::Revenues -->

    <!-- begin::Form Button -->
    <div class="grid grid-cols-2 pt-8">
        <div class="col-span-1 flex items-center justify-between">
            <x-actions.back href="{{ route('reports.index') }}"/>
        </div>
    </div>
    <!-- end::Form Button -->
</x-app-layout>
