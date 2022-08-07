<x-settings-layout>
    @if (Auth::user()->isClient())
        @error('no-setting')
            <p class="text-sm text-red-500 py-2">
                {{ $message }}
            </p>
        @enderror

        <!-- begin::Hall Name -->
        <div>
            <p class="max-w-2xl leading-loose text-sm text-slate-400">
                إسم القاعة
            </p>

            <form action="{{ route('halls.settings.update', ['hall' => Session::get('hall')->id]) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                        <x-input
                            name="hall_name" value="{{ session('hall')->name }}"
                            class="w-full p-2 {{ $errors->has('hall_name') ? 'placeholder-red-500 border border-red-500' : 'placeholder-slate-300 border-none' }}"
                            placeholder="{{ $errors->has('hall_name') ? $errors->get('hall_name')[0] : __('الرجاء إدخال إسم القاعة') }}" />

                        @error('hall_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <x-button type="submit" class="block mt-6">حفظ</x-button>
            </form>
        </div>
        <!-- end::Hall Name -->

        <!-- begin::Before Booking Due Date -->
        <div class="mt-8">
            <p class="max-w-2xl leading-loose text-sm text-slate-400">
                عدد الأيام اللازمة و التي ستكون قبل موعد مناسبة الحجز لإرسال تنبيه لصاحب الحجز لدفع المبلغ المالي الذي عليه كاملاً في حال كان متبقي عليه جزء من المبلغ.
            </p>

            <form action="{{ route('halls.settings.update', ['hall' => Session::get('hall')->id]) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                        <x-input
                            name="days_before_booking_due_date" value="{{ $settings->where('name', 'days_before_booking_due_date')->first()->value }}"
                            class="w-full p-2 {{ $errors->has('days_before_booking_due_date') ? 'placeholder-red-500 border border-red-500' : 'placeholder-slate-300 border-none' }}"
                            placeholder="{{ $errors->has('days_before_booking_due_date') ? $errors->get('b')[0] : __(' الرجاء إدخال عدد الأيام') }}" />

                        @error('days_before_booking_due_date')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <x-button type="submit" class="block mt-6"> حفظ </x-button>
            </form>
        </div>
        <!-- end::Before Booking Due Date -->
    @else
        <div class="h-96 w-full flex items-center justify-center text-sm text-slate-400">
            {{ __('page.settings.greeting') }}
        </div>
    @endif
</x-settings-layout>
