<div {{ $attributes->merge(['class' => 'grid grid-cols-4 items-center']) }}>
    <div class="col-span-1 text-center">
        {{ $label }}
    </div>

    <div class="col-span-3 mt-1">
        {{ $slot }}
    </div>
</div>
