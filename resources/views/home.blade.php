<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
</head>
<body class="space-y-10 sm:space-y-20 px-4">

<!-- nav -->
<div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-start sm:items-center py-4 gap-4 sm:gap-0">
    <h1 class="text-2xl text-teal-400 font-bold">{{config('app.name')}}</h1>

    <div class="flex justify-start items-center gap-10">
        <a href="#" class="text-teal-400 border-b-2 border-teal-400">Home</a>
        <a href="#" class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">Address</a>
        <a href="#"
           class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">About</a>
        <a href="#" class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">Contact
            Us</a>
    </div>

    @if (Auth::user())
        <div class="flex justify-end items-center gap-10">
            <a href="#"
               class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">{{Auth::user()->name}}</a>
            <a href="{{route('logout')}}"
               class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">Logout</a>
        </div>
    @else
        <div class="flex justify-start items-center gap-10">
            <a href="{{route('login')}}"
               class="text-gray-400 border-b-2 border-transparent hover:border-teal-400 hover:text-teal-400">Login</a>
            <a href="{{route('register')}}" class="text-white bg-teal-400 py-1 px-2 hover:bg-gray-400">Register</a>
        </div>
    @endif
</div>

<!-- hero -->
<div class="max-w-6xl mx-auto grid sm:grid-cols-2 sm:gap-20">
    <div class="flex flex-col gap-4 items-start justify-start">
        <p class="text-teal-400">Your beautiful wedding planner</p>
        <p class="text-5xl font-bold leading-snug">
            We organiser the perfect wedding for perfect you
        </p>
    </div>

    <div class="flex flex-col gap-2 items-start justify-center">
        <p class="text-gray-400 text-sm">
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
        </p>

        <a href="#" class="text-white bg-teal-400 py-3 px-5 hover:bg-gray-400 rounded-br-3xl">
            Book now!
        </a>
    </div>
</div>

<!-- banner -->
<div class="max-w-6xl mx-auto flex flex-col gap-4">
    <img src="{{asset('img/wedding.jpg')}}" class="rounded drop-shadow">
    <div class="flex justify-start items-center gap-10 pt-6 overflow-scroll">
        <img src="{{asset('img/logo-1.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-2.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-3.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-4.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-1.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-2.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-3.png')}}" class="grayscale h-24">
        <img src="{{asset('img/logo-4.png')}}" class="grayscale h-24">
    </div>
</div>

<!-- highlights -->
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-5xl font-bold">Highlights</p>
        <a href="#" class="bg-teal-400 p-4 rounded-tr-3xl hover:bg-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -rotate-45 text-white " viewBox="0 0 20 20"
                 fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
        <div class="flex flex-col gap-4 items-start justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1">
                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
            </svg>

            <p class="text-xl font-bold">Highlight 1</p>
            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>

        <div class="flex flex-col gap-4 items-start justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>

            <p class="text-xl font-bold">Highlight 2</p>
            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>

        <div class="flex flex-col gap-4 items-start justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
            </svg>

            <p class="text-xl font-bold">Highlight 3</p>
            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>

        <div class="flex flex-col gap-4 items-start justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>

            <p class="text-xl font-bold">Highlight 4</p>
            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>
    </div>
</div>

<!-- news -->
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-5xl font-bold">News</p>
        <a href="#" class="bg-teal-400 p-4 rounded-tr-3xl hover:bg-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -rotate-45 text-white " viewBox="0 0 20 20"
                 fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-2 gap-10">
        <div class="flex flex-col gap-4 items-start justify-start">

            <div class="h-48 w-full bg-cover bg-[url('/img/avenue-1.jpg')]"></div>

            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>
            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>

        <div class="flex flex-col gap-4 items-start justify-start">
            <div class="h-48 w-full bg-cover bg-[url('/img/avenue-2.jpg')]"></div>

            <p class="text-gray-400 text-sm">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            </p>

            <a href="#" class="text-teal-400 hover:text-gray-400 text-sm">Read more</a>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="max-w-6xl mx-auto flex flex-col items-center justify-center py-10 bg-gray-100 rounded gap-4">
    <p class="text-5xl font-bold max-w-md text-center leading-snug">Contact us now and try it out today!</p>
    <p class="text-gray-400 max-w-md text-center">Pellentesque habitant morbi tristique senectus et netus et malesuada
        fames ac
        turpis egestas.</p>
    <a href="#" class="text-white bg-teal-400 py-3 px-5 hover:bg-gray-400 rounded-br-3xl">
        Book now!
    </a>
</div>

<!-- footer -->
<div class="max-w-6xl mx-auto border-t border-teal-400 items-center justify-start py-4 text-gray-400 text-sm">
    Copy &copy; earsna.com {{ date('Y') }}
</div>

</body>

</html>
