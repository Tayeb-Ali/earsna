@props(['bgColor' => 'bg-slate-700 hover:bg-slate-800', 'size' => 'px-6 py-2', 'textColor' => 'text-slate-300'])

<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center border border-transparent rounded-sm font-normal
                        text-xs uppercase focus:outline-none disabled:opacity-25
                        transition ease-in-out duration-150 ' . $bgColor . ' ' . $size . ' ' . $textColor])
    }}
>
    {{ $slot }}
</button>
