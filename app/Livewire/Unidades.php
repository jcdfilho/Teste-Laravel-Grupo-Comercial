<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Unidade;
use App\Models\Bandeira;

class Unidades extends Component
{
    public $nome_fantasia;
    public $razao_social;
    public $cnpj;
    public $bandeira_id = '';
    public $bandeiras;

    public $unidadeId = null;

    public function edit($id)
    {
        $unidade = Unidade::findOrFail($id);
        $this->unidadeId = $id;
        $this->nome_fantasia = $unidade->nome_fantasia;
        $this->razao_social = $unidade->razao_social;
        $this->cnpj = $unidade->cnpj;
        $this->bandeira_id = $unidade->bandeira_id;
    }

    public function cancelEdit()
    {
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nome_fantasia = '';
        $this->razao_social = '';
        $this->cnpj = '';
        $this->unidadeId = null;
        $this->bandeira_id = null;
    }

    public function delete($id)
    {
        Unidade::find($id)?->delete();
    }

    public function mount()
    {
        $this->bandeiras = Bandeira::all();
    }

    public function save()
    {
        $this->validate([
            'nome_fantasia' => 'required|string|min:3',
            'razao_social' => 'required|string|min:3',
        ]);        
        
        if ($this->unidadeId) {
            $unidade = Unidade::find($this->unidadeId);
            $unidade->update([
                'nome_fantasia' => $this->nome_fantasia,
                'razao_social' => $this->razao_social,
                'cnpj' => $this->cnpj,
                'bandeira_id' => $this->bandeira_id,
            ]);            
        } else {
            $this->validate([
                'bandeira_id' => 'required|exists:bandeiras,id',
            ]);

            Unidade::create([
                'nome_fantasia' => $this->nome_fantasia,
                'razao_social' => $this->razao_social,
                'cnpj' => $this->cnpj,
                'bandeira_id' => $this->bandeira_id,
            ]);
        }

        $this->resetInputFields();
    }

    public function render()
    {
        $unidades = Unidade::with('bandeira')->get();
        return view('livewire.unidades', [
            'unidades' => $unidades
        ]);
    }

}