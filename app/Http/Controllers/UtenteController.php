<?php

namespace App\Http\Controllers;

use App\CondivisioniUtenti;
use App\Utente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class UtenteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = $this->getValidatore($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        // $utente = Utente::create([
        //     'nickname' => $request->nickname,
        //     'password' => Hash::make($request->password),
        // ]);

        $utente = Utente::create([
            'nickname' => $request->nickname,
            'password' => $request->password,
        ]);

        $utente->save();

        return response()->json($utente->nickname, 200);

    }

    public function aggiungiAssociato(Request $request) {

        $associato = Utente::where('nickname', $request->nomeassociato)->get();

        if (isset($associato[0])) {

            $condiviso = CondivisioniUtenti::where('utente_id', $request->utente_id)->where('utente_associato_id', $associato[0]->id)->get();

            if (isset($condiviso[0])) {
                return response()->json("L' utente ".$request->nomeassociato. " può gia vedere la tua lista.", 500);
            } 

            $utente = Utente::find($request->utente_id);

            $associazione = new CondivisioniUtenti([
                'utente_associato_id' => $associato[0]->id,
            ]);

            $utente->condiviso()->save($associazione);
            return response()->json("L' utente ".$request->nomeassociato ." può vedere la tua lista", 200);


        } else {
            return response()->json("L' utente ". $request->nomeassociato ." non esite.", 404);

        }

    }

    public function rimuoviAssociato(Request $request) {



           $canc = CondivisioniUtenti::where('utente_id', $request->utente_id)->where('utente_associato_id', $request->utente_associato_id)->delete();

           if($canc == 0)
           return response()->json("L' utente non è stato trovato.", 404);
           else 
            return response()->json("L' utente non può più vedere la tua lista.", 200);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function show(Utente $utente) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function edit(Utente $utente) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utente $utente) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utente $utente) {
        //
    }

    public function getValidatore($request) {

        $validazione = array(
            'regole'   => array(
                'nickname' => 'required|unique:utentes,nickname',
                'password' => 'required',
            ),
            'messaggi' => array(
                'required' => 'Il campo :attribute è richiesto.',
                'unique'   => 'Questo :attribute è già stato usato.',
            ),
        );

        return Validator::make($request->all(), $validazione['regole'], $validazione['messaggi']);

    }

}
