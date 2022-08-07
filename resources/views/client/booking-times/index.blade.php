<x-settings-layout>
    <!-- begin::Page Content -->
    <div class="flex items-start justify-between mb-4">
        <span class="block">
            {{ __('page.bookingTimes.index.header') }}
        </span>

        <a href="{{ route('halls.booking-times.create', Session::get('hall')->id) }}" class="inline-block py-1 px-6 rounded-sm bg-slate-900 text-slate-300 text-sm hover:bg-slate-800 transition duration-150 ease-in-out">
            {{ __('actions.add.page')}}
        </a>
    </div>

    <x-table page="bookingTimes" :columns="['period', 'from', 'to', 'price']">
        @foreach ($bookingTimes as $bookingTime)
            <tr>
                <!-- begin::Period -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ __('page.bookingTimes.form.period.items.' . $bookingTime->period) }}
                    </div>
                </td>
                <!-- end::Period -->

                <!-- begin::From -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $bookingTime->from }}
                    </div>
                </td>
                <!-- end::From -->

                <!-- begin::To -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $bookingTime->to }}
                    </div>
                </td>
                <!-- end::To -->

                <!-- begin::Price -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $bookingTime->price }}
                    </div>
                </td>
                <!-- end::Price -->

                <!-- begin::Actions -->
                <td class="px-6 py-3 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('halls.booking-times.edit', ['hall' => Session::get('hall')->id, 'booking_time' => $bookingTime->id]) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('halls.booking-times.destroy', ['hall' => Session::get('hall')->id, 'booking_time' => $bookingTime->id])" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $bookingTimes->links() }}
        </x-slot>
    </x-table>
    <!-- begin::Page Content -->
</x-settings-layout>

