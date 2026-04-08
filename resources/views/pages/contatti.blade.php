<x-layouts.main :title="__('home.contatti') . ' - Ditta Bacamacchi'" class="flex items-center justify-center" style="background-image: url('{{ asset('images/pages-bg.jpeg') }}'); background-size: 100% auto; background-repeat: repeat-y;">

    <div class="text-center">
        <h1 class="text-3xl font-bold text-amber-800">{{ __('home.contatti') }}</h1>
        <a href="{{ route('home') }}" class="mt-4 inline-block text-amber-600 hover:underline">← Torna alla home</a>
    </div>

</x-layouts.main>
