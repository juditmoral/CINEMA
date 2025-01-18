@php
    $locale = App::currentLocale();
    $locale = app()->getLocale();
    \Carbon\Carbon::setLocale($locale);
    $month = \Carbon\Carbon::parse($dia)->translatedFormat('M'); 
    $month = ucfirst($month); 
    $month = rtrim($month, '.');
@endphp

<x-guest-layout>
   
    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Capçalera -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
        style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset($pelicula->url) }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{ $pelicula->{'titul_' . $locale} }}
        </h2>
    </div>

    <div class="mt-8 pl-3">
        <!-- Titul de la pel·licula -->
        <h2 class="text-white font-bold text-4xl mb-2">
            {{ $pelicula->{'titul_' . $locale} }}
        </h2>

        <!-- Gènere de la pel·licula  -->
        <p class="text-gray-400 text-lg mb-2">
            <strong>{{ __('Gènere') }}:</strong> {{ $pelicula->{'genere_' . $locale} }}
        </p>

        <!-- Duració de la pel·licula  -->
        <p class="text-gray-400 text-lg mb-6">
            <strong>{{ __('Duració') }}:</strong> {{ $pelicula->duracio }} min
        </p>

        <!-- Secció amb la imatge i entrades -->
        <div class="flex justify-between items-start w-full mt-8">
            
            <div class="mr-8">
                <img src="{{ asset($pelicula->url) }}" alt="Poster {{ $pelicula->{'titul_' . $locale} }}"
                    class="w-80 h-auto object-cover rounded-lg">

                <button type="submit" id="continuarButton"
                    class="mt-4 px-6 py-2 bg-white text-gray-500 font-medium text-lg rounded-lg border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    {{ __('Veure tiquets') }}
                </button>


            </div>

            <!-- Secció de pagar -->
            <div class="flex w-full items-start justify-between">
                <!-- Passos -->
                <div class="w-2/3">
                    <div class="flex items-start gap-6 mb-6">
                        <!-- Pas 1 -->
                        <div class="flex items-center ml-5">
                            <div
                                class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">
                                1
                            </div>
                            <span class="ml-2 text-gray-500 font-medium">{{ __('Escull el teu lloc') }}</span>
                        </div>

                        <!-- Separador -->
                        <div class="w-12 border-t border-gray-500 mt-4"></div>

                        <!-- Pas 2 -->
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-200 text-gray-500 font-bold flex justify-center items-center rounded-full">
                                2
                            </div>
                            <span class="ml-2 text-gray-500 font-medium">{{ __('Pagament') }}</span>
                        </div>

                        <!-- Separador -->
                        <div class="w-12 border-t border-gray-500 mt-4"></div>

                        <!-- Pas 3 -->
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-500 text-white font-bold flex justify-center items-center rounded-full">
                                3
                            </div>
                            <span class="ml-2 text-white font-medium">{{ __('Tíquets') }}</span>
                        </div>
                    </div>

                    <!-- Recuadre gris asota  dels passos -->
                    <div class="bg-transparent p-4 rounded-lg ml-4">
                        @php
                            $usuariId = Auth::id();
                            // Obtenir les dos últimes  entrades del usuari
                            $entrades = \App\Models\Entrades::where('users_id', $usuariId)
                                ->orderBy('id', 'desc')
                                ->take($count)
                                ->get();
                        @endphp

                        @if ($entrades->isEmpty())
                            <p class="text-gray-500">{{ __('No hi ha entrades disponibles.') }}</p>
                        @else
                            <ul class="space-y-2">
                                @foreach ($entrades as $entrada)
                                    @php
                                        // Buscar el seient relacionat amb id_seient de l'entrada
                                        $seient = \App\Models\Seients::find($entrada->seient_id);
                                        $funcio = \App\Models\Funcions::find($entrada->funcio_id);
                                        $pelicula = \App\Models\Pelicules::find($funcio->pelicula_id);
                                       
                                        $formattedDate = \Carbon\Carbon::parse($funcio->data)
                                            ->locale($locale)
                                            ->format('d-m-Y');
                                    @endphp

                                    <li class="bg-transparent p-3 rounded-lg text-white flex"
                                        style="position: relative; background-image: url('{{ asset($pelicula->url) }}'); background-size: cover; background-position: center;">
                                       
                                        <div class="absolute inset-0 bg-black opacity-50 rounded-lg"></div>

                                        <!-- Fila, número, dia, hora, còdi de barras y STELLA amb la sala -->
                                        <div class="w-full flex flex-col justify-between relative z-10">
                                           
                                            <div class="flex mb-2">
                                                <div class="flex flex-col w-1/2">
                                                    <p><strong>{{ __('Fila') }}:</strong> {{ $seient->fila }}</p>
                                                </div>
                                                <div class="flex flex-col w-1/2 text-right">
                                                    <p><strong>{{ __('Dia') }}:</strong> {{ $formattedDate }}</p>
                                                </div>
                                            </div>

                                            <div class="flex mb-2">
                                                <div class="flex flex-col w-1/2">
                                                    <p><strong>{{ __('Número') }}:</strong> {{ $seient->numero }}</p>
                                                </div>
                                                <div class="flex flex-col w-1/2 text-right">
                                                    <p><strong>{{ __('Hora') }}:</strong> {{ $entrada->hora }}</p>
                                                </div>
                                            </div>

                                           
                                            <div class="mt-4 flex justify-center">
                                                @php
                                                   
                                                    $barcode = \Picqer\Barcode\BarcodeGeneratorPNG::class;
                                                    $generator = new $barcode();
                                                   
                                                    $barcodeImage = base64_encode(
                                                        $generator->getBarcode(
                                                            $entrada->id,
                                                            $generator::TYPE_CODE_128,
                                                            2,
                                                            30,
                                                            [255, 255, 255],
                                                        ),
                                                    );
                                                @endphp
                                                <img src="data:image/png;base64,{{ $barcodeImage }}"
                                                    alt="Códi de barres">
                                            </div>

                                           
                                            <div class="mt-4 text-center">
                                                <p class="text-white font-bold text-lg">{{ __('STELLA') }}</p>
                                                 <p class="text-white font-bold text-lg">{{ __('Sala: ') }}{{ $seient->numSala}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>















                </div>

                <!-- Informació de Dia, Hora y Total -->
                <div class="flex flex-col items-start space-y-2 w-1/3 ml-24 mt-10">
                    
                    <div class="text-gray-500 text-lg">
                        <strong>{{ __('Día') }}:</strong>
                    </div>
                    <div
                        class="text-white font-bold text-5xl py-2 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ \Carbon\Carbon::parse($dia)->day }}
                    </div>
                    <div
                        class="text-white font-medium text-sm py-1 px-4 rounded-lg text-center border-2 border-gray-700">
                        {{ $month }} 
                    </div>

                    
                    <div class="text-gray-500 text-lg mt-4">
                        <strong>{{ __('Hora') }}:</strong>
                    </div>
                    <div class="text-white font-bold text-3xl py-2 rounded-lg text-center">
                        {{ $hora }}
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>
