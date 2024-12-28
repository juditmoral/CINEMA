<?php

namespace App\Http\Controllers;

use App\Models\Pelicules;
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
    public function edit(Pelicules $pelicules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicules  $pelicules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicules $pelicules)
    {
        //
    }

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

}
