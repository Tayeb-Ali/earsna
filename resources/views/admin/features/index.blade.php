<x-settings-layout>
    <!-- begin::Page Content -->
    <div class="flex items-center justify-between">
        <span class="block">
            {{ __('page.features.index.header') }}
        </span>

        <a href="{{ route('features.create') }}" class="inline-block py-1 px-6 mb-6 rounded-sm bg-slate-900 text-slate-300 text-sm hover:bg-slate-800 transition duration-150 ease-in-out">
            {{ __('actions.add.page')}}
        </a>
    </div>

    <x-table page="features" :columns="['description']">
        @foreach ($features as $feature)
            <tr>
                <!-- begin::Description -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $feature->description }}
                    </div>
                </td>
                <!-- end::Description -->

                <!-- begin::Actions -->
                <td class="px-6 py-3 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('features.edit', $feature->id) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('features.destroy', $feature->id)" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $features->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-settings-layout>

