

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

        <!-- Sección con la imagen y compra -->
        <div class="flex justify-between items-start w-full mt-8">
            <!-- Imagen de la cartelera -->
            <div class="mr-8">
                <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                    class="w-80 h-auto object-cover rounded-lg">
                <form method="GET" action="{{ route('pagat') }}" id="paymentForm">
                    @csrf

                    <input type="hidden" name="selectedSeats" value='@json($selectedSeats)'>
                    <input type="hidden" name="dia" value="{{ $dia }}">
                    <input type="hidden" name="hora" value="{{ $hora }}">
                    <input type="hidden" name="sala" value="{{ $sala }}">
                    <input type="hidden" name="funcio_id" value="{{ $funcio_id }}">
                    <input type="hidden" name="pelicula_id" value="{{ $pelicula_id }}">

                    <!-- Botó pagar -->
                    <button type="submit" id="continuarButton"
                        class="mt-4 px-6 py-2 bg-white text-gray-500 font-medium text-lg rounded-lg border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        {{ __('Pagar') }}
                    </button>
                </form>

            </div>

            <!-- Sección de pagar -->
            <div class="flex w-full items-start justify-between">
                <!-- Pasos numerados y recuadro gris -->
                <div class="w-2/3">
                    <div class="flex items-start gap-6 mb-6">
                        <!-- Paso 1 -->
                        <div class="flex items-center ml-5">
                            <div
                                class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">
                                1
                            </div>
                            <span class="ml-2 text-gray-500 font-medium">{{ __('Escull el teu lloc') }}</span>
                        </div>

                        <!-- Separador -->
                        <div class="w-12 border-t border-gray-500 mt-4"></div>

                        <!-- Paso 2 -->
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-500 text-white font-bold flex justify-center items-center rounded-full">
                                2
                            </div>
                            <span class="ml-2 text-white font-medium">{{ __('Pagament') }}</span>
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

                    <!-- Recuadro gris debajo de los pasos numerados -->
                    <div class="bg-gray-700 p-4 rounded-lg ml-4">
                        <!-- Aquí puedes agregar contenido adicional si lo deseas -->
                        <h4 class="text-white font-bold text-xl">{{ __('Detalls') }}</h4>

                        <div class="w-100% border-t border-gray-500 mt-4"></div>

                        <h2 class="text-gray-500 font-bold text-lg mt-4">{{ __('Nom') }}</h2>

                        <input type="text" id="name"
                            class="w-full p-2 mt-2 bg-transparent text-white border-0 border-b-2 border-gray-500 focus:outline-none focus:border-white"
                            placeholder="{{ __('Escriu el teu nom') }}">

                        <h2 class="text-gray-500 font-bold text-lg mt-4">{{ __('Número de la targeta') }}</h2>

                        <input type="text" id="cardNumber"
                            class="w-full p-2 mt-2 bg-transparent text-white border-0 border-b-2 border-gray-500 focus:outline-none focus:border-white"
                            placeholder="{{ __('Escriu el número de la targeta') }}" maxlength="19"
                            oninput="maskCardNumber(this)">

                        <h2 class="text-gray-500 font-bold text-lg mt-4">{{ __('Caducitat') }}</h2>


                        <div class="flex space-x-4 mt-2">
                            <div class="w-1/2">
                                <select id="month"
                                    class="w-full p-2 bg-transparent text-white border-0 border-b-2 border-gray-500 focus:outline-none focus:border-white">
                                    <option value="" disabled selected>{{ __('mes') }}</option>
                                    <!-- Opciones de meses -->
                                    <option value="01">{{ __('01') }}</option>
                                    <option value="02">{{ __('02') }}</option>
                                    <option value="03">{{ __('03') }}</option>
                                    <option value="04">{{ __('04') }}</option>
                                    <option value="05">{{ __('05') }}</option>
                                    <option value="06">{{ __('06') }}</option>
                                    <option value="07">{{ __('07') }}</option>
                                    <option value="08">{{ __('08') }}</option>
                                    <option value="09">{{ __('09') }}</option>
                                    <option value="10">{{ __('10') }}</option>
                                    <option value="11">{{ __('11') }}</option>
                                    <option value="12">{{ __('12') }}</option>
                                </select>
                            </div>
                            <div class="w-1/2">
                                <select id="year"
                                    class="w-full p-2 bg-transparent text-white border-0 border-b-2 border-gray-500 focus:outline-none focus:border-white">
                                    <option value="" disabled selected>{{ __('any') }}</option>
                                    <!-- Opciones de años -->
                                    <option value="23">{{ __('23') }}</option>
                                    <option value="24">{{ __('24') }}</option>
                                    <option value="25">{{ __('25') }}</option>
                                    <option value="26">{{ __('26') }}</option>
                                    <option value="27">{{ __('27') }}</option>
                                    <option value="28">{{ __('28') }}</option>
                                    <option value="29">{{ __('29') }}</option>
                                    <option value="30">{{ __('30') }}</option>
                                    <option value="31">{{ __('31') }}</option>
                                </select>
                            </div>
                        </div>


                        <h2 class="text-gray-500 font-bold text-lg mt-4">{{ __('CVV') }}</h2>


                        <input type="password" id="cvv"
                            class="w-full p-2 mt-2 bg-transparent text-white border-0 border-b-2 border-gray-500 focus:outline-none focus:border-white"
                            placeholder="{{ __('Escriu el CVV') }}" maxlength="3" pattern="\d{3}"
                            inputmode="numeric" required oninput="this.value = this.value.replace(/\D/g, '')">





                    </div>
                </div>

                <!-- Información de Día, Hora y Total a la derecha -->
                <div class="flex flex-col items-start space-y-2 w-1/3 ml-24 mt-10">
                    <!-- Día -->
                    <div class="text-gray-500 text-lg">
                        <strong>{{ __('Día') }}:</strong>
                    </div>
                    <div
                        class="text-white font-bold text-5xl py-2 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ \Carbon\Carbon::parse($dia)->day }}
                    </div>
                    <div
                        class="text-white font-medium text-sm py-1 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ $month }} <!-- Mes en abreviatura -->
                    </div>

                    <!-- Hora -->
                    <div class="text-gray-500 text-lg mt-4">
                        <strong>{{ __('Hora') }}:</strong>
                    </div>
                    <div class="text-white font-bold text-3xl py-2 rounded-lg text-center">
                        {{ $hora }}
                    </div>

                    <!-- Total a pagar -->
                    <div class="text-gray-500 text-lg mt-4">
                        <strong>{{ __('Total') }}:</strong>
                    </div>
                    <div id="totalToPay" class="text-white font-bold text-3xl py-2 rounded-lg text-center">
                        0 €
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectedSeats =
            @json($selectedSeats); // Pasem els seients seleccionats des del backend a JavaScript
        const pricePerSeat = 5; // Preu per cada seient
        const totalToPayElement = document.getElementById("totalToPay");

        // Calcular el total
        const total = selectedSeats.length * pricePerSeat;

        // Actualitzar el total al frontend
        totalToPayElement.textContent = `${total} €`;
    });



    function maskCardNumber(input) {
        // Eliminar cualquier carácter no numérico
        let value = input.value.replace(/\D/g, '');

        // Aplicar la máscara con espacios entre grupos de 4 dígitos
        if (value.length > 4) value = value.replace(/(\d{4})(?=\d)/g, '$1 ');

        // Actualizar el valor del campo con la máscara
        input.value = value;
    }

    // Validación para asegurarse de que el número de tarjeta tenga 16 dígitos
    document.getElementById("cardNumber").addEventListener("blur", function() {
        let cardNumber = this.value.replace(/\D/g, ''); // Eliminar espacios y caracteres no numéricos

    });


    document.getElementById("continuarButton").addEventListener("click", function() {
        const name = document.getElementById("name").value.trim();
        const cardNumber = document.getElementById("cardNumber").value.replace(/\D/g,
        ''); // Eliminar espais i caràcters no numèrics
        const month = document.getElementById("month").value;
        const year = document.getElementById("year").value;
        const cvv = document.getElementById("cvv").value;

        // Validacions bàsiques
        if (!name || cardNumber.length !== 16 || !month || !year || cvv.length !== 3) {
           
            event.preventDefault();

        }
        if (cardNumber.length !== 16) {
            
            return;
        }
        if (!month || !year) {
           
            return;
        }
        if (cvv.length !== 3) {
            
            return;
        }

        // Si tot és correcte, enviar el formulari
        document.getElementById("paymentForm").submit();
    });
</script>
