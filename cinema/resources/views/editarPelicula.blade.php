@php
    $locale = App::currentLocale();
@endphp


@can('administrar')   

<x-app-layout>

    <div class="absolute top-0 left-0 w-full z-20">
        @include('layouts.navigation')
    </div>

    <!-- Encapçalament amb fons degradat -->
    <div class="w-full min-h-[300px] flex justify-center items-center bg-cover bg-center top-0 mt-0 z-10"
        style="background: linear-gradient(rgba(100, 100, 100, 0.5), rgba(100, 100, 100, 0.5)), url('{{ asset('https://img.freepik.com/vector-gratis/fondo-escenario-cine-palomitas-maiz-sillas-claqueta_1017-38722.jpg?semt=ais_hybrid') }}'); background-size: cover; background-repeat: no-repeat;">
        <h2 class="text-white font-bold text-6xl">
            {{__('Editar pel·lícules')}}
        </h2>
    </div>

    <div class="container mx-auto my-8">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('guardarPeli', $pelicula->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="duracio" class="block text-sm font-semibold text-white">{{ __('Duració') }}</label>
                    <input type="text" name="duracio" id="duracio" value="{{ old('duracio',$pelicula->duracio) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>
                <!-- Títol -->
                <div class="mb-6">
                    <label for="titul_es" class="block text-sm font-semibold text-white">{{ __('Títol en Espanyol') }}</label>
                    <input type="text" name="titul_es" id="titul_es" value="{{ old('titul_es',$pelicula->titul_es) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>
                <div class="mb-6">
                    <label for="titul_ca" class="block text-sm font-semibold text-white">{{ __('Títol en Català') }}</label>
                    <input type="text" name="titul_ca" id="titul_ca" value="{{ old('titul_ca',$pelicula->titul_ca) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>
                <div class="mb-6">
                    <label for="titul_en" class="block text-sm font-semibold text-white">{{ __('Títol en Anglès') }}</label>
                    <input type="text" name="titul_en" id="titul_en" value="{{ old('titul_en',$pelicula->titul_ca) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <!-- Descripció -->
                <div class="mb-6">
                    <label for="descripció_es" class="block text-sm font-semibold text-white">{{ __('Descripció en Espanyol') }}</label>
                    <textarea name="descripció_es" id="descripció_es" class="mt-2 w-full p-2 border rounded-md" rows="4" required>{{ old('descripció_es',$pelicula->descripció_es) }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="descripció_ca" class="block text-sm font-semibold text-white">{{ __('Descripció en Català') }}</label>
                    <textarea name="descripció_ca" id="descripció_ca" class="mt-2 w-full p-2 border rounded-md" rows="4" required>{{ old('descripció_ca',$pelicula->descripció_ca) }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="descripció_en" class="block text-sm font-semibold text-white">{{ __('Descripció en Anglès') }}</label>
                    <textarea name="descripció_en" id="descripció_en" class="mt-2 w-full p-2 border rounded-md" rows="4" required>{{ old('descripció_en',$pelicula->descripció_en) }}</textarea>
                </div>

                <!-- Gènere -->
                <div class="mb-6">
                    <label for="genere_es" class="block text-sm font-semibold text-white">{{ __('Gènere en Espanyol') }}</label>
                    <select name="genere_es" id="genere_es" class="mt-2 w-full p-2 border rounded-md" required>{{old('genere_es',$pelicula->genere_es)}}
                        <option value="Acción">{{ __('Acción') }}</option>
                        <option value="Animación">{{ __('Animación') }}</option>
                        <option value="Aventura">{{ __('Aventura') }}</option>
                        <option value="Bélico">{{ __('Bélico') }}</option>
                        <option value="Ciencia Ficción">{{ __('Ciencia Ficción') }}</option>
                        <option value="Biográfico">{{ __('Biográfico') }}</option>
                        <option value="Comedia">{{ __('Comedia') }}</option>
                        <option value="Documental">{{ __('Documental') }}</option>
                        <option value="Drama">{{ __('Drama') }}</option>
                        <option value="Thriller">{{ __('Thriller') }}</option>
                        <option value="Terror">{{ __('Terror') }}</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="genere_ca" class="block text-sm font-semibold text-white">{{ __('Gènere en Català') }}</label>
                    <select name="genere_ca" id="genere_ca" class="mt-2 w-full p-2 border rounded-md" required>{{old('genere_es',$pelicula->genere_ca)}}
                        <option value="Acció">{{ __('Acció') }}</option>
                        <option value="Animació">{{ __('Animació') }}</option>
                        <option value="Aventura">{{ __('Aventura') }}</option>
                        <option value="Bèlic">{{ __('Bèlic') }}</option>
                        <option value="Ciencia Ficció">{{ __('Ciencia Ficció') }}</option>
                        <option value="Biogràfic">{{ __('Biogràfic') }}</option>
                        <option value="Comèdia">{{ __('Comèdia') }}</option>
                        <option value="Documental">{{ __('Documental') }}</option>
                        <option value="Drama">{{ __('Drama') }}</option>
                        <option value="Thriller">{{ __('Thriller') }}</option>
                        <option value="Terror">{{ __('Terror') }}</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="genere_en" class="block text-sm font-semibold text-white">{{ __('Gènere en Anglès') }}</label>
                    <select name="genere_en" id="genere_en" class="mt-2 w-full p-2 border rounded-md" required>{{old('genere_es',$pelicula->genere_en)}}
                        <option value="Action">{{ __('Action') }}</option>
                        <option value="Animation">{{ __('Animation') }}</option>
                        <option value="Adventure">{{ __('Adventure') }}</option>
                        <option value="War">{{ __('War') }}</option>
                        <option value="Science Fiction">{{ __('Science Fiction') }}</option>
                        <option value="Biography">{{ __('Biography') }}</option>
                        <option value="Comedy">{{ __('Comedy') }}</option>
                        <option value="Documentary">{{ __('Documentary') }}</option>
                        <option value="Drama">{{ __('Drama') }}</option>
                        <option value="Thriller">{{ __('Thriller') }}</option>
                        <option value="Horror">{{ __('Horror') }}</option>
                    </select>
                </div>

                <!-- Data de l'estrena -->
                <div class="mb-6">
                    <label for="data" class="block text-sm font-semibold text-white">{{ __('Data d\'estrena') }}</label>
                    <input type="date" name="data" id="data" value="{{ old('data',$pelicula->data) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <!-- Director -->
                <div class="mb-6">
                    <label for="director" class="block text-sm font-semibold text-white">{{ __('Director') }}</label>
                    <input type="text" name="director" id="director" value="{{ old('director',$pelicula->director) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="pais_es" class="block text-sm font-semibold text-white">{{ __('Pais en Espanyol') }}</label>
                    <input type="text" name="pais_es" id="pais_es" value="{{ old('pais_es',$pelicula->pais_es) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="pais_ca" class="block text-sm font-semibold text-white">{{ __('Pais en Català') }}</label>
                    <input type="text" name="pais_ca" id="pais_ca" value="{{ old('pais_ca',$pelicula->pais_ca) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="pais_en" class="block text-sm font-semibold text-white">{{ __('Pais en Anglès') }}</label>
                    <input type="text" name="pais_en" id="pais_en" value="{{ old('pais_en',$pelicula->pais_en) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <!-- Imatge del Pòster -->
                <div class="mb-6">
                    <label for="url" class="block text-sm font-semibold text-white">{{ __('URL de la imatge del pòster') }}</label>
                    <input type="url" name="url" id="url" value="{{ old('url',$pelicula->url) }}" class="mt-2 w-full p-2 border rounded-md" required>
                </div>

                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">
                        {{ __('Editar pel·lícula') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>


@else

<p>{{__('Nomes per administradors')}}</p>

@endcan