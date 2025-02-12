<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromCollection;

class ColaboradoresExport implements FromCollection
{
    private $unidade_id;
    private $bandeira_id;
    private $grupo_economico_id;
    private $search;

    public function __construct($unidade_id = null, $bandeira_id = null, $grupo_economico_id = null, $search = null)
    {
        $this->unidade_id = $unidade_id;
        $this->bandeira_id = $bandeira_id;
        $this->grupo_economico_id = $grupo_economico_id;
        $this->search = $search;
    }

    public function collection()
    {
        $query = Colaborador::query()
            ->with([
                'unidade.bandeira.grupoEconomico', // Carregando os relacionamentos
            ]);

        // Filtrando os dados conforme os parâmetros
        if ($this->unidade_id) {
            $query->where('unidade_id', $this->unidade_id);
        }
        if ($this->bandeira_id) {
            $query->whereHas('unidade', fn($q) => $q->where('bandeira_id', $this->bandeira_id));
        }
        if ($this->grupo_economico_id) {
            $query->whereHas('unidade.bandeira', fn($q) => $q->where('grupo_economico_id', $this->grupo_economico_id));
        }

        if ($this->search) {
            $query->where(fn($q) => $q->where('nome', 'like', "%{$this->search}%")->orWhere('cpf', 'like', "%{$this->search}%"));
        }

        // Selecionando as colunas necessárias, incluindo as relacionadas
        $colaboradores = $query->select('nome', 'email', 'cpf', 'unidade_id')->get();

        // Transformando os dados para incluir informações de unidade, bandeira e grupo econômico
        $data = $colaboradores->map(function($colaborador) {
            return [
                'Nome' => $colaborador->nome,
                'Email' => $colaborador->email,
                'CPF' => $colaborador->cpf,
                'Unidade' => $colaborador->unidade->nome_fantasia,
                'Bandeira' => $colaborador->unidade->bandeira->nome,
                'Grupo Econômico' => $colaborador->unidade->bandeira->grupoEconomico->nome, 
            ];
        });

        // Inserir o cabeçalho no início dos dados
        $header = [
            'Nome', 
            'Email', 
            'CPF', 
            'Unidade', 
            'Bandeira', 
            'Grupo Econômico'
        ];

        // Adicionando o cabeçalho à primeira linha do arquivo Excel
        return collect([$header])->merge($data);
    }
}
