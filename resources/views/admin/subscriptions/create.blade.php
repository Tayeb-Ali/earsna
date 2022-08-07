{{-- @section('scripts')
    <script>
        function getClientId(clientId) {
            @php
                $client_id = clientId
            @endphp
        }
    </script>
@endsection --}}

<x-app-layout>
   
    <x-slot name="header" class="py-6">
        {{ __('page.subscriptions.create.header') }}
    </x-slot>

    <form action="{{ route('subscriptions.store') }}" method="POST" class="space-y-4 pb-16">
        @csrf

        <!-- begin::Client -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <div class="flex items-center justify-between">
                    <x-label for="client" :value="__('page.subscriptions.form.client.label')" />

                    <x-actions.add href="{{ route('clients.create', ['redirect' => 'subscriptions.create']) }}" size="p-1" />
                </div>

                <x-select name="client_id" value="{{ old('client_id') }}" placeholder="{{ __('page.subscriptions.form.client.placeholder') }}">
                    @foreach ($clients as $client)
                        <li
                            class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $client->id }}'); visible = false; $store.client.set('{{ $client->id }}')"
                        >
                            {{ $client->user->name }}
                        </li>
                    @endforeach
                </x-select>

                @error('client_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Client -->

        <!-- begin::Package -->
        <div class="grid grid-cols-2">
            <div class="col-span-2 max-w-[560px]">
                <x-label for="package" :value="__('page.subscriptions.form.package.label')" />

                <x-select name="package_id" placeholder="{{ __('page.subscriptions.form.package.placeholder') }}">
                    @foreach ($packages as $package)
                        <li class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                            @click="$store.selection.select($el, '{{ $package->id }}'); visible = false"
                        >
                            {{ $package->name }}
                        </li>
                    @endforeach
                </x-select>

                @error('package_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- end::Package -->

        {{-- <div class="grid grid-cols-2 py-2">
            <div class="col-span-2 max-w-[560px]">
                <hr>
            </div>
        </div>

        <div class="grid grid-cols-2">
            <a
                href="{{ route('halls.create', ['target_client_id' => isset($client_id) ? $client_id : null]) }}"
                class="py-2.5 px-4 text-xs text-white bg-green-400 hover:bg-green-500 shadow-sm rounded-sm mb-px transition duration-150 ease-in-out"
            >
                {{ __('page.subscriptions.form.hall.button') }}
            </a>

            <div class="col-span-2 max-w-[560px]">
                <x-label for="date" :value="__('page.halls.index.header')" class="mb-2" />

                <x-table id="halls" page="halls" :columns="['name', 'city', 'address', 'capacity']">

                    <x-slot name="pagination"></x-slot>
                </x-table>

                @error('halls') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                @error('halls.*.name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                @error('halls.*.city') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                @error('halls.*.address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                @error('halls.*.capacity') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- begin::Hall -->
        <div x-data class="space-y-4 mt-4">
            <!-- begin::Hall Name -->
            <div class="grid grid-cols-2">
                <div class="col-span-2 max-w-[560px]">
                    <x-label for="hall_name" :value="__('page.subscriptions.form.hall.name.label')" />

                    <x-input
                        type="text" class="w-full" id="hallName"
                        placeholder="{{ __('page.subscriptions.form.hall.name.placeholder') }}"
                    />
                </div>
            </div>
            <!-- end::Hall Name -->

            <!-- begin::Hall Location -->
            <div class="grid grid-cols-2">
                <div class="col-span-2 max-w-[560px]">
                    <div class="grid grid-cols-2 gap-x-2">
                        <!-- begin::Hall City -->
                        <div class="col-span-1">
                            <x-label for="city" :value="__('page.subscriptions.form.hall.city.label')" />

                            <x-select id="hallCity" placeholder="{{ __('page.subscriptions.form.hall.city.placeholder') }}">
                                @foreach (['bahri', 'khartoum', 'madani', 'omdurman','port Sudan'] as $city)
                                    <li
                                        class="text-gray-800 text-sm hover:bg-slate-50 cursor-pointer select-none py-2 ps-3 pe-9" role="option"
                                        @click="$store.selection.select($el, '{{ $city }}'); visible = false"
                                    >
                                        {{ __('cities.' . $city) }}
                                    </li>
                                @endforeach
                            </x-select>
                        </div>
                        <!-- end::Hall City -->

                        <!-- begin::Hall Address -->
                        <div class="col-span-1">
                            <x-label for="hall_address" :value="__('page.subscriptions.form.hall.address.label')" />

                            <x-input
                                type="text" class="w-full" id="address"
                                placeholder="{{ __('page.subscriptions.form.hall.address.placeholder') }}"
                            />

                            @error('address')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- end::Hall Address -->
                    </div>
                </div>
            </div>
            <!-- end::Hall Location -->

            <!-- begin::Hall Capacity -->
            <div class="grid grid-cols-2">
                <div class="col-span-2 max-w-[560px]">
                    <x-label for="capacity" :value="__('page.halls.form.capacity.label')" />

                    <x-input
                        type="text" class="w-full" id="capacity"
                        placeholder="{{ __('page.halls.form.capacity.placeholder') }}"
                    />
                </div>
            </div>
            <!-- end::Hall Capacity -->

            <div class="grid grid-cols-2">
                <div class="col-span-2 max-w-[560px]">
                    <button
                        type="button"
                        class="py-2.5 px-4 text-xs text-white bg-green-400 hover:bg-green-500 shadow-sm rounded-sm mb-px transition duration-150 ease-in-out"
                        @click.prevent="$store.halls.add()"
                    >
                        {{ __('page.subscriptions.form.hall.button') }}
                    </button>
                </div>
            </div>
        </div> --}}
        <!-- end::Hall -->

        <!-- begin::Form Button -->
        <div class="grid grid-cols-2">
            <div class="col-span-3 max-w-[560px] flex items-center justify-between pt-6">
                <a
                    href="{{ route('halls.create', ['target_client_id' => isset($client_id) ? $client_id : null]) }}"
                    class="inline-block py-2 px-4 uppercase text-center text-xs text-white bg-green-400 hover:bg-green-500 shadow-sm rounded-sm mb-px transition duration-150 ease-in-out"
                >
                    {{ __('page.subscriptions.form.hall.button') }}
                </a>

                <div class="flex items-center space-x-3">
                    <x-actions.back href="{{ route('subscriptions.index') }}" />
    
                    <x-button>
                        {{ __('actions.add.form')}}
                    </x-button>
                </div>
            </div>
        </div>
        <!-- end::Form Button -->
    </form>
</x-app-layout>


