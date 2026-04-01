<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Le Mie Prenotazioni
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($bookings->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-amber-100">
                    <div class="p-10 text-center">
                        <p class="text-gray-600 text-lg mb-6">Non hai ancora prenotazioni.</p>
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center rounded-lg bg-amber-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                            Scopri gli eventi
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-amber-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-amber-50/80">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Evento</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Data Evento</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Quantità</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Totale</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Stato</th>
                                    <th scope="col" class="px-4 py-3 text-right font-semibold text-gray-700">Azioni</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach ($bookings as $booking)
                                    @php
                                        $status = strtolower((string) $booking->status);
                                    @endphp
                                    <tr class="hover:bg-amber-50/40 transition-colors">
                                        <td class="px-4 py-4">
                                            @if ($booking->event)
                                                <a href="{{ route('events.show', $booking->event) }}"
                                                    class="font-medium text-amber-800 hover:text-amber-950 underline decoration-amber-300 underline-offset-2">
                                                    {{ $booking->event->title }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                            @if ($booking->event?->start_date)
                                                {{ $booking->event->start_date->translatedFormat('l j F Y, H:i') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-gray-700">{{ $booking->quantity }}</td>
                                        <td class="px-4 py-4 text-gray-900 font-medium tabular-nums">
                                            {{ number_format((float) $booking->total_price, 2, ',', '.') }} €
                                        </td>
                                        <td class="px-4 py-4">
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
                                                <span
                                                    class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-500/20">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-right space-y-1">
                                            @if ($status === 'pending')
                                                <a href="{{ route('bookings.payment', $booking) }}"
                                                    class="block text-amber-700 hover:text-amber-900 font-medium text-sm">
                                                    Procedi al Pagamento
                                                </a>
                                            @endif
                                            @if ($status === 'confirmed')
                                                <a href="{{ route('bookings.confirmation', $booking) }}"
                                                    class="block text-amber-700 hover:text-amber-900 font-medium text-sm">
                                                    Vedi Conferma
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
