<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class GrupoEconomicoController extends Controller
{
    public function index()
    {
        $grupos = GrupoEconomico::all();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
        ]);

        GrupoEconomico::create($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo Econômico criado com sucesso!');
    }

    public function show(GrupoEconomico $grupo)
    {
        return view('grupos.show', compact('grupo'));
    }

    public function edit(GrupoEconomico $grupo)
    {
        return view('grupos.edit', compact('grupo'));
    }

    public function update(Request $request, GrupoEconomico $grupo)
    {
        $request->validate([
            'nome' => 'required|string',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo Econômico atualizado com sucesso!');
    }

    public function destroy(GrupoEconomico $grupoEconomico)
    {
        $grupoEconomico->delete();

        if (request()->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect()->route('grupos-economicos.index')->with('success', 'Grupo Econômico deletado com sucesso!');
    }

}
