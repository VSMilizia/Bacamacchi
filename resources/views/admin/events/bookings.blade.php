<x-app-layout>
    <x-slot name="header">
        <div class="space-y-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Prenotazioni per: {{ $event->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div>
                <a href="{{ route('admin.events.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                    ← Torna agli eventi
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($bookings->isEmpty())
                    <div class="p-12 text-center">
                        <p class="text-gray-500 text-sm">Non ci sono ancora prenotazioni per questo evento.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantità</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totale</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stato</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data prenotazione</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="font-medium">{{ $booking->user->name ?? '—' }}</div>
                                            <div class="text-gray-500 text-xs">{{ $booking->user->email ?? '' }}</div>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
