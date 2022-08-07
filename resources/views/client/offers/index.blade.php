<x-settings-layout>
    <!-- begin::Page Content -->
    <div class="flex items-start justify-between mb-4">
        <span class="block">
            {{ __('page.offers.index.header') }}
        </span>

        <a href="{{ route('halls.offers.create', Session::get('hall')->id) }}" class="inline-block py-1 px-6 rounded-sm bg-slate-900 text-slate-300 text-sm hover:bg-slate-800 transition duration-150 ease-in-out">
            {{ __('actions.add.page')}}
        </a>
    </div>

    <x-table page="offers" :columns="['description', 'price']">
        @foreach ($offers as $offer)
            <tr>
                <!-- begin::Description -->
                <td class="px-6 py-3">
                    <div class="text-sm  text-slate-500 line-clamp-1 max-w-xs">
                        {{ $offer->description }}
                    </div>
                </td>
                <!-- end::Description -->

                <!-- begin::Price -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ number_format($offer->price, 2) }}
                    </div>
                </td>
                <!-- end::Price -->

                <!-- begin::Actions -->
                <td class="px-6 py-3 text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Show -->
                    <x-modal>
                        <x-slot name="trigger">
                            <x-actions.show @click.prevent="isOpen = ! isOpen" class="cursor-pointer"/>
                        </x-slot>

                        <div class="px-6 py-4 flex items-center justify-center">
                            {{ $offer->description }}
                        </div>
                    </x-modal>
                    <!-- end::Show -->

                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('halls.offers.edit', ['hall' => Session::get('hall')->id, 'offer' => $offer->id]) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('halls.offers.destroy', ['hall' => Session::get('hall')->id, 'offer' => $offer->id])" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $offers->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-settings-layout>
