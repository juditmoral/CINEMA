@php
    $locale = App::currentLocale();
    $locale = app()->getLocale();
    \Carbon\Carbon::setLocale($locale);

    // Agrupar entradas por película
    $entradesPorPelicula = [];
    foreach ($entrades as $entrada) {
        $seient = $entrada->seient_id;
        $funcio = $entrada->funcio_id;
        $seleccionat = \App\Models\Seients::where('id', $seient)->first();
        $seleccionatf = \App\Models\Funcions::where('id', $funcio)->first();
        $pelicula = $seleccionatf->pelicula_id;
        $seleccionatp = \App\Models\Pelicules::where('id', $pelicula)->first();
        $tituloPelicula = 'titul_' . $locale; // Construir el nombre del campo dinámicamente
        $entradesPorPelicula[$seleccionatp->$tituloPelicula][] = [
            'seleccionat' => $seleccionat,
            'seleccionatf' => $seleccionatf,
            'pelicula' => $seleccionatp,
            'formattedDate' => \Carbon\Carbon::parse($seleccionatf->data)
                ->locale($locale)
                ->format('d-m-Y'),
            'entrada' => $entrada,
        ];
    }
@endphp

<x-app-layout>

    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Cabecera con fondo degradado -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
        style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset('https://eldinero.com.do/wp-content/uploads/Cine.jpeg') }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{ __('Tiquets') }}
        </h2>
    </div>

    <div class="pl-3 space-y-4 w-full">
        @foreach ($entradesPorPelicula as $tituloPelicula => $entradasPelicula)
            <div class="text-4xl font-bold text-white text-center mt-8 mb-8">{{ __($tituloPelicula) }}</div>

            <div class="grid grid-cols-2 gap-4 justify-items-center">
                @foreach ($entradasPelicula as $data)
                    @php
                        $seleccionat = $data['seleccionat'];
                        $seleccionatf = $data['seleccionatf'];
                        $seleccionatp = $data['pelicula'];
                        $formattedDate = $data['formattedDate'];
                        $entrada = $data['entrada'];
                    @endphp
                    <div class="bg-cover bg-center p-4 rounded shadow-md w-2/3"
                        style="background: url('{{ $seleccionatp->url }}'); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay; background-color: rgba(0, 0, 0, 0.5);">
                        <div class="flex justify-between items-start text-gray-800">

                            <!-- Columna izquierda (fila y número) -->
                            <div class="space-y-2 text-white">
                                <h2 class="text-lg"><strong>{{ __('Fila: ') }}</strong>{{ $seleccionat->fila }}</h2>
                                <h2 class="text-lg"><strong>{{ __('Número: ') }}</strong>{{ $seleccionat->numero }}</h2>
                            </div>

                            <!-- Columna derecha (día y hora) -->
                            <div class="space-y-2 text-right text-white">
                                <h2 class="text-lg"><strong>{{ __('Dia: ') }}</strong>{{ $formattedDate }}</h2>
                                <h2 class="text-lg"><strong>{{ __('Hora: ') }}</strong>{{ $entrada->hora }}</h2>
                            </div>
                        </div>

                        <!-- Mostrar código de barras y texto 'STELLA' debajo -->
                        <div class="mt-4 text-center">
                            @php
                                // Generar código de barras con el ID de la entrada (como ejemplo)
                                $barcode = \Picqer\Barcode\BarcodeGeneratorPNG::class;
                                $generator = new $barcode();
                                // Cambiar color a blanco para el código de barras
                                $barcodeImage = base64_encode(
                                    $generator->getBarcode($entrada->id, $generator::TYPE_CODE_128, 3, 50, [
                                        255,
                                        255,
                                        255,
                                    ]),
                                );
                            @endphp
                            <img class="mx-auto" src="data:image/png;base64,{{ $barcodeImage }}" alt="Códi de barres">

                            <h2 class="font-bold text-lg text-white mt-4">{{ __('STELLA') }}</h2>
                            <h2 class="font-bold text-lg text-white mt-4">{{ __('Sala: ') }}
                                {{ $seleccionat->numSala }}</h2>

                            <!-- Botón de papelera debajo a la derecha -->
                            <div class="flex justify-end ">
                                <form action="{{ route('entrades.delete', $entrada->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta entrada?');">
                                    @csrf
                                    @method('DELETE') <!-- Esto asegura que se use el método DELETE -->
                                    <button type="submit" class="bg-transparent">
                                        <i class="fas fa-trash text-lg text-white"></i>
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

</x-app-layout>
