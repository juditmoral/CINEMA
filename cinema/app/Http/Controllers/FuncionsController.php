<?php

namespace App\Http\Controllers;

use App\Models\Funcions;
use App\Models\Pelicules;
use Illuminate\Http\Request;

class FuncionsController extends Controller
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
     * @param  \App\Models\Funcions  $funcions
     * @return \Illuminate\Http\Response
     */
    public function show(Funcions $funcions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcions  $funcions
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcions $funcions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcions  $funcions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcions $funcions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcions  $funcions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcions $funcions)
    {
        //
    }


    public function storeFunction(Request $request)
    {
       
        // Validació del formulari
        $request->validate([
            'data' => 'required|string',
            'hora' => 'required|string',
            'numSala' => 'required|integer|min:1|max:6',
        ]);
    
        // Recuperar dades del formulari
        $data = $request->input('data');
        $hora = $request->input('hora');
        $numSala = $request->input('numSala');
        $idPelicula = $request->input('idPelicula');
    
        $pelicula = Pelicules::findOrFail($idPelicula);
    
        // Verificar si ja existeix una funció amb la mateixa data i sala
        $existeixSala = Funcions::where('data', $data)
            ->where('numSala', $numSala)
            ->exists();
    
        if ($existeixSala) {
            return redirect()->route('infofilms',$pelicula);
        }
    
        // Verificar si ja existeix una funció de la mateixa pel·lícula en la mateixa data
        $existeixPelicula = Funcions::where('data', $data)
            ->where('pelicula_id', $idPelicula)
            ->exists();
    
        if ($existeixPelicula) {
            return redirect()->route('infofilms',$pelicula);
        }
    
        // Crear la nova funció si no existeix cap conflicte
        Funcions::create([
            'hora' => $hora,
            'data' => $data,
            'numSala' => $numSala,
            'pelicula_id' => $idPelicula,
        ]);
    
        
        
        return redirect()->route('infofilms',$pelicula);
        
    }


    public function crearFuncio($id){
        $pelicula = Pelicules::findOrFail($id);
    
        return view('crearFuncio',compact('pelicula'));
    }


    public function eliminar($id)
    {
        $funcio = Funcions::find($id);
    
        if ($funcio) {
            // Eliminar la película
            $funcio->delete();
            return back()->with('success', 'Funció eliminada amb èxit.');
        }
    
        return back()->with('error', 'La Funció no existeix.');
    }
    



}
