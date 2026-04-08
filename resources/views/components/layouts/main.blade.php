<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Ditta Bacamacchi' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=quicksand:600,700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
    </head>
    <body {{ $attributes->merge(['class' => 'min-h-screen']) }}>
        {{ $slot }}
    </body>
</html>
