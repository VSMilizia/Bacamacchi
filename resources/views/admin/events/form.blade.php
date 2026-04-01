@php
    $isEditing = $event->exists;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $isEditing ? 'Modifica Evento' : 'Nuovo Evento' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900">
                    <form method="POST"
                        action="{{ $isEditing ? route('admin.events.update', $event) : route('admin.events.store') }}"
                        enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @if ($isEditing)
                            @method('PUT')
                        @endif

                        <div>
                            <x-input-label for="title" value="Titolo" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', $event->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="short_description" value="Descrizione breve" />
                            <textarea id="short_description" name="short_description" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('short_description', $event->short_description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('short_description')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Descrizione" />
                            <textarea id="description" name="description" rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $event->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Immagine" />
                            @if ($isEditing && $event->image)
                                <div class="mt-2 mb-2">
                                    <p class="text-sm text-gray-600 mb-2">Immagine attuale:</p>
                                    <img src="{{ \Illuminate\Support\Str::startsWith($event->image, ['http://', 'https://']) ? $event->image : asset('storage/' . $event->image) }}"
                                        alt="" class="max-h-48 rounded-md border border-gray-200">
                                </div>
                            @endif
                            <input id="image" name="image" type="file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="start_date" value="Data e ora inizio" />
                                <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full"
                                    :value="old('start_date', $event->start_date ? $event->start_date->format('Y-m-d\TH:i') : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>
                            <div>
                                <x-input-label for="end_date" value="Data e ora fine" />
                                <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full"
                                    :value="old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="location" value="Luogo" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                :value="old('location', $event->location)" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="address" value="Indirizzo" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $event->address)" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="price" value="Prezzo (€)" />
                                <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full"
                                    :value="old('price', $event->price)" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <x-input-label for="max_participants" value="Partecipanti massimi (opzionale)" />
                                <x-text-input id="max_participants" name="max_participants" type="number" min="1" class="mt-1 block w-full"
                                    :value="old('max_participants', $event->max_participants)" />
                                <x-input-error class="mt-2" :messages="$errors->get('max_participants')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_published" value="0">
                            <input id="is_published" name="is_published" type="checkbox" value="1"
                                class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500"
                                @checked((int) old('is_published', $event->is_published ? 1 : 0) === 1)>
                            <x-input-label for="is_published" value="Pubblicato" class="!mb-0" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_published')" />

                        <div class="flex items-center gap-4 pt-2">
                            <x-primary-button class="!bg-amber-600 hover:!bg-amber-700 focus:!ring-amber-500 active:!bg-amber-800">
                                {{ $isEditing ? 'Aggiorna Evento' : 'Crea Evento' }}
                            </x-primary-button>
                            <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Annulla
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
