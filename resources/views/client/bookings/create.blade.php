<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.bookings.create.header') }}
    </x-slot>

    <form x-data action="{{ route('halls.bookings.store', $id) }}" method="POST" class="pb-8">
        @csrf

        <!-- begin::Customer -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <x-label value="{{ __('page.bookings.create.customer_information') }}" />
            </div>

            <div class="col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <x-label for="date" :value="__('page.customers.index.header')" />

                    <x-actions.add href="{{ route('halls.customers.create', ['hall' => $id]) }}" size="p-1" />
                </div>

                <x-select name="customer_id" value="{{ old('customer_id') }}" placeholder="{{ __('page.bookings.form.customer.placeholder') }}">
                    @foreach ($customers as $customer)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $customer->id }}'); visible = false"
                        >
                            {{ $customer->user->name }}
                        </li>
                    @endforeach
                </x-select>

                @error('customer_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- begin::Customer -->

        <div class="grid grid-cols-5 py-4">
            <div class="col-span-3 border-t"></div>
        </div>

        <!-- begin::Booking Times -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <x-label value="{{ __('page.bookings.create.booking_times') }}" />
            </div>

            <div class="col-span-2">
                <!-- begin::Date / Period / Search Button -->
                <div class="grid grid-cols-3 gap-x-2 items-end">
                    <!-- begin::Date -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-between">
                            <x-label for="date" :value="__('page.bookings.form.date.label')" />

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input
                            type="text" id="date" name="date" readonly x-init="$el.value = ''"
                            placeholder="{{ $errors->has('date') ? $errors->get('date')[0] : __('page.bookings.form.date.placeholder') }}"
                            class="date-picker w-full text-sm rounded-sm {{ $errors->has('date') ? 'text-xs placeholder-red-500 border border-red-500' : 'placeholder-slate-300 border-none' }} cursor-pointer shadow-sm mt-2 outline-none focus:ring-0"
                        />

                        @error('date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::Date -->

                    <!-- begin::Period -->
                    <div class="col-span-1">
                        <x-label for="period" :value="__('page.bookingTimes.form.period.label')" />

                        <x-select x-init="$el.querySelector('input').value=''" :placeholder="__('actions.select.placeholder')">
                            @foreach (['day', 'evening'] as $period)
                                <option
                                    class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                                    @click="$store.selection.select($el, '{{ $period }}'); visible = false; $store.bookingTimes.setPeriod('{{ $period }}');"
                                >
                                    {{ __('page.bookingTimes.form.period.items.' . $period) }}
                                </option>
                            @endforeach
                        </x-select>

                        @error('period')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::Period -->

                    <!-- begin::Search Button -->
                    <div class="col-span-1">
                        <button
                            type="button"
                            class="py-2.5 w-full text-sm text-white bg-green-400 hover:bg-green-500 shadow-sm rounded-sm mb-px transition duration-150 ease-in-out"
                            @click.prevent="$store.bookingTimes.fetch({{ $id }})"
                        >
                            {{ __('page.bookings.form.bookingTimes.button') }}
                        </button>
                    </div>
                    <!-- end::Search Button -->

                </div>
                <!-- end::Date / Period / Search Button -->

                <!-- begin::Available Booking Times -->
                <p id="noBookingTimes" class="py-2 text-sm text-red-500"></p>

                <div class="w-full mt-4">
                    <label for="" class="text-sm text-slate-400">
                        {{ __('page.bookings.form.bookingTimes.label') }}
                    </label>

                    <div class="mt-2" id="availableBookingTimes">
                        <x-table page="bookingTimes" :columns="['#', 'from', 'to', 'price']" class="text-xs">

                            <x-slot name="pagination"></x-slot>
                        </x-table>
                    </div>
                </div>
                <!-- end::Available Booking Times -->
            </div>
        </div>
        <!-- end::Booking Times -->

        <div class="grid grid-cols-5 py-4">
            <div class="col-span-3 border-t"></div>
        </div>

        <!-- begin::Offers And Services -->
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <label for="" class="text-slate-400">
                    {{ __('page.bookings.create.offers') }}
                </label>
            </div>

            <div class="col-span-2">
                <!-- begin::Offers -->
                <div>
                    <x-label for="" value="{{ app()->getLocale() === 'ar' ? 'الباقات' : 'Offers' }}" class="text-slate-400 mb-2" />

                    <x-table page="offers" :columns="['#', 'description', 'price']" class="text-xs">
                        @foreach ($offers as $offer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <input
                                            name="offer_id" value="{{ $offer->id }}" type="radio"
                                            class="focus:ring-slate-600 h-4 w-4 text-slate-800 border-gray-300 cursor-pointer"
                                            @click="$store.payment.setOffer({{ $offer->price }}, true)"
                                        >
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-500 line-clamp-2 max-w-xs">
                                        {{ $offer->description }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="offer-price text-sm text-slate-500">
                                        {{ number_format($offer->price, 2) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <!-- begin::Show -->
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <button type="button" @click.prevent="isOpen = ! isOpen" class="cursor-pointer text-center block px-3 h-6 bg-indigo-200/50 hover:bg-indigo-200 text-indigo-500 border border-transparent rounded-sm font-normal text-xs uppercase focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <div class="px-6 py-4 text-sm flex items-center justify-center">
                                            {{ $offer->description }}
                                        </div>
                                    </x-modal>
                                    <!-- end::Show -->
                                </td>
                            </tr>
                        @endforeach

                        <x-slot name="pagination"></x-slot>
                    </x-table>
                </div>
                <!-- end::Display Offers -->

                <!-- begin::Services -->
                <div>
                    <x-label for="" value="{{ app()->getLocale() === 'ar' ? 'الخدمات' : 'Services' }}" class="text-slate-400 mb-2" />

                    <x-table page="services" :columns="['#', 'description', 'price']" class="text-xs">
                        @foreach ($services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <input
                                            name="service_id" value="{{ $service->id }}" type="radio"
                                            class="focus:ring-slate-600 h-4 w-4 text-slate-800 border-gray-300 cursor-pointer"
                                            @click="$store.payment.setService({{ $service->price }}, true)"
                                        >
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-500 line-clamp-2 max-w-xs">
                                        {{ $service->description }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="offer-price text-sm text-slate-500">
                                        {{ number_format($service->price, 2) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <!-- begin::Show -->
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <button type="button" @click.prevent="isOpen = ! isOpen" class="cursor-pointer text-center block px-3 h-6 bg-indigo-200/50 hover:bg-indigo-200 text-indigo-500 border border-transparent rounded-sm font-normal text-xs uppercase focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <div class="px-6 py-4 text-sm flex items-center justify-center">
                                            {{ $service->description }}
                                        </div>
                                    </x-modal>
                                    <!-- end::Show -->
                                </td>
                            </tr>
                        @endforeach

                        <x-slot name="pagination"></x-slot>
                    </x-table>
                </div>
                <!-- end::Services -->
            </div>
        </div>
        <!-- end::Offers And Services -->

        <div class="grid grid-cols-5 py-4">
            <div class="col-span-3 border-t"></div>
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
                <div class="w-full">
                    <label for="" class="text-sm text-slate-400">
                        {{ __('page.bookings.form.payment_method.label') }}
                    </label>

                    <x-select name="payment_method" placeholder="{{ __('actions.select.placeholder') }}">
                        @foreach (['bank', 'cash'] as $method)
                            <li
                                class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                                @click="$store.selection.select($el, '{{ $method }}'); visible = false"
                            >
                                {{ __('page.bookings.form.payment_method.items.' . $method) }}
                            </li>
                        @endforeach
                    </x-select>

                    @error('payment_method')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Payment Method -->

                <!-- begin::Paid Amount -->
                <div class="w-full">
                    <x-label
                        for="" value="{{ __('page.bookings.form.paid.label') }}"
                        class="text-sm text-slate-400"
                    />

                    <x-input
                        type="text" class="w-full" name="paid" value="{{ old('name') }}"
                        placeholder="{{ __('page.bookings.form.paid.placeholder') }}"
                        @change="$store.payment.setRemaining($el.value)"
                    />

                    @error('paid')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Paid Amount -->


                <!-- begin::Remaining -->
                <div class="col-span-1">
                    <label for="" class="text-sm text-slate-400">
                        {{ __('page.bookings.form.remaining.label') }}
                    </label>

                    <x-input
                        type="text" name="remaining" dir="ltr" readonly
                        class="remaining w-full mt-2 bg-slate-200/40 cursor-not-allowed text-slate-500
                        {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    />

                    @error('remaining')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Remaining Amount -->

                <!-- begin::Total -->
                <div class="w-full">
                    <x-label for="total" :value="__('page.bookings.form.total.label')" />

                    <x-input
                        type="text" dir="ltr" readonly
                        class="total w-full mt-2 bg-slate-200/40 cursor-not-allowed text-slate-500
                        {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    />
                    <input type="hidden" name="total" class="total">

                    @error('total')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Total -->
            </div>
        </div>
        <!-- end::Payment -->

        <div class="grid grid-cols-5 py-4">
            <div class="col-span-3 border-t"></div>
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
                <div class="w-full">
                    <x-label for="status" :value="__('page.bookings.form.status.label')" />

                    <x-select
                        name="status"
                        value="{{ old('status') }}"
                        display="{{ old('status') ? __('page.bookings.form.status.items.' . old('status')) : null }}"
                        placeholder="{{ __('actions.select.placeholder') }}"
                    >
                        @foreach (['confirmed', 'temporary'] as $status)
                            <li
                                class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                                @click="$store.selection.select($el, '{{ $status }}'); visible = false"
                            >
                                {{ __('page.bookings.form.status.items.' . $status) }}
                            </li>
                        @endforeach
                    </x-select>

                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Status -->

                <!-- begin::Notes -->
                <div class="w-full">
                    <x-label for="status" :value="__('page.bookings.form.notes.label')" />

                    <x-textarea class="resize-none" name="notes" value="{{ old('notes') }}" placeholder="{{ __('page.bookings.form.notes.placeholder') }}" />

                    @error('notes')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- end::Notes -->
            </div>
        </div>
        <!-- end::Additional Information -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-5 py-8">
            <div class="col-span-1"></div>

            <div class="col-span-2 flex items-center justify-between">
                <x-button>
                    {{ __('actions.add.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.bookings.index', $id) }}" />
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
