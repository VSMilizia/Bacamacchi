<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagamento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 shadow-md">
                <div class="border-b border-amber-200/80 bg-white/60 px-6 py-4">
                    <h3 class="text-lg font-semibold text-amber-950">Dettagli prenotazione</h3>
                    <p class="mt-1 text-sm text-amber-900/70">Controlla i dati prima di completare il pagamento.</p>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <dl class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium uppercase tracking-wide text-amber-800/80">Evento</dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900">
                                {{ $booking->event?->title ?? '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-amber-800/80">Data evento</dt>
                            <dd class="mt-1 text-gray-800">
                                @if ($booking->event?->start_date)
                                    {{ $booking->event->start_date->translatedFormat('l j F Y, H:i') }}
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-amber-800/80">Quantità</dt>
                            <dd class="mt-1 text-gray-800">{{ $booking->quantity }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium uppercase tracking-wide text-amber-800/80">Totale</dt>
                            <dd class="mt-1 text-2xl font-bold tabular-nums text-amber-950">
                                {{ number_format((float) $booking->total_price, 2, ',', '.') }} €
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div
                class="mt-8 overflow-hidden rounded-2xl border border-dashed border-amber-300 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-800 mb-4">Metodo di pagamento</p>
                <div class="rounded-xl bg-amber-50/80 border border-amber-100 px-4 py-8 text-center">
                    <p class="text-amber-900/80 text-sm">
                        Integrazione pagamento in arrivo
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('bookings.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                    Torna alle prenotazioni
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
