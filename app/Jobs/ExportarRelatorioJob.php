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
use Illuminate\Support\Facades\Log;


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
        $directory = storage_path('app/public/relatorios');
        $filename = 'relatorio_' . now()->format('YmdHis') . '.xlsx'; 

        Log::info("Iniciando a geração do relatório: {$filename}");

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
            Log::info("Diretório de relatórios criado: {$directory}");
        }

        Excel::store(new ColaboradoresExport(
            $this->parametros['unidade_id'], 
            $this->parametros['bandeira_id'], 
            $this->parametros['grupo_economico_id'], 
            $this->parametros['search']
        ), 'relatorios/' . $filename, 'public'); 

        Log::info("Relatório gerado com sucesso: {$filename}");

        
        $usuario = User::find($this->usuarioId);
        if ($usuario) {
            Log::info("Usuário encontrado: {$usuario->email}");
            $usuario->notify(new RelatorioExportado('relatorios/' . $filename));
            Log::info("Notificação de exportação enviada para o usuário: {$usuario->email}");
        } else {
            Log::error("Usuário não encontrado com o ID: {$this->usuarioId}");
        }

    }

}
