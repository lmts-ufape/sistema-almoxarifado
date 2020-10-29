<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Http\Requests\StoreMaterial;
use App\material;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estoques = Estoque::all();
        $materials = material::all();

        return view('material.material_consult', ['materials' => $materials, 'estoques' => $estoques]);
    }

    public function indexEdit(){

        $materials = material::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterial $request)
    {
        $validatedData = $request->validated();

        $material = material::create($validatedData);
        $material->save();

        return redirect(route('material.indexEdit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('material.material_edit', ['material' => material::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMaterial $request, $id)
    {
        $material = material::findOrFail($id);
        $validatedData = $request->validated();

        $material->fill($validatedData);
        $material->save();
        return redirect()->route('material.material_index_edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        material::destroy($id);

        return redirect()->route('material.index');
    }
}
