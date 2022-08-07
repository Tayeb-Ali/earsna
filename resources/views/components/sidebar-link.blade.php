@props(['active'])

<a {{ $attributes->merge(['class' => 'flex items-center justify-between hover:bg-slate-800/60 ps-4 py-3 rounded-sm text-slate-600 hover:text-slate-500 transition duration-150 ease-in-out']) }}>
    <div class="flex items-center space-s-3">
        {{ $slot }}
    </div>

    @if ($active)
        <div class="block h-2 w-2 rounded-full bg-slate-600 me-4"></div>
    @endif
</a>
