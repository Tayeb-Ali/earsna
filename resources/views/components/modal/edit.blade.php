@props([
    'show' => false,
    'width' => 'sm:max-w-3xl',
    'roles' => ['admin', 'employee'],
    'user'
])

<div
    class="fixed z-10 inset-0 overflow-y-auto"
	x-show="{{ $show }}"
	aria-labelledby="modal-title"
	role="dialog"
	aria-modal="true"
    style="display: none"
>
    <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">

        <div
            class="fixed inset-0 bg-slate-900/50 transition-opacity"
            x-show="{{ $show }}"
			x-transition:enter="ease-out duration-300"
			x-transition:enter-start="opacity-0"
			x-transition:enter-end="opacity-100"
			x-transition:leave="ease-in duration-200"
			x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0"
			aria-hidden="true">
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            class="inline-block align-bottom bg-white rounded-sm overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $width }} sm:w-full"
            x-show="{{ $show }}"
            @click.away="isOpen = false"
			x-transition:enter="ease-out duration-300"
			x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
			x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
			x-transition:leave="ease-in duration-200"
			x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
			x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >

            <div class="bg-white sm:py-8">
                <!-- begin::Close Button -->
                <div class="flex items-center sm:px-6">
                    <button type="button" @click = "isOpen = false"
                            class="text-slate-300 hover:text-slate-400 bg-slate-50 hover:bg-slate-100 p-2 rounded-sm focus:outline-none transition ease-in-out duration-150"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- end::Close Button -->

                <!-- begin::New User Form -->
                <form method="POST" action="#" class="sm:px-12 space-y-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
					@csrf

                    {{ $slot }}
				</form>
                <!-- end::New User Form -->
            </div>
        </div>
    </div>
</div>
