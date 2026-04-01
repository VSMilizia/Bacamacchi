@php
    $spots = $event->availableSpots();
@endphp

<x-layouts.public :title="$event->title">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <nav class="mb-8 text-sm text-stone-500" aria-label="Percorso di navigazione">
            <ol class="flex flex-wrap items-center gap-2">
                <li>
                    <a href="{{ url('/') }}" class="transition hover:text-amber-700">Home</a>
                </li>
                <li aria-hidden="true">/</li>
                <li>
                    <a href="{{ route('events.index') }}" class="transition hover:text-amber-700">Eventi</a>
                </li>
                <li aria-hidden="true">/</li>
                <li class="line-clamp-1 font-medium text-stone-800" aria-current="page">
                    {{ $event->title }}
                </li>
            </ol>
        </nav>

        <div class="overflow-hidden rounded-2xl border border-stone-100 bg-white shadow-lg shadow-amber-900/5">
            <div class="aspect-[21/9] w-full overflow-hidden bg-gradient-to-br from-amber-200 via-amber-100 to-orange-50 sm:aspect-[2/1]">
                @if ($event->image)
                    <img
                        src="{{ asset('storage/' . $event->image) }}"
                        alt=""
                        class="h-full w-full object-cover"
                    />
                @else
                    <div class="flex h-full w-full items-center justify-center text-amber-800/30">
                        <svg class="h-24 w-24 sm:h-32 sm:w-32" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                @endif
            </div>

            <div class="p-6 sm:p-10">
                <h1 class="text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">
                    {{ $event->title }}
                </h1>

                <div class="mt-6 space-y-4 text-stone-700">
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-900 ring-1 ring-amber-100"
                        >
                            @if ($spots === null)
                                Posti illimitati
                            @elseif ($spots === 0)
                                Esaurito
                            @else
                                {{ $spots }} posti disponibili
                            @endif
                        </span>
                    </div>

                    <p>
                        <span class="font-semibold text-stone-900">Data e ora:</span>
                        {{ $event->start_date->format('d/m/Y H:i') }}
                        @if ($event->end_date)
                            — {{ $event->end_date->format('d/m/Y H:i') }}
                        @endif
                    </p>
                    <p>
                        <span class="font-semibold text-stone-900">Luogo:</span>
                        {{ $event->location }}
                    </p>
                    @if ($event->address)
                        <p>
                            <span class="font-semibold text-stone-900">Indirizzo:</span>
                            {{ $event->address }}
                        </p>
                    @endif
                    <p>
                        <span class="font-semibold text-stone-900">Prezzo:</span>
                        @if ($event->isFree())
                            Gratuito
                        @else
                            € {{ number_format((float) $event->price, 2, ',', '.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-8 max-w-none leading-relaxed text-stone-700">
                    {!! nl2br(e($event->description)) !!}
                </div>

                <div class="mt-10 border-t border-amber-100 pt-8">
                    @if (! $event->start_date->isFuture())
                        <p class="text-stone-600">Questo evento non è più prenotabile.</p>
                    @elseif ($spots === 0)
                        <p class="text-stone-600">Non ci sono posti disponibili.</p>
                    @elseif (! auth()->check())
                        <p class="text-stone-600">
                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-amber-700 underline decoration-amber-300 underline-offset-2 hover:text-amber-900"
                            >
                                Accedi per prenotare
                            </a>
                        </p>
                    @else
                        <h2 class="text-lg font-semibold text-stone-900">Prenotazione</h2>
                        <form
                            id="booking-form"
                            action="{{ route('bookings.store', $event) }}"
                            method="post"
                            class="mt-4 max-w-md space-y-4"
                        >
                            @csrf
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-stone-700">
                                    Quantità
                                </label>
                                <input
                                    id="quantity"
                                    name="quantity"
                                    type="number"
                                    min="1"
                                    @if ($spots !== null)
                                        max="{{ $spots }}"
                                    @endif
                                    value="1"
                                    required
                                    class="mt-1 block w-full rounded-lg border border-stone-200 px-3 py-2 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                                />
                            </div>
                            <p class="text-sm text-stone-600">
                                Totale:
                                <span id="booking-total" class="font-semibold text-amber-800">
                                    @if ($event->isFree())
                                        Gratuito
                                    @else
                                        € {{ number_format((float) $event->price, 2, ',', '.') }}
                                    @endif
                                </span>
                            </p>
                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-lg bg-amber-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Prenota Ora
                            </button>
                        </form>
                        @unless ($event->isFree())
                            @push('scripts')
                                <script>
                                    (function () {
                                        var form = document.getElementById('booking-form');
                                        if (!form) return;
                                        var qty = document.getElementById('quantity');
                                        var totalEl = document.getElementById('booking-total');
                                        var unit = {{ json_encode((float) $event->price) }};
                                        function fmt(n) {
                                            return n.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                        }
                                        function update() {
                                            var q = parseInt(qty.value, 10) || 0;
                                            totalEl.textContent = '€ ' + fmt(unit * q);
                                        }
                                        qty.addEventListener('input', update);
                                        qty.addEventListener('change', update);
                                    })();
                                </script>
                            @endpush
                        @endunless
                    @endif
                </div>
            </div>
        </div>

        <p class="mt-8">
            <a
                href="{{ route('events.index') }}"
                class="inline-flex items-center text-sm font-medium text-amber-700 transition hover:text-amber-900"
            >
                <svg class="mr-1 h-4 w-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                Torna agli eventi
            </a>
        </p>
    </div>
</x-layouts.public>
