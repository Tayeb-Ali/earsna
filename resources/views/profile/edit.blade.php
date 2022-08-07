<x-app-layout>
    <x-slot name="header"></x-slot>

    <form  x-data action="{{ route('profile.update') }}" method="POST" class="flex items-start" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <div class="h-64 w-64 overflow-hidden">
                <div id="avatar" class="h-full w-full">
                    @if (auth()->user()->photo)
                        <div
                            style="background-image: url({{ asset('storage/' . substr(auth()->user()->photo, 6)) }})"
                            class="h-full w-full bg-cover bg-center"
                        ></div>
                    @else
                        <div class="bg-slate-200 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64 text-slate-50" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div id="preview" class="h-full w-full bg-cover bg-center"></div>
            </div>


            <label for="photo" class="block py-2 rounded-sm bg-green-400 mt-2 text-sm text-white text-center hover:bg-green-500 transition duration-150 ease-in-out">
                {{ __('page.profile.photo')}}

                <input id="photo" type="file" name="photo" class="sr-only" accept=".png,.jpg,.jpeg" @change="$store.profile.preview()">
            </label>

            <a href="{{ route('profile.show') }}" class="block py-2 rounded-sm bg-white mt-2 text-sm text-slate-500 text-center hover:bg-slate-50 transition duration-150 ease-in-out">
                {{ __('actions.back') }}
            </a>

        </div>

        <div class="space-y-4 ms-16">

            <div>
                <x-label for="name" value="{{ __('page.profile.name') }}" />

                <x-input id="name" type="text" name="name" value="{{ auth()->user()->name }}"/>
            </div>

            <div>
                <x-label for="phone" value="{{ __('page.profile.phone') }}" />

                <x-input id="phone" type="text" name="phone" placeholder="{{ __('Enter phone number') }}" value="{{ auth()->user()->phone }}"/>
            </div>

            <div>
                <x-label for="password" value="{{ __('page.profile.password') }}" />

                <x-input id="password" type="password" name="password" placeholder="{{ __('Enter new Password') }}" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('page.profile.confirm_password') }}" />

                <x-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Confirm new password') }}" />
            </div>

            <div>
                <button
                    type="submit"
                    class="block w-full py-3 bg-slate-700 hover:bg-gray-800 text-center border border-transparent rounded-sm font-semibold text-xs text-slate-300 uppercase cursor-pointer focus:outline-none disabled:opacity-25 transition ease-in-out duration-150'">
                    {{ __('page.profile.update') }}
                </button>


            </div>
        </div>
    </form>
</x-app-layout>
