<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.suppliers.index.header') }}

        <x-actions.add href="{{ route('halls.suppliers.create', Session::get('hall')->id) }}" />
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="suppliers" :columns="['name', 'email', 'phone', 'address', 'businessField']">
        @foreach ($suppliers as $supplier)
            <tr>
                <!-- begin::Full Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $supplier->name }}
                    </div>
                </td>
                <!-- end::Full Name -->

                <!-- begin::Email -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $supplier->email }}
                    </div>
                </td>
                <!-- end::Email -->

                <!-- begin::Phone -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : '' }} text-slate-500" dir="ltr">
                        {{ $supplier->phone }}
                    </div>
                </td>
                <!-- end::Phone -->

                <!-- begin::Address -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div  class="text-sm  text-slate-500">
                        {{ $supplier->address }}
                    </div>
                </td>
                <!-- end::Address -->

                <!-- begin::Business Field -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div  class="text-sm  text-slate-500">
                        {{ $supplier->businessField->name }}
                    </div>
                </td>
                <!-- end::Business Field -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('halls.suppliers.edit', ['hall' => Session::get('hall')->id, 'supplier' => $supplier->id]) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete action="{{ route('halls.suppliers.destroy', ['hall' => Session::get('hall')->id, 'supplier' => $supplier->id]) }}"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $suppliers->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-app-layout>
