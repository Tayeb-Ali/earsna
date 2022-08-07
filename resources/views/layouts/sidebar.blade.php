<aside class="sticky top-0 w-full h-screen bg-slate-900 flex flex-col overflow-y-auto">
    <div class="w-full hidden lg:block">
        <div class="h-16 bg-slate-800  flex items-center justify-center">
            <h1 class="uppercase font-black text-3xl tracking-wide text-slate-600">ersana</h1>
        </div>

        <!-- begin::Sidebar Links -->
        <div class="ps-2 pe-4 pt-6 space-y-1">
            @if (Auth::user()->isClient())
                @include('partials.client-sidebar')
            @else
                @include('partials.admin-sidebar')
            @endif
        </div>
        <!-- end::Sidebar Links -->
    </div>
</aside>
