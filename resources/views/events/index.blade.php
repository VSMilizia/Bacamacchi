<x-layouts.public title="Tutti gli Eventi">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-10 text-center sm:text-left">
            <h1 class="text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">
                Tutti gli <span class="text-amber-600">Eventi</span>
            </h1>
            <p class="mt-2 text-stone-600">
                Scopri le prossime iniziative di Ditta Bacamacchi.
            </p>
        </div>

        {{-- Barra ricerca / filtri (solo UI) --}}
        <div
            class="mb-10 rounded-xl border border-amber-100 bg-white p-4 shadow-sm ring-1 ring-amber-50 sm:p-6"
            role="search"
            aria-label="Cerca eventi"
        >
            <form class="flex flex-col gap-4 sm:flex-row sm:items-end" action="#" method="get" onsubmit="return false;">
                <div class="min-w-0 flex-1">
                    <label for="event-search" class="mb-1.5 block text-sm font-medium text-stone-700">
                        Cerca
                    </label>
                    <input
                        id="event-search"
                        type="search"
                        name="q"
                        placeholder="Titolo, luogo, parola chiave…"
                        class="w-full rounded-lg border border-stone-200 bg-stone-50 px-4 py-2.5 text-stone-900 shadow-inner transition placeholder:text-stone-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                    />
                </div>
                <button
                    type="button"
                    class="inline-flex shrink-0 items-center justify-center rounded-lg bg-amber-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                >
                    Cerca
                </button>
            </form>
        </div>

        @if ($events->isEmpty())
            <p class="rounded-xl border border-dashed border-amber-200 bg-amber-50/50 px-6 py-12 text-center text-stone-600">
                Nessun evento disponibile al momento.
            </p>
        @else
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($events as $event)
                    <article
                        class="group flex flex-col overflow-hidden rounded-xl border border-stone-100 bg-white shadow-md shadow-amber-900/5 transition hover:border-amber-200 hover:shadow-lg hover:shadow-amber-900/10"
                    >
                        <a href="{{ route('events.show', $event->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-amber-100">
                            @if ($event->image)
                                <img
                                    src="{{ asset('storage/' . $event->image) }}"
                                    alt=""
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-amber-200 via-amber-100 to-orange-100 text-amber-800/40"
                                >
                                    <svg class="h-16 w-16" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="flex flex-1 flex-col p-5">
                            <h2 class="text-lg font-semibold text-stone-900 line-clamp-2">
                                <a
                                    href="{{ route('events.show', $event->slug) }}"
                                    class="transition hover:text-amber-700"
                                >
                                    {{ $event->title }}
                                </a>
                            </h2>
                            <p class="mt-2 text-sm text-amber-800/90">
                                {{ $event->start_date->format('d/m/Y H:i') }}
                            </p>
                            <p class="mt-1 text-sm text-stone-600">
                                {{ $event->location }}
                            </p>
                            <p class="mt-2 text-sm font-medium text-amber-700">
                                @if ($event->isFree())
                                    Gratuito
                                @else
                                    € {{ number_format((float) $event->price, 2, ',', '.') }}
                                @endif
                            </p>
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-stone-600 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($event->short_description ?? '', 100) }}
                            </p>
                            <a
                                href="{{ route('events.show', $event->slug) }}"
                                class="mt-4 inline-flex items-center text-sm font-semibold text-amber-700 transition hover:text-amber-900"
                            >
                                Scopri di più
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
