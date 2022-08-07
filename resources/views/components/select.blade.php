@props(['name' => null, 'value' => null, 'display' => null, 'placeholder' => null])

<!-- This example requires Tailwind CSS v2.0+ -->
<div x-data="{ visible: false }" {{ $attributes->merge(['class' => 'w-full mt-2']) }}>
    <div class="relative">
        <input
            type="text" value="{{ $display }}" placeholder="{{ $placeholder }}" readonly
            @click="visible = true"
            class="w-full cursor-pointer rounded-sm shadow-sm bg-white mt-2 border-none line-clamp-1
            {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} placeholder-slate-300 text-sm py-2 focus:ring-0"
            aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label"
        >

        <input type="hidden" name="{{ $name }}" value="{{ $value }}">

        <span class="absolute bg-white {{ app()->getLocale() === 'ar' ? 'left-2' : 'right-2' }} top-3">
            <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
            </svg>
        </span>

        <ul x-show="visible"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click.away="visible = false"
            class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-sm py-1 ring-1
            ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
            tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">

            {{ $slot }}
        </ul>
    </div>
</div>
