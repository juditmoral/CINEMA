<?php

namespace App\Http\Controllers;

use App\Models\Entrades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntradesController extends Controller
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
     * @param  \App\Models\Entrades  $entrades
     * @return \Illuminate\Http\Response
     */
    public function show(Entrades $entrades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entrades  $entrades
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrades $entrades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrades  $entrades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrades $entrades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrades  $entrades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrades $entrades)
    {
        //
    }

    public function processPayment(Request $request)
    {

        $selectedSeats = json_decode($request->input('selectedSeats'), true);

        if (!is_array($selectedSeats)) {
            return back()->withErrors(['selectedSeats' => 'Els seients seleccionats no són vàlids.']);
        }

        $usuariId = Auth::id();

        $funcioId = $request->input('funcio_id');

        $count=0;

        foreach ($selectedSeats as $seat) {
            Entrades::create([
                'funcio_id' => $funcioId,
                'seient_id' => $seat['id'],
                'users_id' => $usuariId, // Guardem l'ID de l'usuari
            ]);

            $count++;
        }

        return view('pagat', compact('count'));
    }
}
