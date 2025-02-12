<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Colaborador;
use App\Models\Unidade;

class Colaboradores extends Component
{
    public $nome;
    public $email;
    public $cpf;
    public $unidade_id = '';
    public $unidades;

    public $colaboradorId = null;

    public function edit($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $this->colaboradorId = $id;
        $this->nome = $colaborador->nome;
        $this->email = $colaborador->email;
        $this->cpf = $colaborador->cpf;
        $this->unidade_id = $colaborador->unidade_id;
    }

    public function cancelEdit()
    {
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nome = '';
        $this->email = '';
        $this->cpf = '';
        $this->colaboradorId = null;
        $this->unidade_id = null;
    }

    public function delete($id)
    {
        Colaborador::find($id)?->delete();
    }

    public function mount()
    {
        $this->unidades = Unidade::all();
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|string|min:3',
            'email' => 'required|string|min:3',
        ]);       
        
        if ($this->colaboradorId) {
            $colaborador = Colaborador::find($this->colaboradorId);
            $colaborador->update([
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unidade_id' => $this->unidade_id,
            ]);            
        } else {
            $this->validate([
                'unidade_id' => 'required|exists:unidades,id',
            ]);

            Colaborador::create([
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unidade_id' => $this->unidade_id,
            ]);
        }

        $this->resetInputFields();
    }

    public function render()
    {
        $colaboradores = Colaborador::with('unidade')->get();
        return view('livewire.colaboradores', [
            'colaboradores' => $colaboradores
        ]);
    }

}