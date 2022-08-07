@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                <p class="mt-1 text-xs text-red-500 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} font-cairo">{{ $error }}</p>
            </li>
        @endforeach
    </ul>
@endif



