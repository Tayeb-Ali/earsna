<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="flex flex-col sm:flex-row items-start sm:space-s-16">
        <div class="">
            @if (auth()->user()->photo)
                <div
                    style="background-image: url({{ asset('storage/' . substr(auth()->user()->photo, 6)) }})"
                    class="h-64 w-64 bg-cover bg-center"
                ></div>
            @else
                <div class="bg-slate-200 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64 text-slate-50" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif

            <a href="{{ route('profile.edit') }}" class="py-2 px-4 text-center text-slate-500 border bg-white block mt-4 hover:bg-slate-50 transition duration-150 ease-in-out">
                {{ __('page.profile.edit') }}
            </a>
        </div>
        <div class="space-y-4">
            <div>
                <span class="text-slate-400 block text-base">
                    {{ __('page.profile.name') }}&colon;
                </span>
                <span class="text-slate-500 block text-base">
                    {{ auth()->user()->name }}
                </span>
            </div>
            <div>
                <span class="text-slate-400 block text-base">
                    {{ __('page.profile.email') }}&colon;
                </span>
                <span class="text-slate-500 block text-base">
                    {{ auth()->user()->email }}
                </span>
            </div>
            <div>
                <span class="text-slate-400 block text-base">
                    {{ __('page.profile.phone') }}&colon;
                </span>
                <span class="text-slate-500 block text-base {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}" dir="ltr">
                    {{ auth()->user()->phone }}
                </span>
            </div>
        </div>
    </div>
</x-app-layout>
