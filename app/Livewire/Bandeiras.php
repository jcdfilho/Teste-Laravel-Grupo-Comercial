<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GrupoEconomico;
use App\Models\Bandeira; 

class Bandeiras extends Component
{
    public $nome;
    public $grupo_economico_id = '';
    public $grupos;

    public $bandeiraId = null;

    public function edit($id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $this->bandeiraId = $id;
        $this->nome = $bandeira->nome;
        $this->grupo_economico_id = $bandeira->grupo_economico_id;
    }

    public function cancelEdit()
    {
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nome = '';
        $this->bandeiraId = null;
        $this->grupo_economico_id = null;
    }

    public function delete($id)
    {
        Bandeira::find($id)?->delete();
    }

    public function mount()
    {
        $this->grupos = GrupoEconomico::all();
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|string|min:3',
        ]);
        
        if ($this->bandeiraId) {
            $bandeira = Bandeira::find($this->bandeiraId);
            $bandeira->update([
                'nome' => $this->nome,
                'grupo_economico_id' => $this->grupo_economico_id, 
            ]);
        } else {
            $this->validate([
                'grupo_economico_id' => 'required|exists:grupos_economicos,id',
            ]);

            Bandeira::create([
                'nome' => $this->nome,
                'grupo_economico_id' => $this->grupo_economico_id,
            ]);
        }

        $this->resetInputFields();
    }

    public function render()
    {
        $bandeiras = Bandeira::with('grupoEconomico')->paginate(10);

        return view('livewire.bandeiras', [
            'bandeiras' => $bandeiras
        ]);
    }


}
