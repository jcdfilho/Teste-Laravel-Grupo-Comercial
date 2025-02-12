<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GrupoEconomico; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GrupoEconomicoExport;


class GruposEconomicos extends Component
{
    public $byGrupo = null;
    public $orderBy = 'nome';
    public $sortBy = 'asc';
    public $perPage = 5;

    public $nome = '';
    public $search;
    public $grupoId = null;

    public function edit($id)
    {
        $grupo = GrupoEconomico::findOrFail($id);
        $this->grupoId = $id;
        $this->nome = $grupo->nome;
    }

    public function cancelEdit()
    {
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nome = '';
        $this->grupoId = null;
    }

    public function delete($id)
    {
        GrupoEconomico::find($id)?->delete();
    }

    public function render()
    {
        return view('livewire.grupos-economicos', [
            'grupos' => GrupoEconomico::when($this->byGrupo, function($query){
                                    $query->where('id', $this->byGrupo);
                                })
                                ->when($this->search, function ($query) {
                                    $query->search(trim($this->search));
                                })
                                ->orderBy($this->orderBy, $this->sortBy)
                                ->paginate($this->perPage)
                                        ]);
    }

    public function exportToExcel()
    {
        return Excel::download(new GrupoEconomicoExport, 'grupos_economicos.xlsx');
    }
    
    public function save()
    {
        $this->validate([
            'nome' => 'required|max:100',
        ]);

        if ($this->grupoId) {
            // Atualiza o grupo econômico existente
            $grupo = GrupoEconomico::find($this->grupoId);
            $grupo->update(['nome' => $this->nome]);
        } else {
            // Cria um novo grupo econômico
            GrupoEconomico::create(['nome' => $this->nome]);
        }

        $this->resetInputFields();
    }
    
}
