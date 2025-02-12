<?php

namespace App\Http\Controllers;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::with('user')->latest()->paginate(10);

        // Traduzindo os eventos
        foreach ($audits as $audit) {
            switch ($audit->event) {
                case 'created':
                    $audit->event = 'Criado';
                    break;
                case 'updated':
                    $audit->event = 'Atualizado';
                    break;
                case 'deleted':
                    $audit->event = 'Excluído';
                    break;
            }
        }

        return view('livewire.auditoria', compact('audits'));
    }

}