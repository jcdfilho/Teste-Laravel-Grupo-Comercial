<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Unidade extends Model implements Auditable
{
    use HasFactory;
    use AuditingTrait;
    use RefreshDatabase;

    protected $fillable = ['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id'];
    protected $table='unidades';

    // Teste unitário Unidade
    public function teste_unidade()
    {
        $this->expectException(ValidationException::class);

        $unidade = new Colaborador([
            'cnpj' => '123456574444',
            'nome_fantasia' => 'Unidade Teste',
            'razao_social' => 'Unidade Teste LTDA', 
        ]);

        $unidade->save();
    }

    public function bandeira()
    {
        return $this->belongsTo(Bandeira::class, 'bandeira_id','id');
    }
}
