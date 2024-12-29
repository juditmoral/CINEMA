<!-- Mostrar los datos recibidos -->
<div class="container">
    <h1 class="text-center text-xl font-semibold mb-4">Detalles de la Función</h1>

    <div class="mb-4">
        <strong>ID de la Película:</strong> {{ $peliculaId }}
    </div>

    <div class="mb-4">
        <strong>Hora:</strong> {{ $hora }}
    </div>

    <div class="mb-4">
        <strong>Día:</strong> {{ $dia }}
    </div>

    <div class="mb-4">
        <strong>ID funcio :</strong> {{ $funcioId }}
    </div>
</div>


@php
    $locale = App::currentLocale();
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
            <strong>{{ __('Gènere') }}:</strong> {{ $pelicula->{'genere_' . $locale} }}
        </p>

        <!-- Duración de la película -->
        <p class="text-gray-400 text-lg mb-6">
            <strong>{{ __('Duració') }}:</strong> {{ $pelicula->duracio }} min
        </p>

        <!-- Sección con la imagen y los asientos -->
        <div class="flex items-start justify-center w-full mt-8">
            <!-- Imagen de la cartelera -->
            <div class="mr-8">
                <img src="{{ asset($pelicula->url) }}" 
                     alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                     class="w-64 h-auto object-cover rounded-lg">
            </div>
        
            <!-- Pasos numerados -->
            <div class="flex items-start gap-6">
                <!-- Paso 1 -->
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-500 text-white font-bold flex justify-center items-center rounded-full">1</div>
                    <span class="ml-2 text-white font-medium">Escull el teu lloc</span>
                </div>
        
                <!-- Separador -->
                <div class="w-12 border-t border-gray-500 mt-4"></div>
        
                <!-- Paso 2 -->
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">2</div>
                    <span class="ml-2 text-gray-500 font-medium">Pagament</span>
                </div>
        
                <!-- Separador -->
                <div class="w-12 border-t border-gray-500 mt-4"></div>
        
                <!-- Paso 3 -->
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">3</div>
                    <span class="ml-2 text-gray-500 font-medium">Tíquets</span>
                </div>
            </div>
        </div>
        

    </div>





    <!-- Contenedor para los asientos seleccionados centrado justo debajo de la imagen del cartel y el boton continuar -->
    <div class="flex justify-left mt-6">




    </div>




    <!-- Sección Detalles y Sinopsis con la línea -->





    </div>




</x-guest-layout>
