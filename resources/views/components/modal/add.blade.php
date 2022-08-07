@props([
    'show' => false,
    'width' => 'sm:max-w-3xl',
    'roles' => ['admin', 'employee']
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

                    <!-- begin::Photo -->
                    {{-- <div class="text-center">
                        <div class="flex items-center justify-center">
                            <div class="relative w-28 h-28 rounded-full">
                                <img  src="{{ asset('img/user.png') }}" alt="" class="object-center object-cover w-full h-full rounded-full border-none" id="photoPreview">

                                <button type="button" @click.prevent="userPhoto.click()" class="flex items-center justify-center p-2 rounded-full bg-slate-900 text-white absolute -bottom-2 right-3 border-4 border-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>

                            <input
                                type="file" name="photo" accept=".png, .jpg, .jpeg"
                                style="display: none" id="userPhoto"
                                @change="photoPreview.src = URL.createObjectURL(event.target.files[0])"
                            >
                        </div>

                        <p id="photoErrors" class="mt-4 text-xs text-red-500"></p>
                    </div> --}}
                    <!-- end::Photo -->

                    <!-- begin::Name -->
                    <div class="grid grid-cols-3 items-center">
                        <x-label for="name" class="col-span-1 text-center" :value="__('page.users.form.name.label')" />

                        <div class="col-span-2">
                            <x-input type="text" id="userName" class="w-full mt-1 text-center" name="name" value="{{ old('name') }}" placeholder="{{ __('page.users.form.name.placeholder') }}" required />

                            <p id="nameErrors"class="mt-1 text-xs text-red-500"></p>
                        </div>
                     </div>
                    <!-- end::Name -->

                    <!-- begin::Email -->
                    <div class="grid grid-cols-3 items-center">
                        <x-label for="email" class="col-span-1 text-center" :value="__('page.users.form.email.label')" />

                        <div class="col-span-2">
                            <x-input type="text" id="userEmail" class="w-full mt-1 text-center" name="email" value="{{ old('email') }}" placeholder="{{ __('page.users.form.email.placeholder') }}" required />

                            <p id="emailErrors" class="mt-1 text-xs text-red-500"></p>
                        </div>
                    </div>
                    <!-- end::Email -->

                    <!-- begin::Phone -->
                    <div class="grid grid-cols-3 items-center">
                        <x-label for="phone" class="col-span-1 text-center" :value="__('page.users.form.phone.label')" />

                        <div class="col-span-2 mt-1" dir="ltr">
                            <div class="flex items-center justify-center">
                                <span class="block bg-slate-200 text-slate-500 text-xs p-3 shadow-sm">+966</span>

                                <x-input type="text" id="userPhone" class="block flex-1 text-center" name="phone" value="{{ old('phone') }}" placeholder="{{ __('page.users.form.phone.placeholder') }}" required />
                            </div>
                            <p id="phoneErrors" class="mt-1 text-xs text-red-500"></p>
                        </div>
                    </div>
                    <!-- end::Phone -->

                    <!-- begin::Role -->
                    <div class="grid grid-cols-3 items-center pb-14">
                        <x-label for="role" class="col-span-1 text-center" :value="__('page.users.form.role.label')" />

                        <div class="col-span-2 mt-1">
                            <div x-data="{ visible: false }" class="w-full">
                                <div class="relative">
                                    <button type="button" @click="visible = ! visible" class="w-full flex items-center justify-between cursor-pointer rounded-sm shadow-sm bg-slate-100 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} sm:text-xs p-3" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                        <span id="selectedValue" class="block truncate text-slate-300">
                                            {{ __('page.users.form.role.placeholder') }}
                                        </span>

                                        <span class="block">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>

                                    <ul x-show="visible"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        @click.away="visible = false"
                                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-sm py-1 ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                        tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">

                                        @foreach ($roles as $role)
                                            <x-select.option value="{{ __('page.users.form.role.options.' . $role) }}" edit="false"/>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <p id="roleErrors" class="mt-1 text-xs text-red-500"></p>
                        </div>
                    </div>
                    <!-- end::Role -->

                    <!-- begin::Confirm Buttons -->
                    <div class="flex justify-end">
                        <x-button class="px-6 py-2" @click.prevent="$store.newUserForm.submit()">
                            {{ __('page.users.actions.add.confirm') }}
                        </x-button>
                    </div>
                    <!-- end::Confirm Button -->
				</form>
                <!-- end::New User Form -->
            </div>
        </div>
    </div>
</div>
