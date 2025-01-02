<x-app-layout>

    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Cabecera con fondo degradado -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
         style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset('https://eldinero.com.do/wp-content/uploads/Cine.jpeg') }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{__('Tiquets')}}
        </h2>
    </div>

    <div class="mt-8 pl-3">

        @foreach ($entrades as $entrada)
        <h2 class="text-white font-bold text-4xl mb-2">
            {{ $entrada->id }}
        </h2>
        @endforeach
    </div>


</x-app-layout>