<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.bookings.show.header', ['booking' => $booking->id]) }}
    </x-slot>

    <div class="pb-12">
        <!-- begin::Customer Information -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <label for="" class="text-slate-400">
                    {{ __('page.bookings.create.customer_information') }}
                </label>
            </div>


            <!-- begin::Full Name / Email / Phone -->
            <div class="col-span-2 space-y-4">
                <!-- begin::Full Name -->
                <div class="flex items-center text-slate-400">
                    <x-label for="customer[name]" :value="__('page.bookings.show.name')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->customer->user->name }}
                    </span>
                </div>
                <!-- end::Full Name -->

                <!-- begin::Email -->
                <div class="flex items-center text-slate-400">
                    <x-label for="customer[email]" :value="__('page.bookings.show.email')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->customer->user->email }}
                    </span>
                </div>
                <!-- end::Email -->

                <!-- begin::Phone -->
                <div class="flex items-center text-slate-400">
                    <x-label for="customer[phone]" :value="__('page.bookings.show.phone')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm  font-bold text-slate-500">
                        {{ $booking->customer->user->phone }}
                    </span>
                </div>
                <!-- end::Phone -->
            </div>
            <!-- end::Full Name / Email / Phone -->
        </div>
        <!-- begin::Customer Information -->

        <div class="grid grid-cols-5 py-6">
            <div class="col-span-3">
                <hr>
            </div>
        </div>

        <!-- begin::Booking Times -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <x-label value="{{ __('page.bookings.create.booking_times') }}" />
            </div>

            <div class="col-span-2 space-y-4">
                <!-- begin::Date -->
                <div class="flex items-center text-slate-400">
                    <x-label for="date" :value="__('page.bookings.form.date.label')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ substr($booking->date, 0, 10) }}
                    </span>
                </div>
                <!-- end::Date -->

                <!-- begin::Period -->
                <div class="flex items-center text-slate-400">
                    <x-label for="period" :value="__('page.bookingTimes.form.period.label')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ __('page.bookingTimes.form.period.items.' . $booking->bookingTime->period) }}
                    </span>
                </div>
                <!-- end::Period -->

                <!-- begin::Available Booking Times -->
                <div class="w-full mt-4">
                    <x-label class="text-sm text-slate-400 mb-1">
                        {{ __('page.bookings.form.bookingTimes.label') }}
                    </x-label>

                    <x-table page="bookingTimes" :columns="['from', 'to', 'price']" class="text-xs">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-500">
                                    {{ $booking->bookingTime->from }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-500">
                                    {{ $booking->bookingTime->to }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-500">
                                    <input type="hidden" value="{{ $booking->bookingTime->price }}" id="bookingTimePrice">
                                    {{ number_format($booking->bookingTime->price, 2) }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-500"></div>
                            </td>
                        </tr>

                        <x-slot name="pagination"></x-slot>
                    </x-table>
                </div>
                <!-- end::Available Booking Times -->
            </div>
        </div>
        <!-- end::Booking Times -->

        <div class="grid grid-cols-5 pb-6">
            <div class="col-span-3">
                <hr>
            </div>
        </div>

        <!-- begin::Offers -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <label class="text-slate-400">
                    {{ __('page.bookings.create.offers') }}
                </label>
            </div>

            <!-- begin::Display Offers -->
            <div class="col-span-2">
                <x-table page="offers" :columns="['description', 'price']" class="text-xs">
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-500 line-clamp-2 max-w-xs">
                                {{ $booking->offer->description }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-500">
                                {{ number_format($booking->offer->price, 2) }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <!-- begin::Show -->
                            <x-modal>
                                <x-slot name="trigger">
                                    <x-actions.show @click.prevent="isOpen = ! isOpen" class="cursor-pointer text-center"/>
                                </x-slot>

                                <div class="px-6 py-4 text-sm flex items-center justify-center">
                                    {{ $booking->offer->description }}
                                </div>
                            </x-modal>
                            <!-- end::Show -->
                        </td>
                    </tr>

                    <x-slot name="pagination"></x-slot>
                </x-table>
            </div>
            <!-- end::Display Offers -->
        </div>
        <!-- end::Offers -->

        <div class="grid grid-cols-5 pb-4">
            <div class="col-span-3">
                <hr>
            </div>
        </div>

        <!-- begin::Payment -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <label for="" class="text-slate-400">
                    {{ __('page.bookings.create.payment') }}
                </label>
            </div>

            <div class="col-span-2 space-y-4">
                <!-- begin::Payment Method -->
                <div class="flex items-center text-slate-400">
                    <label class="text-sm">
                        {{ __('page.bookings.form.payment_method.label') }}
                    </label>

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ __('page.bookings.form.payment_method.items.' . $booking->payment_method) }}
                    </span>
                </div>
                <!-- end::Payment Method -->

                <!-- begin::Paid Amount -->
                <div class="flex items-center text-slate-400">
                    <x-label for="" value="{{ __('page.bookings.form.paid.label') }}" class="text-sm text-slate-400" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->paid }}
                    </span>
                </div>
                <!-- end::Paid Amount -->


                <!-- begin::Remaining -->
                <div class="col-span-1 text-slate-400">
                    <label for="" class="text-sm">
                        {{ __('page.bookings.form.remaining.label') }}
                    </label>

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->remaining }}
                    </span>
                </div>
                <!-- end::Remaining Amount -->

                <!-- begin::Total -->
                <div class="flex items-center text-slate-400">
                    <x-label for="total" :value="__('page.bookings.form.total.label')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->total }}
                    </span>
                </div>
                <!-- end::Total -->
            </div>
        </div>
        <!-- end::Payment -->

        <div class="grid grid-cols-5 py-4">
            <div class="col-span-3">
                <hr>
            </div>
        </div>

        <!-- begin::Additional Information -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <label for="" class="text-slate-400">
                    {{ __('page.bookings.create.additional_information') }}
                </label>
            </div>

            <div class="col-span-2 space-y-4">
                <!-- begin::Status -->
                <div class="flex items-center text-slate-400">
                    <x-label for="status" :value="__('page.bookings.form.status.label')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ __('page.bookings.form.status.items.' . $booking->status) }}
                    </span>
                </div>
                <!-- end::Status -->

                <!-- begin::Notes -->
                <div class="flex items-center text-slate-400">
                    <x-label for="status" :value="__('page.bookings.form.notes.label')" />

                    <span class="text-xs font-semibold">&#8282;&nbsp;</span>

                    <span class="text-sm font-bold text-slate-500">
                        {{ $booking->notes }}
                    </span>
                </div>
                <!-- end::Notes -->
            </div>
        </div>
        <!-- end::Additional Information -->

        <div class="grid grid-cols-5 mt-12">
            <div class="col-span-1"></div>

            <div class="col-span-2">
                <x-actions.back href="{{ route('halls.bookings.index', Session::get('hall')->id) }}" />
            </div>
        </div>
    </div>

</x-app-layout>
