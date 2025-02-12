<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Colaborador;
use App\Models\Unidade;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use App\Jobs\ExportarRelatorioJob;
use Illuminate\Support\Facades\Auth;

class RelatorioColaboradores extends Component
{
    use WithPagination;

    public $grupo_economico_id, $bandeira_id, $unidade_id, $search;

    protected $updatesQueryString = [
        'grupo_economico_id' => ['except' => ''],
        'bandeira_id' => ['except' => ''],
        'unidade_id' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updatedGrupoEconomicoId($value)
    {
        $this->bandeira_id = null;
        $this->unidade_id = null;
    }

    public function updatedBandeiraId($value)
    {
        $this->unidade_id = null;
    }

    public function render()
    {
        $query = Colaborador::query();

        // Filtrar por Grupo Econômico (através da Bandeira e Unidade)
        if ($this->grupo_economico_id) {
            $query->whereHas('unidade.bandeira', function ($q) {
                $q->where('grupo_economico_id', $this->grupo_economico_id);
            });
        }

        // Filtrar por Bandeira (através da Unidade)
        if ($this->bandeira_id) {
            $query->whereHas('unidade', function ($q) {
                $q->where('bandeira_id', $this->bandeira_id);
            });
        }

        // Filtrar por Unidade
        if ($this->unidade_id) {
            $query->where('unidade_id', $this->unidade_id);
        }

        // Busca por Nome ou CPF
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nome', 'like', "%{$this->search}%")
                ->orWhere('cpf', 'like', "%{$this->search}%");
            });
        }

        $colaboradores = $query->paginate(10);

        return view('livewire.relatorio-colaboradores', [
            'colaboradores' => $colaboradores,
            'grupos_economicos' => GrupoEconomico::all(),
            'bandeiras' => $this->grupo_economico_id ? Bandeira::where('grupo_economico_id', $this->grupo_economico_id)->get() : [],
            'unidades' => $this->bandeira_id ? Unidade::where('bandeira_id', $this->bandeira_id)->get() : [],
        ]);
    }

    public function exportExcel()
    {
        $parametros = [
            'unidade_id' => $this->unidade_id,
            'bandeira_id' => $this->bandeira_id,
            'grupo_economico_id' => $this->grupo_economico_id,
            'search' => $this->search
        ];
        
        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'Usuário não autenticado.');
            return;
        }

        ExportarRelatorioJob::dispatch($parametros, $user->id);

        session()->flash('success', 'A exportação foi iniciada. Você será notificado quando estiver pronta.');
    }

    public function markAsRead($notificationId)
    {
        $user = Auth::user();

        if ($user) {
            $notification = $user->unreadNotifications->find($notificationId);
            if ($notification) {
                $notification->markAsRead();
            }
        }
    }
}