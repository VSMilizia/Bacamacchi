<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conferma Prenotazione
        </h2>
    </x-slot>

    @php
        $status = strtolower((string) $booking->status);
    @endphp

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-emerald-200 bg-white p-8 shadow-sm sm:p-10">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 ring-4 ring-emerald-50">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-xl font-semibold text-gray-900">Prenotazione registrata</h3>
                    <p class="mt-2 text-sm text-gray-600 max-w-md">
                        La tua prenotazione è stata confermata. Trovi il riepilogo qui sotto; puoi tornare agli eventi o
                        consultare tutte le prenotazioni dal tuo profilo.
                    </p>
                </div>

                <div
                    class="mt-8 rounded-xl border border-amber-100 bg-gradient-to-br from-amber-50/90 to-orange-50/50 p-6">
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-amber-900/80 mb-4">Riepilogo</h4>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="text-gray-600">Evento</dt>
                            <dd class="font-medium text-gray-900 text-right">{{ $booking->event?->title ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-gray-600">Data</dt>
                            <dd class="text-gray-900 text-right">
                                @if ($booking->event?->start_date)
                                    {{ $booking->event->start_date->translatedFormat('l j F Y, H:i') }}
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-gray-600">Quantità</dt>
                            <dd class="text-gray-900 text-right">{{ $booking->quantity }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-gray-600">Totale</dt>
                            <dd class="font-semibold tabular-nums text-amber-950 text-right">
                                {{ number_format((float) $booking->total_price, 2, ',', '.') }} €
                            </dd>
                        </div>
                        <div class="flex justify-between gap-4 items-center pt-2 border-t border-amber-200/60">
                            <dt class="text-gray-600">Stato</dt>
                            <dd>
                                @if ($status === 'confirmed')
                                    <span
                                        class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800 ring-1 ring-inset ring-emerald-600/20">
                                        Confermata
                                    </span>
                                @elseif ($status === 'pending')
                                    <span
                                        class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-900 ring-1 ring-inset ring-yellow-600/25">
                                        In attesa
                                    </span>
                                @elseif ($status === 'cancelled')
                                    <span
                                        class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 ring-1 ring-inset ring-red-600/20">
                                        Annullata
                                    </span>
                                @else
                                    <span class="text-gray-800">{{ $booking->status }}</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('bookings.index') }}"
                        class="inline-flex justify-center items-center rounded-lg bg-amber-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Le mie Prenotazioni
                    </a>
                    <a href="{{ route('events.index') }}"
                        class="inline-flex justify-center items-center rounded-lg border border-amber-300 bg-white px-5 py-2.5 text-sm font-medium text-amber-900 shadow-sm hover:bg-amber-50">
                        Torna agli Eventi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
