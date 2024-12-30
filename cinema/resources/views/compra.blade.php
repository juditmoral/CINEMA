<div>
    <h2>{{ __('Seients seleccionats') }}</h2>
    <ul>
        @foreach ($selectedSeats as $seat)
            <li>{{ __('Fila') }}: {{ $seat['fila'] }}, {{ __('Número') }}: {{ $seat['numero'] }}</li>
        @endforeach
    </ul>
    
    <h3>{{ __('Dia de la funció') }}: {{ $dia }}</h3>
    <h3>{{ __('Hora de la funció') }}: {{ $hora }}</h3>
    <h3>{{ __('Número de sala') }}: {{ $sala }}</h3>
    <h3>{{ __('ID de la funció') }}: {{ $funcio_id }}</h3>
    <h3>{{ __('ID de la pel·lícula') }}: {{ $pelicula_id }}</h3>
</div>



