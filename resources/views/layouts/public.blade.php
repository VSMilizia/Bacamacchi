<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Ditta Bacamacchi') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white text-gray-700">
        <div class="min-h-screen flex flex-col">
            <nav
                x-data="{ open: false }"
                class="sticky top-0 z-50 border-b border-amber-100 bg-white/95 shadow-sm backdrop-blur supports-[backdrop-filter]:bg-white/80"
            >
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex shrink-0 items-center gap-8">
                            <a
                                href="{{ route('home') }}"
                                class="text-lg font-semibold tracking-tight text-amber-700 transition hover:text-amber-600"
                            >
                                Ditta Bacamacchi
                            </a>
                            <div class="hidden items-center gap-1 md:flex">
                                <a
                                    href="{{ route('home') }}"
                                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-800' : 'text-gray-600 hover:bg-amber-50 hover:text-amber-700' }}"
                                >
                                    Home
                                </a>
                                <a
                                    href="{{ route('events.index') }}"
                                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('events.*') ? 'bg-amber-50 text-amber-800' : 'text-gray-600 hover:bg-amber-50 hover:text-amber-700' }}"
                                >
                                    Eventi
                                </a>
                                <a
                                    href="{{ route('calendar') }}"
                                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('calendar') ? 'bg-amber-50 text-amber-800' : 'text-gray-600 hover:bg-amber-50 hover:text-amber-700' }}"
                                >
                                    Calendario
                                </a>
                            </div>
                        </div>

                        <div class="hidden items-center gap-3 md:flex">
                            @guest
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:text-amber-700"
                                >
                                    Accedi
                                </a>
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-700"
                                >
                                    Registrati
                                </a>
                            @else
                                <x-dropdown align="right" width="56">
                                    <x-slot name="trigger">
                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-1 rounded-lg border border-amber-100 bg-amber-50/80 px-3 py-2 text-sm font-medium text-amber-900 transition hover:bg-amber-100 focus:outline-none"
                                        >
                                            <span>{{ Auth::user()->name }}</span>
                                            <svg class="h-4 w-4 text-amber-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('bookings.index')">
                                            Le mie prenotazioni
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            Profilo
                                        </x-dropdown-link>
                                        @if (Auth::user()->isAdmin())
                                            <x-dropdown-link :href="route('admin.dashboard')">
                                                Amministrazione
                                            </x-dropdown-link>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link
                                                :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                            >
                                                Esci
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endguest
                        </div>

                        <div class="-me-2 flex items-center md:hidden">
                            <button
                                type="button"
                                @click="open = ! open"
                                class="inline-flex items-center justify-center rounded-md p-2 text-amber-800 hover:bg-amber-50 focus:bg-amber-50 focus:outline-none"
                                aria-expanded="false"
                                aria-label="Apri menu"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-amber-100 md:hidden">
                    <div class="space-y-1 px-2 pb-3 pt-2">
                        <a
                            href="{{ route('home') }}"
                            class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-800' : 'text-gray-700 hover:bg-amber-50' }}"
                        >
                            Home
                        </a>
                        <a
                            href="{{ route('events.index') }}"
                            class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('events.*') ? 'bg-amber-50 text-amber-800' : 'text-gray-700 hover:bg-amber-50' }}"
                        >
                            Eventi
                        </a>
                        <a
                            href="{{ route('calendar') }}"
                            class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('calendar') ? 'bg-amber-50 text-amber-800' : 'text-gray-700 hover:bg-amber-50' }}"
                        >
                            Calendario
                        </a>
                    </div>
                    @guest
                        <div class="border-t border-amber-100 px-2 pb-3 pt-2 space-y-1">
                            <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-amber-50">
                                Accedi
                            </a>
                            <a href="{{ route('register') }}" class="block rounded-lg bg-amber-600 px-3 py-2 text-center text-base font-semibold text-white hover:bg-amber-700">
                                Registrati
                            </a>
                        </div>
                    @else
                        <div class="border-t border-amber-100 px-2 pb-3 pt-2 space-y-1">
                            <div class="px-3 py-2">
                                <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <a href="{{ route('bookings.index') }}" class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-amber-50">
                                Le mie prenotazioni
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-amber-50">
                                Profilo
                            </a>
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-amber-50">
                                    Amministrazione
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full rounded-lg px-3 py-2 text-start text-base font-medium text-gray-700 hover:bg-amber-50">
                                    Esci
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </nav>

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="border-t border-amber-100 bg-amber-50/50 py-8">
                <div class="mx-auto max-w-7xl px-4 text-center text-sm text-gray-600 sm:px-6 lg:px-8">
                    <p>&copy; {{ date('Y') }} Ditta Bacamacchi. Tutti i diritti riservati.</p>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
