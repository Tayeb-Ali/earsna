<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @notifyCss

</head>
<body class="font-cairo antialiased">
<div class="min-h-screen bg-gray-100 grid grid-cols-12">

    <!-- begin::Sidebar -->
    <div class="col-span-2 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <div class="col-span-1 hidden sm:block lg:hidden">
        @include('layouts.responsive-sidebar')
    </div>
    <!-- end::Sidebar -->

    <div class="col-span-12 sm:col-span-11 lg:col-span-10">
        <!-- begin::Navigation -->
        @include('layouts.navigation')
        <!-- end::Navigation -->

        <!-- begin::Page -->
        <div class="col-span-10 max-w-6xl mx-auto px-4">
            <!-- begin::Page Heading -->
            <header>
                @if (Session::has('message'))
                    <div class="mt-6 flex items-center justify-between px-4 py-4 rounded-sm bg-green-100 text-green-800 border border-gray-100 text-xs">
                        <p>{{ Session::get('message') }}</p>

                        <button type="button" onclick="this.parentElement.remove()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div {{ $header->attributes->merge(['class' => 'flex items-center justify-between pt-8 pb-4']) }}>
                    {{ $header }}
                </div>
            </header>
            <!-- end::Page Heading -->

            <!-- begin::Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- end::Page Content -->
        </div>
        <!-- end::Page -->
    </div>
</div>

<!-- Scripts -->
@yield('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
{{--@include('notify::messages')--}}
<x:notify-messages/>
@notifyJs

</body>
</html>
