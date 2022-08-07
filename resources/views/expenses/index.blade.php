<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.expenses.index.header') }}

        <x-actions.add href="{{ route('expenses.create') }}" />
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
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
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('expenses.edit', $expense->id) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('expenses.destroy', $expense->id)" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $expenses->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->

</x-app-layout>
