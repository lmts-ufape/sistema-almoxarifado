<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;
use App\Estoque;

class DepositoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $depositos = new Deposito();
        $depositos = $depositos->all();
        $estoques = Estoque::all();

        return view('deposito.deposito', compact('depositos','estoques'));
    }

    public function getEstoques($deposito_id){

        $allEstoques = Estoque::all();
        $estoques = $allEstoques->where('deposito_id', $deposito_id);
        return response()->json($estoques);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('deposito.criarDeposito');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // $isValido = $request->validate([
        //     'nome' => 'require|'
        // ]);

        $deposito = new Deposito();
        $deposito->nome = $request->nome;
        $deposito->codigo = $request->codigo;

        $deposito->save();

        return redirect('deposito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
