@props(['active', 'border' => app()->getLocale() === 'ar' ? 'border-r-4' : 'border-l-4'])

@php
$classes = ($active ?? false)
            ? 'block ps-3 pe-4 py-2 border-slate-300 text-sm font-medium text-slate-700 bg-slate-50 focus:outline-none focus:text-slate-800 focus:bg-slate-100 transition duration-150 ease-in-out '
            : 'block ps-3 pe-4 py-2 border-transparent hover:border-slate-300 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 focus:outline-none focus:text-slate-800 focus:bg-slate-50 transition duration-150 ease-in-out ';
@endphp

<a {{ $attributes->merge(['class' => $classes . $border]) }}>
    {{ $slot }}
</a>
