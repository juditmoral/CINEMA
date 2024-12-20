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
        Schema::create('funcions', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('hora');
            $table->enum('numSala',['1','2','3','4','5','6']);
            
            $table->foreignId('pelicula_id')
             ->constrained(table: 'pelicules')
             ->onUpdate('cascade')
             ->onDelete('cascade');

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
        Schema::dropIfExists('funcions');
    }
};
