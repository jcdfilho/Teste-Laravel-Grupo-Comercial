<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Colaborador extends Model implements Auditable
{
    use HasFactory;
    use AuditingTrait;
    use RefreshDatabase;

    protected $fillable = ['nome', 'email', 'cpf', 'unidade_id'];
    protected $table='colaboradores';

    // Teste unitário Colaborador
    public function teste_colaborador()
    {
        $this->expectException(ValidationException::class);

        $colaborador = new Colaborador([
            'cpf' => '12345657',
            'nome' => 'Colaborador Teste',
            'email' => 'teste.teste.com',
        ]);

        $colaborador->save();
    }


    // Modelo Colaborador
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    // Modelo Unidade
    public function bandeira()
    {
        return $this->belongsTo(Bandeira::class);
    }

    // Modelo Bandeira
    public function grupoEconomico()
    {
        return $this->belongsTo(GrupoEconomico::class);
    }

}
