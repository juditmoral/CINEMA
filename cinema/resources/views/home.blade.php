@php
    $locale = App::currentLocale();
@endphp
<x-guest-layout>
    
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


    <div class="w-full flex justify-end mt-4 mr-16">
        @can('administrar')
            <button onclick="window.location.href='{{ route('crearPelicula') }}'"
                class="mr-4 px-3 py-2 bg-transparent text-white rounded-md font-bold text-4xl hover:bg-red-500">
                +
            </button>
        @endcan
    </div>
    
    


    <!-- Text centrat abans de les cartes -->
    <div class="w-full flex flex-col justify-center mt-8">
        <div class="flex justify-center items-center">

            <h1 class="text-4xl font-bold text-white text-center">{{ __('Cartellera') }}</h1>


        </div>
        <!-- Text de benvinguda -->
        <p class="text-lg text-white text-center mt-4">
            {{ __('Benvinguts al cinema Stella! Gaudiu de les millors pel·lícules.') }}
        </p>
    </div>


    <!-- Botons de categories -->
    <div class="w-full flex justify-center bg-transparent py-4">
        <div class="flex flex-wrap justify-center gap-4">
            @php
                $categories = [
                    __('Totes'),
                    __('Acció'),
                    __('Animació'),
                    __('Aventura'),
                    __('Bèlic'),
                    __('Ciencia Ficció'),
                    __('Biogràfic'),
                    __('Comèdia'),
                    __('Documental'),
                    __('Drama'),
                    __('Thriller'),
                    __('Terror'),
                ];
            @endphp

            @foreach ($categories as $categoria)
                <button onclick="filterCategory('{{ $categoria }}')"
                    class="px-4 py-2 text-sm text-white border border-white rounded-md bg-transparent transition-all 
                hover:text-red-500 hover:border-red-500 hover:ring-2 hover:ring-red-500">
                    {{ __($categoria) }}
                </button>
            @endforeach
        </div>
    </div>


    <div id="peliculasContainer"
        class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 justify-center my-8 ">
        @foreach ($peliculas as $pelicula)
            <div class="pelicula-card relative overflow-hidden rounded-lg shadow-lg h-[350px] w-[250px] group transition-all"
                data-categoria="{{ $pelicula->{'genere_' . $locale} }}">
                <a href="{{ route('infofilms', ['id' => $pelicula->id]) }}" class="block w-full h-full overflow-hidden">
                    <!-- Imatge principal -->
                    <img src="{{ $pelicula->url }}" alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                        class="w-full h-full object-cover transition-all duration-300">

                    <!-- Capa amb text que apareix al fer hover -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-white text-xl font-bold text-center px-2">{{ $pelicula->{'titul_' . $locale} }}
                        </h3>
                    </div>
                </a>
            </div>
        @endforeach
    </div>



</x-guest-layout>



<script>
    function filterCategory(category) {
        const peliculas = document.getElementsByClassName('pelicula-card');

        if (category === '{{ __('Totes') }}') {
            // Mostra totes les pel·lícules
            for (let card of peliculas) {
                card.style.display = 'block';
            }
        } else {
            // Mostra només les pel·lícules de la categoria seleccionada
            for (let card of peliculas) {
                if (card.dataset.categoria === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        }
    }
</script>
