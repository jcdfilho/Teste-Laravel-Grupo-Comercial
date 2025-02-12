<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Notifications\RelatorioExportado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ColaboradoresExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportarRelatorioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $parametros;
    protected $usuarioId;

    public function __construct($parametros, $usuarioId)
    {
        $this->parametros = $parametros;
        $this->usuarioId = $usuarioId;
    }

    public function handle()
    {
        // Gera o arquivo do relatório
        $directory = storage_path('app/relatorios');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        Excel::store(new ColaboradoresExport(
            $this->parametros['unidade_id'], 
            $this->parametros['bandeira_id'], 
            $this->parametros['grupo_economico_id'], 
            $this->parametros['search']
        ), $directory, 'local');

        // Recupera o usuário e envia a notificação
        $usuario = User::find($this->usuarioId);
        if ($usuario) {
            $usuario->notify(new RelatorioExportado($directory));
        }
    }
}
