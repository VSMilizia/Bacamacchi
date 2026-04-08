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
            .scene-label {
                font-family: 'Quicksand', sans-serif;
                text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-repeat: repeat;">

        <div class="scene">
            @foreach (config('home.items') as $item)
                <a href="{{ route($item['route']) }}">
                    <img src="{{ asset($item['image']) }}" alt="{{ __('home.' . $item['key']) }}">
                    @if ($item['type'] === 'book')
                        <span class="book-label scene-label absolute inset-0 flex items-center justify-center text-white text-sm font-bold uppercase tracking-wider pointer-events-none">
                            {{ __('home.' . $item['key']) }}
                        </span>
                    @else
                        <span class="scene-label absolute inset-0 flex items-center justify-center text-white text-lg font-bold uppercase tracking-wide pointer-events-none">
                            {{ __('home.' . $item['key']) }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

    </body>
</html>
