<x-settings-layout>
    <!-- begin::Page Content -->
    <div class="flex items-start justify-between mb-4">
        <span class="block">
            {{ __('page.businessFields.index.header') }}
        </span>

        <a href="{{ route('business-fields.create') }}" class="inline-block py-1 px-6 rounded-sm bg-slate-900 text-slate-300 text-sm hover:bg-slate-800 transition duration-150 ease-in-out">
            {{ __('actions.add.page')}}
        </a>
    </div>

    <x-table page="businessFields" :columns="['field']">
        @foreach ($businessFields as $field)
            <tr>
                <!-- begin::Field -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $field->name }}
                    </div>
                </td>
                <!-- end::Field -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('business-fields.edit', $field->id) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete action="{{ route('business-fields.destroy', $field->id) }}"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $businessFields->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-settings-layout>
