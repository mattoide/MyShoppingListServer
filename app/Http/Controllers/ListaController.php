<?php

namespace App\Http\Controllers;

use App\Lista;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Utente;

class ListaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        // $utente = Utente::where('nickname', $request->nickname)->where('password', Hash::make($request->password))->get();
        $utente = Utente::where('nickname', $request->nickname)->where('password', $request->password)->get();

        if(isset($utente[0]))
        return $lista = Lista::where('utente_id', $utente[0]->id)->get();
        else 
        return response()->json('Nickname o password errati.', 500); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $utente = Utente::find($request->utente_id);

        $elementi = [];
        foreach ($request->elementi as $elemento) {
            $elementi[] = new Lista([
                'nome' => ucfirst($elemento['nome']),
                'quantita' => $elemento['quantita']
            ]);
        }

        Lista::where('utente_id', $request->utente_id)->delete();
        $utente->lista()->saveMany($elementi);

        return response()->json("Lista aggiornata correttamente!", 200); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function show(Lista $lista) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function edit(Lista $lista) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lista $lista) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lista $lista) {
        //
    }
}
