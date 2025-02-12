<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        $bandeiras = Bandeira::all();
        return view('unidades.create', compact('bandeiras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_fantasia' => 'required|string',
            'razao_social' => 'required|string',
            'cnpj' => 'required|string',
            'bandeira_id' => 'required|exists:bandeiras,id',
        ]);

        Unidade::create($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }

    public function show(Unidade $unidade)
    {
        return view('unidades.show', compact('unidade'));
    }

    public function edit(Unidade $unidade)
    {
        $bandeiras = Bandeira::all();
        return view('unidades.edit', compact('unidade', 'bandeiras'));
    }

    public function update(Request $request, Unidade $unidade)
    {
        $validatedData = $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14', 
            'bandeira_id' => 'required|exists:bandeiras,id', 
        ]);

        $unidade->update($validatedData);

        if ($request->wantsJson()) {
            return response()->json($unidade, 200);
        }

        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
    }


    public function destroy(Unidade $unidade)
    {
        $unidade->delete();

        if (request()->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect()->route('unidades.index')->with('success', 'Unidade deletada com sucesso!');
    }

}
