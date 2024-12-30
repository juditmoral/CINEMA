@php
    $locale = App::currentLocale();
    $locale = app()->getLocale();
    \Carbon\Carbon::setLocale($locale);
    $month = \Carbon\Carbon::parse($dia)->translatedFormat('M'); // Obtener el mes traducido
    $month = ucfirst($month); // Asegurar que la primera letra esté en mayúscula
    $month = rtrim($month, '.');
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
        <div class="flex justify-between items-start w-full mt-8">
            <!-- Imagen de la cartelera -->
            <div class="mr-8">
                <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                    class="w-64 h-auto object-cover rounded-lg">

                <form action="{{ route('compra') }}" method="GET" id="seatsForm">
                    @csrf
                    <!-- Hidden fields per passar la informació dels seients seleccionats -->
                    <input type="hidden" name="seats" id="seatsInput">
                    <input type="hidden" name="dia" id="diaInput" value="{{ $dia }}">
                    <input type="hidden" name="hora" id="horaInput" value="{{ $hora }}">
                    <input type="hidden" name="sala" id="salaInput" value="{{ $sala }}">
                   
                    <input type="hidden" name="funcioId" id="funcioIdInput" value="{{ $funcio->id }}">  <!-- ID de la funció -->
                    <input type="hidden" name="peliculaId" id="peliculaIdInput" value="{{ $peliculaId }}">
                    


                    <button id="continuarButton"
                        class="mt-4 px-6 py-2 bg-white text-gray-500 font-medium text-lg rounded-lg border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        {{ __('Continuar') }}
                    </button>
                </form>


            </div>



            <!-- Sección de los asientos -->
            <div class="w-2/3">
                <!-- Pasos numerados -->
                <div class="flex items-start gap-6 mb-6">
                    <!-- Paso 1 -->
                    <div class="flex items-center ml-5">
                        <div
                            class="w-8 h-8 bg-gray-500 text-white font-bold flex justify-center items-center rounded-full">
                            1
                        </div>
                        <span class="ml-2 text-white font-medium">{{ __('Escull el teu lloc') }}</span>
                    </div>

                    <!-- Separador -->
                    <div class="w-12 border-t border-gray-500 mt-4"></div>

                    <!-- Paso 2 -->
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">
                            2
                        </div>
                        <span class="ml-2 text-gray-500 font-medium">{{ __('Pagament') }}</span>
                    </div>

                    <!-- Separador -->
                    <div class="w-12 border-t border-gray-500 mt-4"></div>

                    <!-- Paso 3 -->
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">
                            3
                        </div>
                        <span class="ml-2 text-gray-500 font-medium">{{ __('Tíquets') }}</span>
                    </div>
                </div>



                <div class="w-full flex justify-center mb-6">
                    <div
                        class="w-3/4 h-32 bg-gray-800 text-white flex justify-center items-center text-2xl font-bold rounded-lg">
                    </div>
                </div>

                <!-- Bloc dels seients -->
                <div class="grid grid-cols-12 gap-1 items-center ml-5">
                    @foreach ($seients as $seient)
                        @php
                            // Comprova si el seient està ocupat comparant l'ID
                            $ocupat = in_array($seient->id, $llocsOcupats);

                        @endphp
                        <div class="w-7 h-7 flex justify-center items-center border border-gray-500 rounded
                            @if ($ocupat) bg-gray-400 cursor-not-allowed @else bg-gray-700 text-white hover:bg-gray-500 @endif"
                            data-fila="{{ $seient->fila }}" data-numero="{{ $seient->numero }}">

                        </div>
                    @endforeach


                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const seats = document.querySelectorAll('.grid div'); // Selecciona tots els seients
                        let selectedSeats = []; // Array per guardar els seients seleccionats

                        // Afegir esdeveniment al click dels seients
                        seats.forEach(seat => {
                            seat.addEventListener('click', () => {
                                if (!seat.classList.contains('cursor-not-allowed')) { // Evitar seients ocupats
                                    seat.classList.toggle(
                                        'bg-red-500'); // Canviar el color del seient seleccionat
                                    seat.classList.toggle(
                                        'bg-gray-700'); // Tornar al color original si es deselecciona

                                    // Si el seient està seleccionat, afegir-lo a la llista
                                    const seatData = {
                                        fila: seat.getAttribute('data-fila'),
                                        numero: seat.getAttribute('data-numero')
                                    };

                                    if (seat.classList.contains('bg-red-500')) {
                                        selectedSeats.push(seatData); // Afegir a la llista
                                    } else {
                                        // Eliminar el seient deseleccionat
                                        selectedSeats = selectedSeats.filter(s => s.fila !== seatData.fila || s
                                            .numero !== seatData.numero);
                                    }
                                }
                            });
                        });

                        // Acció al pressionar el botó "Continuar"
                        document.getElementById('continuarButton').addEventListener('click', () => {
                            if (selectedSeats.length > 0) {
                                // Afegir la informació dels seients seleccionats al formulari com a camps ocults
                                const seatsInput = document.getElementById('seatsInput');
                                seatsInput.value = JSON.stringify(selectedSeats); // Convertir la llista a cadena JSON

                                // Submetre el formulari
                                document.getElementById('seatsForm').submit();
                            } else {
                                alert('Si us plau, selecciona alguns seients abans de continuar.');
                            }
                        });
                    });
                </script>





            </div>

            <div class="flex justify-right mt-6 ml-20">
                <!-- Mostramos el área con la hora y el día -->
                <div class="flex flex-col items-start space-y-2">
                    <!-- Día -->
                    <div class="text-gray-500 text-lg">
                        <strong>{{ __('Día') }}:</strong>
                    </div>



                    <div
                        class=" text-white font-bold text-5xl py-2 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ \Carbon\Carbon::parse($dia)->day }}
                    </div>
                    <div
                        class=" text-white font-medium text-sm py-1 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ $month }} <!-- Mes en abreviatura -->
                    </div>

                    <!-- Hora -->
                    <div class="text-gray-500 text-lg mt-4">
                        <strong>{{ __('Hora') }}:</strong>
                    </div>
                    <div class=" text-white font-bold text-3xl py-2 rounded-lg text-center">
                        {{ $hora }}
                    </div>
                </div>
            </div>
        </div>


    </div>





    <!-- Contenedor para los asientos seleccionados centrado justo debajo de la imagen del cartel y el boton continuar -->






    <!-- Sección Detalles y Sinopsis con la línea -->





    </div>






</x-guest-layout>
