<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GrupoEconomico;
use App\Models\Bandeira;
use App\Models\Unidade;
use App\Models\Colaborador;

class Dashboard extends Component
{
    public $totalGrupos;
    public $totalBandeiras;
    public $totalUnidades;
    public $totalColaboradores;
    public $search = '';
    public $grupoSelecionado = null;

    protected $listeners = ['selectGrupo']; 

    public function selectGrupo($nomeGrupo)
    {
        dd('AAAAA');
        $this->grupoSelecionado = $nomeGrupo;
        $this->dispatch('grupoSelecionado', $nomeGrupo);
    }

    public function mount()
    {
        $this->totalGrupos = GrupoEconomico::count();
        $this->totalBandeiras = Bandeira::count();
        $this->totalUnidades = Unidade::count();
        $this->totalColaboradores = Colaborador::count();
    }

    public function render()
    {
        $dados = [
            'Grupos Econômicos' => GrupoEconomico::count(),
            'Bandeiras' => Bandeira::count(),
            'Unidades' => Unidade::count(),
            'Colaboradores' => Colaborador::count(),
        ];

        return view('livewire.dashboard', ['dadosJson' => json_encode($dados)]);
    }
}