@props(['action', 'booking'])

<x-modal>
    <x-slot name="trigger">
        <x-button
            type="button"
            @click="isOpen = ! isOpen"
            bgColor="bg-green-200/50 hover:bg-green-500"
            size="px-3 py-1"
            textColor="text-green-600 hover:text-white"
            title="{{ app()->getLocale() === 'ar' ? 'القيام بعملية دفع' : 'Make a payment' }}"
            {{ $attributes->merge(['class' => 'block']) }}
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </x-button>
    </x-slot>

    <!-- begin::Delete Form -->
    <form method="POST" action="{{ $action }}" class="mt-2" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- begin::Form Content -->
        <div class="flex flex-col {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} px-24">
            <h3 class="text-lg font-semibold">
                {{ app()->getLocale() === 'ar' ? 'عملية دفع' : 'Payment Process' }}
            </h3>

            <div class="mt-4">
                <div class="flex items-center justify-between border border-slate-200 rounded-sm p-2">
                    <h4 class="text-slate-500 font-semibold">
                        {{ app()->getLocale() === 'ar' ? 'الإجمالي' : 'Total Amount' }}
                    </h4>
                    <span class="text-slate-500 font-semibold">
                        {{ number_format($booking->total, 2) }}
                    </span>
                </div>
                <div class="flex items-center justify-between border border-slate-200 rounded-sm p-2">
                    <h4 class="text-slate-500 font-semibold">
                        {{ app()->getLocale() === 'ar' ? 'المتبقي' : 'Remaining Amount' }}
                    </h4>
                    <span class="text-slate-500 font-semibold">
                        {{ number_format($booking->remaining, 2) }}
                    </span>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="paid" class="text-slate-500" value="{{ app()->getLocale() === 'ar' ? 'المبلغ المراد دفعه' : 'Paid Amount' }}" />

                <x-input
                    type="text" class="w-full bg-slate-50 text-slate-800 text-sm" name="paid" value="{{ old('paid') }}"
                    placeholder="{{ __('page.bookings.form.paid.placeholder') }}"
                />
            </div>

            <div class="mt-4">
                <label for="bankStatement" class="inline-block py-2 px-4 relative cursor-pointer bg-green-500 rounded-sm font-medium text-white focus-within:outline-none">
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'تحميل صورة إشعار الدفع' : 'Upload payment invoice image' }}
                    </span>
                    <input id="bankStatement" name="bank_statement" type="file" class="sr-only" accept=".png, .jpg, .jpeg">
                </label>

                <div class="mt-4">
                    <img src="#" alt="" id="bankStatementImage">
                </div>
            </div>
        </div>
        <!-- end::Form Content -->

        <!-- begin::Form Button -->
        <div class="flex justify-center mt-8">
            <x-button>
                {{ app()->getLocale() === 'ar' ? 'تأكيد الدفع' : 'Confirm Payment' }}
            </x-button>
        </div>
        <!-- end::Form Button -->
    </form>
    <!-- end::Delete Form -->
</x-modal>

@section('scripts')
    <script>
        bankStatement.onchange = (event) => {
            bankStatementImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
