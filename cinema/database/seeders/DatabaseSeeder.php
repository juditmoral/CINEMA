<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //USUARIS

        DB::table('users')->insert(['name' => 'usuari1', 'email' => 'usuari1@gmail.com', 'password' => bcrypt('123456'), 'esAdmin' => true]);
        DB::table('users')->insert(['name' => 'usuari2', 'email' => 'usuari2@gmail.com', 'password' => bcrypt('123456'), 'esAdmin' => false]);


        //PELICULES

        DB::table('pelicules')->insert([
            'duracio' => 120,
            'titul_es' => 'Origen',
            'titul_ca' => 'Origen',
            'titul_en' => 'Inception',
            'genere_es' => 'Ciencia Ficción',
            'genere_ca' => 'Ciencia Ficció',
            'genere_en' => 'Science Fiction',
            'descripció_es' => 'Un grupo de expertos entra en sueños para robar secretos.',
            'descripció_ca' => 'Un grup d’experts entren als somnis per robar secrets.',
            'descripció_en' => 'A group of experts enters dreams to steal secrets.',
            'url' => 'https://pics.filmaffinity.com/Origen-652954101-large.jpg'
        ]);

        DB::table('pelicules')->insert([
            'duracio' => 95,
            'titul_es' => 'Del Revés',
            'titul_ca' => 'Del Revés',
            'titul_en' => 'Inside Out',
            'genere_es' => 'Animación',
            'genere_ca' => 'Animació',
            'genere_en' => 'Animation',
            'descripció_es' => 'Exploración de las emociones de una niña a través de sus personajes internos.',
            'descripció_ca' => 'Exploració de les emocions d’una nena mitjançant els seus personatges interns.',
            'descripció_en' => 'Exploration of a girl’s emotions through her inner characters.',
            'url' => 'https://pics.filmaffinity.com/Del_revaes_Inside_Out-161470323-large.jpg'
        ]);

        DB::table('pelicules')->insert([
            'duracio' => 143,
            'titul_es' => 'Salvar al Soldado Ryan',
            'titul_ca' => 'Salvar al Soldat Ryan',
            'titul_en' => 'Saving Private Ryan',
            'genere_es' => 'Bélico',
            'genere_ca' => 'Bèlic',
            'genere_en' => 'War',
            'descripció_es' => 'Una misión para rescatar a un soldado durante la Segunda Guerra Mundial.',
            'descripció_ca' => 'Una missió per rescatar un soldat durant la Segona Guerra Mundial.',
            'descripció_en' => 'A mission to rescue a soldier during World War II.',
            'url' => 'https://www.justwatch.com/images/poster/321632686/s332/saving-private-ryan'
        ]);



        //FUNCIONS

        DB::table('funcions')->insert(['data' => '2024-12-01','hora' => '18:30:00','numSala' => '1','pelicula_id' => 1]);
        DB::table('funcions')->insert(['data' => '2024-03-10','hora' => '20:30:00','numSala' => '1','pelicula_id' => 1]);
        DB::table('funcions')->insert(['data' => '2024-12-02','hora' => '20:00:00','numSala' => '3','pelicula_id' => 2]);
        DB::table('funcions')->insert(['data' => '2024-12-03','hora' => '19:15:00','numSala' => '2','pelicula_id' => 3]);

        //SEIENTS

        foreach (['1', '2', '3', '4', '5', '6'] as $numSala) { // 6 sales
            for ($fila = 1; $fila <= 10; $fila++) { // 10 files per sala
                for ($numero = 1; $numero <= 15; $numero++) { // 15 seients per fila
                    DB::table('seient')->insert([
                        'numero' => $numero,
                        'fila' => $fila,
                        'numSala' => $numSala, // Assignar el número de sala
                    ]);
                }
            }
        }


        //ENTRADES

        DB::table('entrades')->insert([
            'funcio_id' => 1, // Funció a la sala 1
            'seient_id' => 1, // Seient 1 de la fila 1 de la sala 1
            'users_id' => 1,  // Usuari 1
        ]);

        DB::table('entrades')->insert([
            'funcio_id' => 3, // Funció a la sala 2
            'seient_id' => 85, // Seient de la fila 6 de la sala 2
            'users_id' => 1,  // Usuari 1
        ]);

    }
}
