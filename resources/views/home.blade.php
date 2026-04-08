<x-layouts.main class="flex items-center justify-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-repeat: repeat;">

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

</x-layouts.main>
