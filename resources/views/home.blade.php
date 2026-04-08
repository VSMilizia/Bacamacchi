<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ditta Bacamacchi</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=quicksand:600,700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
        <style>
            .book-label {
                writing-mode: vertical-rl;
                text-orientation: mixed;
                transform: rotate(180deg);
            }
            .scene {
                text-align: center;
                font-size: 0;
            }
            .scene a {
                position: relative;
                display: inline-block;
                vertical-align: bottom;
                transition: transform 0.3s;
                transform-origin: bottom center;
            }
            .scene a:hover {
                transform: scale(1.1);
                z-index: 10;
            }
            .scene a img {
                display: block;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-repeat: repeat;">

        <div class="scene">
            {{-- Book 1 - Teatro --}}
            <a href="{{ route('teatro') }}">
                <img src="{{ asset('images/home/book-1.png') }}" alt="{{ __('home.teatro') }}">
                <span class="book-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.teatro') }}
                </span>
            </a>

            {{-- Book 2 - Cunta cuentos --}}
            <a href="{{ route('cunta-cuentos') }}">
                <img src="{{ asset('images/home/book-2.png') }}" alt="{{ __('home.cunta_cuentos') }}">
                <span class="book-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.cunta_cuentos') }}
                </span>
            </a>

            {{-- Book 3 - Attività in italiano --}}
            <a href="{{ route('attivita') }}">
                <img src="{{ asset('images/home/book-3.png') }}" alt="{{ __('home.attivita') }}">
                <span class="book-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.attivita') }}
                </span>
            </a>

            {{-- House - Chi sono --}}
            <a href="{{ route('chi-sono') }}" style="transform-origin: bottom center;">
                <img src="{{ asset('images/home/house.png') }}" alt="{{ __('home.chi_sono') }}">
                <span class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold uppercase tracking-wide pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.chi_sono') }}
                </span>
            </a>

            {{-- Book 4 - Calendario --}}
            <a href="{{ route('calendario') }}">
                <img src="{{ asset('images/home/book-4.png') }}" alt="{{ __('home.calendario') }}">
                <span class="book-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.calendario') }}
                </span>
            </a>

            {{-- Book 5 - Contatti --}}
            <a href="{{ route('contatti') }}">
                <img src="{{ asset('images/home/book-5.png') }}" alt="{{ __('home.contatti') }}">
                <span class="book-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none" style="font-family: 'Quicksand', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                    {{ __('home.contatti') }}
                </span>
            </a>
        </div>

    </body>
</html>
