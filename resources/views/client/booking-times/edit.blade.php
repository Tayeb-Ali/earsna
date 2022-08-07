<x-app-layout>
    <x-slot name="header" class="py-6">
        {{ __('page.bookingTimes.create.header') }}
    </x-slot>

    <form action="{{ route('halls.booking-times.update', ['hall' => Session::get('hall')->id, 'booking_time' => $bookingTime->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- begin::Period -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="period" :value="__('page.bookingTimes.form.period.label')" class="text-xs" />

                <x-select id="period" name="period" value="{{ $bookingTime->period }}" display="{{ __('page.bookingTimes.form.period.items.' . $bookingTime->period) }}" placeholder="{{ __('actions.select.placeholder') }}">
                    @foreach (['day', 'evening'] as $period)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" business_field="option"
                            @click="$store.selection.select($el, '{{ $period }}'); visible = false"
                        >
                            {{ __('page.bookingTimes.form.period.items.' . $period) }}
                        </li>
                    @endforeach
                </x-select>
            </div>
        </div>
        <!-- end::Period -->

        <!-- begin::From / To -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <div class="grid grid-cols-2 gap-x-6">
                    <!-- begin::From -->
                    <div class="col-span-1">
                        <x-label for="from" :value="__('page.bookingTimes.form.from.label')" class="text-xs" />

                        <input
                            type="text" id="from" name="from" value="{{ $bookingTime->from }}" placeholder="{{ __('page.bookingTimes.form.from.placeholder') }}"  readonly="readonly"
                            class="time-pickers flatpickr flatpickr-input w-full bg-white placeholder-slate-300 rounded-sm text-sm shadow-sm border-none outline-none focus:outline-none focus:ring-0 mt-2"
                            data-id="multipleCustomConjunction"
                        >

                        @error('from')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::From -->

                    <!-- begin::To -->
                    <div class="col-span-1">
                        <x-label for="to" :value="__('page.bookingTimes.form.to.label')" class="text-xs" />

                        <input
                            type="text" id="to" name="to" value="{{ $bookingTime->to }}" placeholder="{{ __('page.bookingTimes.form.to.placeholder') }}" readonly="readonly"
                            class="time-pickers flatpickr flatpickr-input w-full bg-white placeholder-slate-300 rounded-sm text-sm shadow-sm border-none outline-none focus:outline-none focus:ring-0 mt-2"
                            data-id="multipleCustomConjunction"
                        >

                        @error('to')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- end::To -->
                </div>
            </div>
        </div>
        <!-- end::From / To -->

        <!-- begin::Price -->
        <div class="grid grid-cols-2">
            <div class="col-span-1">
                <x-label for="price" :value="__('page.bookingTimes.form.price.label')" class="text-xs" />

                <x-input
                    type="text" id="price" name="price" value="{{ $bookingTime->price }}" class="w-full"
                    placeholder="{{ __('page.bookingTimes.form.price.placeholder') }}"
                />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Price -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2 pt-8">
            <div class="col-span-2 max-w-[560px] flex items-center justify-between">
                <x-button>
                    {{ __('actions.edit.form')}}
                </x-button>

                <x-actions.back href="{{ route('halls.booking-times.index', Session::get('hall')->id) }}">
                    {{ __('actions.back')}}
                </x-actions.back>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>
