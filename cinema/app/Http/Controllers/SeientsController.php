<?php

namespace App\Http\Controllers;

use App\Models\Entrades;
use App\Models\Funcions;
use App\Models\Pelicules;
use App\Models\Seients;
use Illuminate\Http\Request;

class SeientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seients  $seients
     * @return \Illuminate\Http\Response
     */
    public function show(Seients $seients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seients  $seients
     * @return \Illuminate\Http\Response
     */
    public function edit(Seients $seients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seients  $seients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seients $seients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seients  $seients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seients $seients)
    {
        //
    }


    public function mostrarSeients(Request $request)
    {
        $peliculaId = $request->input('id');
        $hora = $request->input('hora');
        $dia = $request->input('dia');
        $funcioId = $request->input('funcioId');
        $pelicula = Pelicules::find($peliculaId);

        $funcio = Funcions::find($funcioId);
        $sala = $funcio->numSala;

        $seients = Seients::where('numSala', $sala)->get();

        $llocsOcupats = Entrades::where('funcio_id', $funcioId)
            ->pluck('seient_id')
            ->toArray(); // Ens assegurem que és un array


        if (!$pelicula) {
            return redirect()->back()->with('error', 'Pel·lícula no trobada.');
        }



        // Pasar los datos a la vista 'seients'
        return view('seients', compact('peliculaId', 'hora', 'dia', 'funcioId', 'pelicula', 'seients', 'llocsOcupats','sala','funcio'));
    }


    // CompraController.php

    // CompraController.php

    public function showCompra(Request $request)
    {
        // Recuperar la informació dels seients seleccionats
        $selectedSeats = json_decode($request->input('seats'), true);
    
        // Recuperar el dia, hora, sala, funció i pel·lícula
        $dia = $request->input('dia');
        $hora = $request->input('hora');
        $sala = $request->input('sala');
        $funcio_id = $request->input('funcioId');
        $pelicula_id = $request->input('peliculaId');
    
        // Passar la informació a la vista
        return view('compra', [
            'selectedSeats' => $selectedSeats,
            'dia' => $dia,
            'hora' => $hora,
            'sala' => $sala,
            'funcio_id' => $funcio_id,
            'pelicula_id' => $pelicula_id
        ]);


    }
    

}
