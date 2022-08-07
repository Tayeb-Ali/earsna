
<!-- begin::General -->
<a href="{{ route('halls.settings', ['hall' => Session::get('hall')->id]) }}" class="block text-sm ps-6 hover:underline">
    {{ __('sidebar.general') }}
</a>
<!-- end::General -->

<!-- begin::Booking Times -->
<a href="{{ route('halls.booking-times.index', Session::get('hall')->id) }}" class="block text-sm ps-6 hover:underline">
    {{ __('sidebar.booking_times') }}
</a>
<!-- end::Booking Times -->

<!-- begin::Offers -->
<a href="{{ route('halls.offers.index', Session::get('hall')->id) }}" class="block text-sm ps-6 hover:underline">
    {{ __('sidebar.offers') }}
</a>
<!-- end::Offers -->

<!-- begin::Services -->
<a href="{{ route('halls.services.index', Session::get('hall')->id) }}" class="block text-sm ps-6 hover:underline">
    {{ __('sidebar.services') }}
</a>
<!-- end::Services -->

