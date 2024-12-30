<div>
    <h2>{{ __('Seients seleccionats') }}</h2>
    <ul>
        @foreach ($selectedSeats as $seat)
            <li>{{ __('Fila') }}: {{ $seat['fila'] }}, {{ __('Número') }}: {{ $seat['numero'] }}</li>
        @endforeach
    </ul>
</div>
