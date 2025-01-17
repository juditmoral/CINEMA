@php
    $locale = App::currentLocale();


  

@endphp


@can('administrar')   

<x-app-layout>

    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Encapçalament amb fons degradat -->
    <div class="w-full min-h-[350px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
        style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset('https://img.freepik.com/vector-gratis/fondo-escenario-cine-palomitas-maiz-sillas-claqueta_1017-38722.jpg?semt=ais_hybrid') }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{__('Afegir funcions')}}
        </h2>
    </div>

    <div class="container mx-auto my-14">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('funcio.store') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idPelicula" value="{{ $pelicula->id }}">

                <div class="mb-6">
                    <label for="data" class="block text-sm font-semibold text-white">{{ __('Data') }}</label>
                    <input type="text" name="data" id="data" value="{{ old('data') }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>
                <!-- Títol -->
                <div class="mb-6">
                    <label for="hora" class="block text-sm font-semibold text-white">{{ __('Hora') }}</label>
                    <input type="text" name="hora" id="hora" value="{{ old('hora') }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="numSala" class="block text-sm font-semibold text-white">{{ __('Número de sala') }}</label>
                    <select name="numSala" id="numSala" class="mt-2 w-full p-2 border rounded-md" required>
                        <option value="" disabled selected>{{ __('Selecciona una sala') }}</option>
                        <option value="1">{{ __('Sala 1') }}</option>
                        <option value="2">{{ __('Sala 2') }}</option>
                        <option value="3">{{ __('Sala 3') }}</option>
                        <option value="4">{{ __('Sala 4') }}</option>
                        <option value="5">{{ __('Sala 5') }}</option>
                        <option value="6">{{ __('Sala 6') }}</option>
                    </select>
                </div>
                
                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">
                        {{ __('Afegir funció') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>


@else

<p>{{__('Nomes per administradors')}}</p>

@endcan