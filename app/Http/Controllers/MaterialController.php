<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Http\Requests\StoreMaterial;
use App\material;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estoques = Estoque::all()->sortByDesc('id');
        $materials = material::all()->sortByDesc('id');

        return view('material.material_consult', ['materials' => $materials, 'estoques' => $estoques]);
    }

    public function indexEdit()
    {

        $materials = material::all()->sortByDesc('id');
        return view('material.material_index_edit', ['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("material.material_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterial $request)
    {
        $validatedData = $request->validated();

        if (($request->hasFile('imagem') && $request->file('imagem')->isValid())) {

            $imgExtension = $request->imagem->extension();
            $imgName = Img::nameNewImage(material::all(), $request->nome, $imgExtension);

            $request->imagem->storeAs(Img::materiaisDir(), $imgName);
            $request->imagem = $imgName;

        }

        $data = [
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'descricao' => $request->descricao,
            'quantidade_minima' => $request->quantidade_minima,
            'imagem' => $request->imagem
        ];


        // $material = material::create($validatedData);
        // $material->save();

        $material = material::create($data);
        $material->save();

        return redirect(route('material.indexEdit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\material $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('material.material_edit', ['material' => material::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\material $material
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMaterial $request, $id)
    {
        $material = material::findOrFail($id);
        $validatedData = $request->validated();

        if (($request->hasFile('imagem') && $request->file('imagem')->isValid())) {

            $imgExtension = $request->imagem->extension();
            $imgName = Img::nameNewImage(material::all(), $request->nome, $imgExtension);

            $request->imagem->storeAs(Img::materiaisDir(), $imgName);
            $request->imagem = $imgName;
        }

        $data = [
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'descricao' => $request->descricao,
            'quantidade_minima' => $request->quantidade_minima,
            'imagem' => $request->imagem
        ];

        $material->fill($data);
        $material->save();
        return redirect()->route('material.indexEdit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\material $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = material::all()->find($id);
        $estoque = Estoque::all()->where('material_id', '=', $id)->first();
        if (empty($estoque)) {
            $material->forceDelete();
            return redirect()->route('material.indexEdit');
        } elseif ($estoque->quantidade == 0) {
            $estoque->delete();
            $material->delete();
            return redirect()->route('material.indexEdit');
        } else {
            return redirect()->back()->with('fail', 'Esse material não pode ser removido, ainda há material em estoque!');
        }

    }
}
