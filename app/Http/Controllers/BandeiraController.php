<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class BandeiraController extends Controller
{
    public function index()
    {
        $bandeiras = Bandeira::all();
        return view('bandeiras.index', compact('bandeiras'));
    }

    public function create()
    {
        $grupos = GrupoEconomico::all();
        return view('bandeiras.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id',
        ]);

        Bandeira::create($request->all());

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira criada com sucesso!');
    }

    public function show(Bandeira $bandeira)
    {
        return view('bandeiras.show', compact('bandeira'));
    }

    public function edit(Bandeira $bandeira)
    {
        $grupos = GrupoEconomico::all();
        return view('bandeiras.edit', compact('bandeira', 'grupos'));
    }

    public function update(Request $request, Bandeira $bandeira)
    {
        $request->validate([
            'nome' => 'required|string',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id',
        ]);

        $bandeira->update($request->all());

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira atualizada com sucesso!');
    }

    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();

        if (request()->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira deletada com sucesso!');
    }

}
