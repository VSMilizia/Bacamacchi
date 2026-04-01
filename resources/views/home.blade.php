<x-layouts.public title="Ditta Bacamacchi — Eventi, Tradizione e Cultura">
    <section class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-700 px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.15),transparent_50%)]" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-4xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white drop-shadow-sm sm:text-5xl lg:text-6xl">
                Ditta Bacamacchi
            </h1>
            <p class="mt-4 text-xl font-medium text-amber-100 sm:text-2xl">
                Eventi, Tradizione e Cultura
            </p>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-amber-50/95">
                Benvenuti nel nostro spazio dedicato agli eventi: scopri appuntamenti unici, prenota il tuo posto in pochi passaggi e vivi momenti indimenticabili insieme alla comunità.
            </p>
            <div class="mt-10">
                <a
                    href="{{ route('events.index') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-3.5 text-base font-semibold text-amber-800 shadow-lg transition hover:bg-amber-50 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-amber-600"
                >
                    Scopri gli Eventi
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Prossimi Eventi</h2>
            <p class="mt-2 text-gray-600">Non perdere i prossimi appuntamenti in programma.</p>
        </div>

        @if ($upcomingEvents->isEmpty())
            <div class="rounded-2xl border border-amber-100 bg-amber-50/40 px-6 py-14 text-center">
                <p class="text-lg text-gray-700">
                    Al momento non ci sono eventi in programma. Torna presto a trovarci: stiamo preparando nuove esperienze per te.
                </p>
                <a
                    href="{{ route('events.index') }}"
                    class="mt-6 inline-flex font-semibold text-amber-700 underline decoration-amber-300 decoration-2 underline-offset-4 hover:text-amber-600"
                >
                    Vedi tutti gli eventi
                </a>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($upcomingEvents as $event)
                    <article class="group flex flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:border-amber-200 hover:shadow-md">
                        @if ($event->image)
                            <a href="{{ route('events.show', $event->slug) }}" class="relative aspect-[16/10] overflow-hidden bg-amber-100">
                                <img
                                    src="{{ asset('storage/' . $event->image) }}"
                                    alt=""
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            </a>
                        @else
                            <a href="{{ route('events.show', $event->slug) }}" class="relative flex aspect-[16/10] items-center justify-center bg-gradient-to-br from-amber-200 to-amber-400">
                                <span class="text-4xl opacity-60" aria-hidden="true">📅</span>
                            </a>
                        @endif
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('events.show', $event->slug) }}" class="transition hover:text-amber-700">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <p class="mt-2 text-sm text-amber-800">
                                {{ $event->start_date->format('d/m/Y H:i') }}
                            </p>
                            @if ($event->location)
                                <p class="mt-1 text-sm text-gray-600">{{ $event->location }}</p>
                            @endif
                            <p class="mt-3 text-sm font-medium text-gray-800">
                                @if ($event->isFree())
                                    Gratuito
                                @else
                                    € {{ number_format((float) $event->price, 2, ',', '.') }}
                                @endif
                            </p>
                            @if ($event->short_description)
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-gray-600">
                                    {{ Str::limit($event->short_description, 120) }}
                                </p>
                            @endif
                            <a
                                href="{{ route('events.show', $event->slug) }}"
                                class="mt-4 inline-flex text-sm font-semibold text-amber-700 transition hover:text-amber-600"
                            >
                                Scopri di più
                                <span class="ms-1" aria-hidden="true">→</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section class="border-t border-amber-100 bg-gradient-to-b from-amber-50/80 to-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-center text-3xl font-bold text-gray-900">Come Funziona</h2>
            <p class="mx-auto mt-2 max-w-2xl text-center text-gray-600">
                Tre passaggi semplici per partecipare ai nostri eventi.
            </p>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="rounded-2xl border border-amber-100 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 012.25 2.25v7.5" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900">Scegli un Evento</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Esplora il calendario e trova l’esperienza che fa per te.
                    </p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v10.5c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900">Prenota il tuo Posto</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Registrati, completa la prenotazione e il pagamento in sicurezza.
                    </p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.847a4.5 4.5 0 003.09 3.09L15.75 12l-2.847.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423L16.5 15.75l.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900">Vivi l'Esperienza</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Presentati all’evento e goditi la cultura e la convivialità.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
