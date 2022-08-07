@props(['package'])

<!-- begin::Package -->
<div class="bg-white shadow-sm rounded-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} flex flex-col justify-cener">
    <!-- begin::Package Header -->
    <div class="flex items-center justify-between text-sm text-slate-500 py-3 px-4 border-b border-slate-100">
        <div>
            {{ $package->name }}
        </div>
        <!-- begin::Actions -->
        <div class="flex items-center space-s-1">
            <!-- begin::Edit -->
            <x-actions.edit href="{{ route('packages.edit', $package->id) }}">
                {{ __('actions.edit.page') }}
            </x-actions.edit>
            <!-- end::Edit -->

            <!-- begin::Delete -->
            <x-modal>
                <x-slot name="trigger">
                    <x-button
                        type="button"
                        @click="isOpen = ! isOpen"
                        bgColor="bg-red-200/50 hover:bg-red-200"
                        size="px-3 py-1"
                        textColor="text-red-600"
                    >
                        {{ __('actions.delete.page')}}
                    </x-button>
                </x-slot>

                <!-- begin::Delete Form -->
                <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="mt-6 space-y-8">
                    @csrf
                    @method('DELETE')

                    <!-- begin::Form Content -->
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <p class="text-lg font-bold text-center text-slate-800 mt-2">
                            {{ __('actions.delete.warning.title') }}
                        </p>
                        <p class="text-sm text-center text-slate-400 mt-2">
                            {{ __('actions.delete.warning.sentence') }}
                        </p>
                    </div>
                    <!-- end::Form Content -->

                    <!-- begin::Form Button -->
                    <div class="flex justify-center">
                        <x-button bgColor="bg-red-400 hover:bg-red-500" textColor="text-white">
                            {{ __('actions.delete.form') }}
                        </x-button>
                    </div>
                    <!-- end::Form Button -->
                </form>
                <!-- end::Delete Form -->
            </x-modal>
            <!-- end::Delete -->
        </div>
        <!-- end::Actions -->
    </div>
    <!-- end::Package Header -->

    <!-- begin::Package Body -->
    <div class="py-4 px-4 flex-1">
        <ul class="py-4 space-y-6 text-sm">
            @foreach ($package->features as $feature)
                <li class="flex space-s-2 text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </sv>
                    <span class="block"> {{ $feature->description }} </span>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- end::Package Body -->

    <!-- begin::Package Footer -->
    <div class="bg-slate-50 py-4 px-4 text-center text-2xl text-slate-500 tracking-wide">
        {{ $package->price }}
    </div>
    <!-- end::Package Footer -->
</div>
<!-- end::Package -->
