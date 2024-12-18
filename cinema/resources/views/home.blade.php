@php
 $locale=App::currentLocale();   
@endphp
<x-guest-layout>
    <!-- Navegació -->
    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Encapçalament amb fons degradat -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
         style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset('https://st5.depositphotos.com/90090170/75052/i/450/depositphotos_750529710-stock-photo-bstract-red-black-background-texture.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            STELLA
        </h2>
    </div>

    <!-- Text centrat abans de les cartes -->
    <div class="w-full flex justify-center mt-8">
        <h1 class="text-4xl font-bold text-white">{{ __('Now Showing') }}</h1>
    </div>

    <!-- Contenidor de cartes centrades sota l'encapçalament -->
    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 justify-center my-8">
        @foreach($peliculas as $pelicula)
            <!-- Carta per a cada pel·lícula -->
            <a href="{{ route('infofilms', ['id' => $pelicula->id]) }}" class="relative overflow-hidden rounded-lg shadow-lg h-[350px] w-[250px] group transition-all">
                <!-- Imatge principal -->
                <img src="{{ $pelicula->url }}" alt="Poster {{ $pelicula->{'titul_'.$locale} }}"
                     class="w-full h-full object-cover transition-all duration-300">
                <!-- Capa de text que apareix al fer hover -->
                <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h3 class="text-white text-xl font-bold text-center px-2">{{ $pelicula->{'titul_'.$locale} }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</x-guest-layout>
