@php
    $locale = App::currentLocale();
    $shora = '';
    $sdia = '';
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

        <div class="w-full flex justify-end mt-4 mr-16">
            @can('administrar')
                <button onclick="window.location.href='{{ route('crearPelicula') }}'"
                    class="mr-4 px-3 py-2 bg-transparent text-white rounded-md font-bold text-4xl hover:bg-red-500">
                    +
                </button>

                <button onclick="window.location.href='{{ route('editarPelicula',$pelicula->id) }}'"
                    class="mr-4 px-3 py-2 bg-transparent text-white rounded-md font-bold text-xl hover:bg-red-500">
                    <i class="fas fa-edit"></i>
                </button>

                <button onclick="window.location.href='{{ route('crearPelicula') }}'"
                    class="mr-4 px-3 py-2 bg-transparent text-white rounded-md font-bold text-xl hover:bg-red-500">
                    <i class="fas fa-trash-alt"></i>
                </button>
            @endcan
        </div>

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

        <!-- Sección con la imagen y las funciones -->
        <div class="flex">

            <!-- Imagen de la cartelera -->
            <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                class="w-1/4 h-auto object-cover rounded-lg mr-8">


            <!-- Información de las funciones -->
            <div class="flex w-full justify-start gap-0">
                @php
                    // Buscar todas las funciones de la película
                    $funcions = \App\Models\Funcions::where('pelicula_id', $pelicula->id)->get();
                @endphp

                @if ($funcions->isNotEmpty())
                    @foreach ($funcions as $funcio)
                        @php
                            $data = \Carbon\Carbon::parse($funcio->data);
                            // Separar las horas en un array
                            $hores = explode(',', $funcio->hora);
                        @endphp

                        <!-- Caja para cada función -->
                        <div class="flex flex-col items-center text-center w-1/4 last:mr-0 mb-8">
                            <!-- Día de la semana -->
                            <h3 class="text-white font-bold text-lg mb-1">
                                {{ ucfirst($data->locale($locale)->dayName) }}
                            </h3>

                            <!-- Número del día -->
                            <h2 class="text-white font-extrabold text-5xl mb-1">
                                {{ $data->day }}
                            </h2>

                            <!-- Mes -->
                            <h3 class="text-gray-400 text-base mb-1">
                                {{ ucfirst($data->locale($locale)->translatedFormat('F')) }}
                            </h3>

                            <!-- Línea blanca que se oculta dependiendo de la selección -->
                            <div class="w-full h-[2px] bg-white mt-1"></div>

                            <!-- Botones de hora con espacio lateral entre ellos -->
                            <div class="flex flex-col gap-3 mt-3 w-full mb-3">
                                @foreach ($hores as $hora)
                                    <div class="w-full">
                                        <button
                                            class="hora-btn bg-white text-gray-600 font-bold py-2 w-20 rounded-md shadow-md"
                                            data-hora="{{ $hora }}" data-dia="{{ $data->toDateString() }}"
                                            data-funcio-id="{{ $funcio->id }}">
                                            {{ $hora }}
                                        </button>
                                    </div>
                                    <div class="w-full h-[1px] bg-gray-500"></div>
                                @endforeach

                            </div>

                        </div>
                    @endforeach
                @else
                    <p class="text-gray-400">{{ __('No hi han funcions programades') }}</p>
                @endif
            </div>

        </div>

        <form id="form-comprar" method="GET" action="{{ route('seients') }}" style="display:none;">
            @csrf
            <input type="hidden" name="id" id="pelicula-id" value="{{ $pelicula->id }}">
            <input type="hidden" name="hora" id="hora" value="">
            <input type="hidden" name="dia" id="dia" value="">
            <input type="hidden" name="funcioId" id="funcio-id" value="">
        </form>


        <!-- Contenedor para el botón de "Comprar" centrado justo debajo de la imagen del cartel -->
        <div class="flex justify-left mt-6">


            @auth
                <button id="comprar-btn"
                    class="bg-white text-gray-600 font-bold py-2 px-6 rounded-md shadow-md hover:bg-gray-100">
                    {{ __('Comprar') }}
                </button>
            @else
                <p class="text-red-600 font-bold">
                    {{ __('Per poder comprar, has d\'iniciar sessió o registrar-te.') }}
                </p>
            @endauth

        </div>

        <script>
            document.querySelector('#comprar-btn').addEventListener('click', function() {
                // Obtener los valores de hora, día y función desde sessionStorage
                var hora = sessionStorage.getItem('hora');
                var dia = sessionStorage.getItem('dia');
                var funcioId = sessionStorage.getItem('funcioId');

                // Verificar que los valores están disponibles
                if (hora && dia && funcioId) {
                    // Asignar los valores al formulario
                    document.getElementById('hora').value = hora;
                    document.getElementById('dia').value = dia;
                    document.getElementById('funcio-id').value = funcioId;

                    // Enviar el formulario
                    document.getElementById('form-comprar').submit();
                } else {
                    // Mostrar un mensaje de error si no hay selección
                    alert("Por favor, selecciona una hora y un día.");
                }
            });
        </script>


        <!-- Sección Detalles y Sinopsis con la línea -->
        <div class="mt-20">
            <!-- Texto Detalles a la izquierda y Sinopsis a la derecha -->
            <div class="flex justify-between items-center">
                <p class="text-white text-2xl font-semibold">{{ __('Detalls') }}</p>
                <p class="text-white text-2xl font-semibold text-center flex-1">{{ __('Sinopsi') }}</p>
            </div>

            <!-- Línea de degradado rojo a negro -->
            <div class="w-full h-[2px] bg-gradient-to-r from-red-600 to-black mt-4 mb-8"></div>

            <div class="flex justify-between">
                <!-- Parte izquierda: País, Fecha, Director -->
                <div class="w-1/3">
                    <p class="text-white text-1xl font-semibold">
                        {{ __('PAIS') }}:
                        <span class="ml-2 font-normal">{{ $pelicula->{'pais_' . $locale} }}</span>
                    </p>
                    <p class="text-white text-1xl font-semibold">
                        {{ __('DATA') }}:
                        <span class="ml-2 font-normal">{{ $pelicula->data }}</span>
                    </p>
                    <p class="text-white text-1xl font-semibold">
                        {{ __('DIRECTOR') }}:
                        <span class="ml-2 font-normal">{{ $pelicula->director }}</span>
                    </p>
                </div>

                <!-- Parte derecha: Descripción de la película -->
                <div class="w-2/3">
                    <p class="text-white text-1xl font-bold text-center">{{ $pelicula->{'descripció_' . $locale} }}</p>
                </div>
            </div>
        </div>





    </div>

    <script>
        document.querySelectorAll('.hora-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Cambiar el color del botón
                this.classList.add('bg-red-600', 'text-white');
                this.classList.remove('bg-white', 'text-gray-600');

                // Obtener la hora, día y ID de la función
                var hora = this.getAttribute('data-hora');
                var dia = this.getAttribute('data-dia');
                var funcioId = this.getAttribute('data-funcio-id');

                // Guardar en sessionStorage
                sessionStorage.setItem('hora', hora);
                sessionStorage.setItem('dia', dia);
                sessionStorage.setItem('funcioId', funcioId);
            });
        });
    </script>


</x-guest-layout>
