@props(['value'])
<textarea {{ $attributes->merge(['class' => 'rounded-sm border-none shadow-sm size-none placeholder-slate-300 w-full mt-2 text-sm resize-none focus:ring-0']) }} rows="3">{{ $value ?? $slot }}</textarea>
