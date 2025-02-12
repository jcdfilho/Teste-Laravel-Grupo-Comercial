<?php

namespace App\Exports;

use App\Models\GrupoEconomico;
use Maatwebsite\Excel\Concerns\FromCollection;

class GrupoEconomicoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GrupoEconomico::all();
    }
}
