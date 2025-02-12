<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;

class GrupoEconomico extends Model implements Auditable
{
    use HasFactory;
    use AuditingTrait;

    protected $fillable = ['nome'];
    protected $table='grupos_economicos';

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        return $query->where('nome', 'like', $term);
    }

}
