<x-guest-layout>
    <!-- Navegació -->
    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Encabezado con fondo degradado -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
         style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset($pelicula->url) }}'); background-size: cover; background-repeat: no-repeat;">

        <h2 class="text-white font-bold text-6xl">
            {{ $pelicula->titul_en }}
        </h2>
    </div>

    <!-- Sección con imagen y título después de la cabecera -->
    <div class="flex mt-8 mx-6">
        <!-- Imagen a la izquierda -->
        <div class="w-1/4">
            <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->titul_en }}"
                 class="w-full h-full object-cover rounded-lg">
        </div>

        <!-- Título en la parte superior derecha -->
        <div class="w-1/2 flex flex-col items-end justify-startp-4">
            <!-- Título -->
            <h2 class="text-white font-bold text-3xl mb-2">
                {{ $pelicula->titul_en }}
            </h2>

            <!-- Género y duración centrados -->
            <div class="mt-2 text-gray-300 text-xl">
                <p><strong>Genre:</strong> {{ $pelicula->genere_en }} </p>
                <p><strong>Duration:</strong> {{ $pelicula->duracio }} min</p>
            </div>
        </div>

</x-guest-layout>
