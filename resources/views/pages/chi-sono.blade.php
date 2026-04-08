<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('home.chi_sono') }} - Ditta Bacamacchi</title>
        @vite(['resources/css/app.css'])
    </head>
    <body class="min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/pages-bg.jpeg') }}'); background-size: 100% auto; background-repeat: repeat-y;">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-amber-800">{{ __('home.chi_sono') }}</h1>
            <a href="{{ route('home') }}" class="mt-4 inline-block text-amber-600 hover:underline">← Torna alla home</a>
        </div>
    </body>
</html>
