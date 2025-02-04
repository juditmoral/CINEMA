<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelicules', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('duracio');
            $table->string('titul_es');
            $table->string('titul_ca');
            $table->string('titul_en');
            $table->enum('genere_es',['Acción','Animación','Aventura','Bélico','Ciencia Ficción','Biográfico','Comedia','Documental','Drama',"Thriller",'Terror']);
            $table->enum('genere_ca',['Acció','Animació','Aventura','Bèlic','Ciencia Ficció','Biogràfic','Comèdia','Documental','Drama',"Thriller",'Terror']);
            $table->enum('genere_en',['Action','Animation','Adventure','War','Science Fiction','Biography','Comedy','Documentary','Drama','Thriller','Horror']);
            $table->string('descripció_es');
            $table->string('descripció_ca');
            $table->string('descripció_en');
            $table->string('pais_es');
            $table->string('pais_ca');
            $table->string('pais_en');
            $table->string('data');
            $table->string('director');
            $table->string("url");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelicules');
    }
};
