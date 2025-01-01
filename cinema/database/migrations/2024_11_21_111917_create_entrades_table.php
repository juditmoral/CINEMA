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
        Schema::create('entrades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcio_id')
            ->constrained(table: 'funcions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('seient_id')
            ->constrained(table: 'seient')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreignId('users_id')
            ->constrained(table: 'users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('hora');


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
        Schema::dropIfExists('entrades');
    }
};
