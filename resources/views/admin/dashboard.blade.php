<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-600">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500">Eventi totali</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_events'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-600">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500">Eventi in programma</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['upcoming_events'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-600">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500">Prenotazioni totali</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_bookings'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-600">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500">Ricavo totale</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">€ {{ number_format($stats['total_revenue'] ?? 0, 2, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-600 md:col-span-2 lg:col-span-1">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500">Utenti</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.events.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Nuovo Evento
                </a>
                <a href="{{ route('admin.events.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-amber-600 rounded-md font-semibold text-xs text-amber-700 uppercase tracking-widest hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Gestisci Eventi
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Prenotazioni recenti</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utente</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantità</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totale</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stato</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($recentBookings ?? [] as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->user->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->event->title ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $booking->quantity ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        € {{ number_format($booking->total ?? 0, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $status = $booking->status ?? '';
                                            $badgeClass = match ($status) {
                                                'confirmed', 'confermata' => 'bg-green-100 text-green-800',
                                                'cancelled', 'canceled', 'annullata' => 'bg-red-100 text-red-800',
                                                'pending', 'in_attesa' => 'bg-amber-100 text-amber-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                            $statusLabel = match ($status) {
                                                'confirmed' => 'Confermata',
                                                'confermata' => 'Confermata',
                                                'cancelled', 'canceled' => 'Annullata',
                                                'annullata' => 'Annullata',
                                                'pending' => 'In attesa',
                                                'in_attesa' => 'In attesa',
                                                'completed' => 'Completata',
                                                default => $status ? ucfirst($status) : '—',
                                            };
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $booking->created_at?->format('d/m/Y H:i') ?? '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                        Nessuna prenotazione recente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
