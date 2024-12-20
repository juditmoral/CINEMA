@php
 $locale=App::currentLocale();   
@endphp
<x-guest-layout>
    <!-- Navegació -->
    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Cabecera con fondo degradado -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
         style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset($pelicula->url) }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{ $pelicula->{'titul_' . $locale} }}
        </h2>
    </div>

    <div class="mt-8 pl-3">

        <!-- Título de la película -->
        <h2 class="text-white font-bold text-4xl mb-2">
            {{ $pelicula->{'titul_' . $locale} }}
        </h2>

        <!-- Género de la película -->
        <p class="text-gray-400 text-lg mb-2">
            <strong>{{__("Gènere")}}:</strong> {{ $pelicula->{'genere_' . $locale} }}
        </p>

        <!-- Duración de la película -->
        <p class="text-gray-400 text-lg mb-6">
            <strong>{{__("Duració")}}:</strong> {{ $pelicula->duracio }} min
        </p>

        <!-- Sección con la imagen y la fecha -->
        <div class="flex">

            <!-- Imagen de la cartelera -->
            <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->titul_en }}"
                class="w-1/3 h-auto object-cover rounded-lg mr-8">

            <!-- Información de la fecha -->
            <div class="flex flex-col text-left">
                @php
                    // Buscar la función de la película
                    $funcio = \App\Models\Funcions::where('pelicula_id', $pelicula->id)->first();

                    // Si existe la función, parsear la fecha
                    if ($funcio) {
                        $fecha = \Carbon\Carbon::parse($funcio->data);
                    } else {
                        $fecha = null;
                    }
                @endphp

                @if ($fecha)
                    <!-- Día de la semana -->
                    <h3 class="text-white font-bold text-xl mb-2">
                        {{ $fecha->locale('es')->dayName }}
                    </h3>

                    <!-- Número del día -->
                    <h2 class="text-white font-extrabold text-4xl mb-2">
                        {{ $fecha->day }}
                    </h2>

                    <!-- Mes -->
                    <h3 class="text-white font-bold text-xl">
                        {{ $fecha->locale('es')->translatedFormat('F') }}
                    </h3>
                @else
                    <p class="text-gray-400">No hay funciones programadas para esta película.</p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>


