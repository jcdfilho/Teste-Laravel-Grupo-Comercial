<?php

use App\Livewire\GruposEconomicos;
use App\Livewire\Bandeiras;
use App\Livewire\Colaboradores;
use App\Livewire\Unidades;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Http\Controllers\AuditController;
use App\Livewire\RelatorioColaboradores;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ColaboradorController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/logout', function () {
    return redirect('/login');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');

Route::get('/grupos-economicos', GruposEconomicos::class)->name('grupos-economicos');
Route::get('/bandeiras', Bandeiras::class)->name('bandeiras');
Route::get('/unidades', Unidades::class)->name('unidades');
Route::get('/colaboradores', Colaboradores::class)->name('colaboradores');
Route::get('/relatorio-colaboradores', RelatorioColaboradores::class)->name('relatorio-colaboradores');
Route::get('/auditoria', [AuditController::class, 'index'])->name('auditoria');

Route::resource('grupos', GrupoEconomicoController::class);
Route::resource('bandeira', BandeiraController::class);
Route::resource('unidade', UnidadeController::class);
Route::resource('colaborador', ColaboradorController::class);