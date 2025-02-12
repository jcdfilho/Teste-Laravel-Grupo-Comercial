<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function index()
    {
        $colaboradores = Colaborador::all();
        return view('colaboradores.index', compact('colaboradores'));
    }

    public function create()
    {
        $unidades = Unidade::all();
        return view('colaboradores.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'unidade_id' => 'required|exists:unidades,id',
        ]);

        Colaborador::create($request->all());

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador criado com sucesso!');
    }

    public function show(Colaborador $colaborador)
    {
        return view('colaboradores.show', compact('colaborador'));
    }

    public function edit(Colaborador $colaborador)
    {
        $unidades = Unidade::all();
        return view('colaboradores.edit', compact('colaborador', 'unidades'));
    }

    public function update(Request $request, Colaborador $colaborador)
    {
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'unidade_id' => 'required|exists:unidades,id',
        ]);

        $colaborador->update($request->all());

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador atualizado com sucesso!');
    }

    public function destroy(Colaborador $colaborador)
    {
        $colaborador->delete();

        if (request()->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador deletado com sucesso!');
    }
}
