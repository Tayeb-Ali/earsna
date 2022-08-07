<a
    {{
        $attributes->merge(
            [
                'class' => 'px-6 py-2 border border-slate-300 rounded-sm
                font-semibold text-xs text-slate-300 hover:bg-slate-300 hover:text-white uppercase cursor-pointer focus:outline-none
                disabled:opacity-25 transition ease-in-out duration-150'
            ]
        )
    }}
>
    {{ __('actions.back')}}
</a>
