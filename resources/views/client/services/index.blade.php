<x-settings-layout>
   <!-- begin::Page Content -->
   <div class="flex items-start justify-between mb-4">
        <span class="block">
            {{ __('page.services.index.header') }}
        </span>

        <a href="{{ route('halls.services.create', Session::get('hall')->id) }}" class="inline-block py-1 px-6 rounded-sm bg-slate-900 text-slate-300 text-sm hover:bg-slate-800 transition duration-150 ease-in-out">
            {{ __('actions.add.page')}}
        </a>
    </div>

    <x-table page="services" :columns="['description', 'price']">
        @foreach ($services as $service)
            <tr>
                <!-- begin::Description -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $service->description }}
                    </div>
                </td>
                <!-- end::Description -->

                <!-- begin::Price -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ number_format($service->price, 2) }}
                    </div>
                </td>
                <!-- end::Price -->

                <!-- begin::Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('halls.services.edit', ['hall' => Session::get('hall')->id, 'service' => $service->id]) }}"/>
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete action="{{ route('halls.services.destroy', ['hall' => Session::get('hall')->id, 'service' => $service->id]) }}"/>
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $services->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-settings-layout>
