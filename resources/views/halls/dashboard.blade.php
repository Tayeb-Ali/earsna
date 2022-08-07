<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    @endsection

    <x-slot name="header">
        {{ __('page.dashboard.header') }}
    </x-slot>

    <div class="grid grid-cols-5 gap-x-6">
        <div class="col-span-1 bg-sky-300 text-white rounded-sm shadow-sm">
            <div class="flex items-center h-10 px-3">
                {{ __('page.dashboard.cards.bookings.all') }}
            </div>
            <hr>
            <div class="h-20 flex items-center text-3xl px-3">
                {{ $bookings }}
            </div>
        </div>
        <div class="col-span-1 bg-teal-300 text-white rounded-sm shadow-sm">
            <div class="flex items-center h-10 px-3">
                {{ __('page.dashboard.cards.bookings.confirmed') }}
            </div>
            <hr>
            <div class="h-20 flex items-center text-3xl px-3">
                {{ $temporary_bookings }}
            </div>
        </div>
        <div class="col-span-1 bg-indigo-300 text-white rounded-sm shadow-sm">
            <div class="flex items-center h-10 px-3">
                {{ __('page.dashboard.cards.bookings.temporary') }}
            </div>
            <hr>
            <div class="h-20 flex items-center text-3xl px-3">
                {{ $confirmed_bookings }}
            </div>
        </div>
        <div class="col-span-1 bg-pink-300 text-white rounded-sm shadow-sm">
            <div class="flex items-center h-10 px-3">
                {{ __('page.dashboard.cards.bookings.canceled') }}
            </div>
            <hr>
            <div class="h-20 flex items-center text-3xl px-3">
                {{ $paid_bookings }}
            </div>
        </div>
        <div class="col-span-1 bg-orange-300 text-white rounded-sm shadow-sm">
            <div class="flex items-center h-10 px-3">
                {{ __('page.dashboard.cards.bookings.paid') }}
            </div>
            <hr>
            <div class="h-20 flex items-center text-3xl px-3">
                {{ $canceled_bookings }}
            </div>
        </div>
    </div>

    <div id="calendar" class="p-6 bg-white border-t-8 border-yellow-400 rounded-sm mt-12"></div>

    <div class="grid grid-cols-12 gap-x-12 my-12">
        <div class="col-span-8 bg-white p-6 rounded-sm">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>

        <div class="col-span-4">
            <div class="bg-white rounded-sm p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <x-label value="{{ __('page.dashboard.boxes.revenues.all') }}" />
                    <span class="block text-slate-600">{{ number_format($revenues, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <x-label value="{{ __('page.dashboard.boxes.revenues.collected') }}" />
                    <span class="block text-slate-600">{{ number_format($collected_revenues, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <x-label value="{{ __('page.dashboard.boxes.revenues.uncollected') }}" />
                    <span class="block text-slate-600">{{ number_format($uncollected_revenues, 2) }}</span>
                </div>
            </div>
            <div class="bg-white rounded-sm p-6 mt-6">
                <div class="flex items-center justify-between">
                    <x-label value="{{ __('page.dashboard.boxes.expenses.all') }}" />
                    <span class="block text-slate-600">{{ number_format($expenses, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    timezone: 'local',
                    events: {!! $events !!}
                });
                calendar.render();
            });
        </script>

        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {{ json_encode($months['labels']) }},
                    datasets: [{
                        label: {{ __('dashboard.charts.bar.label') }},
                        data: {{ json_encode($months['data']) }}
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
