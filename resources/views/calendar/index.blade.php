@php
    $calendarEventsUrl = Route::has('calendar.events') ? route('calendar.events') : url('/api/calendar-events');
@endphp

<x-layouts.public title="Calendario eventi">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">
                Calendario <span class="text-amber-600">eventi</span>
            </h1>
            <p class="mt-2 text-stone-600">
                Consulta le date degli appuntamenti in programma.
            </p>
        </div>

        <div
            class="rounded-2xl border border-stone-100 bg-white p-4 shadow-lg shadow-stone-200/60 sm:p-6 lg:p-8"
        >
            <div id="calendar" class="min-h-[600px]"></div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales-all.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var el = document.getElementById('calendar');
                if (!el || typeof FullCalendar === 'undefined') return;

                var calendar = new FullCalendar.Calendar(el, {
                    locale: 'it',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek',
                    },
                    height: 'auto',
                    events: function (fetchInfo, successCallback, failureCallback) {
                        var url = new URL(@json($calendarEventsUrl), window.location.origin);
                        url.searchParams.set('start', fetchInfo.startStr);
                        url.searchParams.set('end', fetchInfo.endStr);
                        fetch(url.toString(), {
                            credentials: 'same-origin',
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        })
                            .then(function (response) {
                                if (!response.ok) throw new Error('Network response was not ok');
                                return response.json();
                            })
                            .then(function (data) {
                                successCallback(data);
                            })
                            .catch(function (err) {
                                failureCallback(err);
                            });
                    },
                    eventClick: function (info) {
                        info.jsEvent.preventDefault();
                        if (info.event.url) {
                            window.location.href = info.event.url;
                        }
                    },
                });

                calendar.render();
            });
        </script>
    @endpush
</x-layouts.public>
