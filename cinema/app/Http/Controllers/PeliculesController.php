<?php

namespace App\Http\Controllers;

use App\Models\Pelicules;
use App\Models\Funcions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeliculesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pelicules = Pelicules::all();

        // Pasar las películas a la vista
        return view('', compact('pelicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crearPelicula');
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
     * @param  \App\Models\Pelicules  $pelicules
     * @return \Illuminate\Http\Response
     */
    //public function show(Pelicules $pelicules)
    //{
    //
    //}


    public function show($id)
    {
        // Busca la pel·lícula per ID
        $pelicula = Pelicules::findOrFail($id);

        // Retorna la vista amb la pel·lícula
        return view('infofilms', compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicules  $pelicules
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicules  $pelicules
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicules  $pelicules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelicules $pelicules)
    {
        //
    }


    public function crear()
    {

        return view('crearPelicula');
    }


    public function guardar(Request $request)
    {
        // Validar dades
        $request->validate([
            'duracio' => 'required|integer',
            'titul_es' => 'required|string',
            'titul_ca' => 'required|string',
            'titul_en' => 'required|string',
            'descripció_es' => 'required|string',
            'descripció_ca' => 'required|string',
            'descripció_en' => 'required|string',
            'pais_es' => 'required|string',
            'pais_ca' => 'required|string',
            'pais_en' => 'required|string',
            'genere_es' => 'required|string',
            'genere_ca' => 'required|string',
            'genere_en' => 'required|string',
            'data' => 'required|date',
            'director' => 'required|string',
            'url' => 'required|string',
        ]);

        // Crear una nova pel·lícula
        Pelicules::create([
            'duracio' => $request->duracio,
            'titul_es' => $request->titul_es,
            'titul_ca' => $request->titul_ca,
            'titul_en' => $request->titul_en,
            'descripció_es' => $request->descripció_es,
            'descripció_ca' => $request->descripció_ca,
            'descripció_en' => $request->descripció_en,
            'pais_es' => $request->pais_es,
            'pais_ca' => $request->pais_ca,
            'pais_en' => $request->pais_en,
            'genere_es' => $request->genere_es,
            'genere_ca' => $request->genere_ca,
            'genere_en' => $request->genere_en,
            'data' => $request->data,
            'director' => $request->director,
            'url' => $request->url,
        ]);

        return redirect('/');
    }


    public function edit($id)
    {
        $pelicula = Pelicules::findOrFail($id);
        return view('editarPelicula', compact('pelicula'));
    }


    public function update(Request $request, $id)
{
    $pelicula = Pelicules::findOrFail($id);

    $request->validate([
        'duracio' => 'required|string',
        'titul_es' => 'required|string',
        'titul_ca' => 'required|string',
        'titul_en' => 'required|string',
        'descripció_es' => 'required|string',
        'descripció_ca' => 'required|string',
        'descripció_en' => 'required|string',
        'genere_es' => 'required|string',
        'genere_ca' => 'required|string',
        'genere_en' => 'required|string',
        'data' => 'required|date',
        'director' => 'required|string',
        'pais_es' => 'required|string',
        'pais_ca' => 'required|string',
        'pais_en' => 'required|string',
        'url' => 'required|url',
    ]);

    $pelicula->update($request->all());

    return redirect()->route('infofilms',$pelicula);
}


public function eliminar($id)
{
    $pelicula = Pelicules::find($id);

    if ($pelicula) {
        // Eliminar la película
        $pelicula->delete();
        return redirect('/')->with('success', 'Película eliminada con éxito.');
    }

    return redirect('/')->with('error', 'La película no existe.');
}







}
