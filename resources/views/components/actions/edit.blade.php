@php
    $class = 'block px-3 py-1 bg-blue-200/50 hover:bg-blue-500 text-blue-500 hover:text-white border border-transparent
                    rounded-sm font-semibold font-normal text-xs uppercase focus:outline-none disabled:opacity-25
                    transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $class ]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
</a>
