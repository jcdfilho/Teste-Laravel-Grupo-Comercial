<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white vh-100 position-fixed d-flex flex-column p-3 transition-all" style="width: 250px;">
        <button id="toggleSidebar" class="btn btn-outline-light mb-3">
            <i class="bi bi-list"></i>
        </button>
        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white">
                    <i class="bi bi-house-door"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('grupos-economicos') }}" class="nav-link text-white">
                    <i class="bi bi-briefcase"></i> <span>Grupos Econômicos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bandeiras') }}" class="nav-link text-white">
                    <i class="bi bi-building"></i> <span>Bandeiras</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('unidades') }}" class="nav-link text-white">
                    <i class="bi bi-geo-alt"></i> <span>Unidades</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('colaboradores') }}" class="nav-link text-white">
                    <i class="bi bi-people"></i> <span>Colaboradores</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('auditoria') }}" class="nav-link text-white">
                    <i class="bi bi-clipboard-data"></i> <span>Auditoria</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('relatorio-colaboradores') }}" class="nav-link text-white">
                    <i class="bi bi-bar-chart"></i> <span>Relatórios</span>
                </a>
            </li>
        </ul>
        
        <div class="user-menu" id="userMenu">
            <div style="display: flex; align-items: center; gap: 8px;">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                    class="rounded-circle" width="32" height="32">
                <span>{{ Auth::user()->name }}</span>
                <span class="arrow">⬆️</span>
            </div>
            
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="{{ route('profile.show') }}">👤 Meu Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">🚪 Sair</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div id="main-content" class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm p-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Colaboradores</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input wire:model="nome" type="text" class="form-control" id="nome" placeholder="Digite o nome do Colaborador">
                                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input wire:model="email" type="text" class="form-control" id="email" placeholder="Digite o email do colaborador">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input wire:model="cpf" type="text" class="form-control" id="cpf" placeholder="Digite o CPF">
                                @error('cpf') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            @if(!$colaboradorId)
                                <div class="mb-3">
                                    <label for="unidade" class="form-label">Unidade</label>
                                    <select wire:model="unidade_id" class="form-control" id="unidade">
                                        <option value="">Selecione uma unidade</option>
                                        @foreach($unidades as $unidade)
                                            <option value="{{ $unidade->id }}">{{ $unidade->cnpj }} - {{ $unidade->nome_fantasia }}</option>
                                        @endforeach
                                    </select>
                                    @error('unidade_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success">{{ $colaboradorId ? 'Atualizar Colaborador' : 'Criar Colaborador' }}</button>
                        </form>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-outline-primary" wire:click="exportToExcel">🗒️ Exportar para Excel</button>
                </div>
                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Relatório de Colaboradores</h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Unidade</th>
                                <th>Criado em</th>
                                <th>Atualizado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($colaboradores as $colaborador)
                                <tr>
                                    <td>
                                        {{ $colaborador->id }}
                                    </td>
                                    <td>
                                        @if($colaboradorId === $colaborador->id)
                                            <input wire:model="nome" type="text" class="form-control">
                                        @else
                                            {{ $colaborador->nome }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($colaboradorId === $colaborador->id)
                                            <input wire:model="email" type="text" class="form-control">
                                        @else
                                            {{ $colaborador->email }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($colaboradorId === $colaborador->id)
                                            <input wire:model="cpf" type="text" class="form-control">
                                        @else
                                            {{ $colaborador->cpf }}
                                        @endif
                                    </td>
                                    <td>{{ $colaborador->unidade ? $colaborador->unidade->nome_fantasia : 'Sem Unidade' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($colaborador->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($colaborador->updated_at)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($colaboradorId === $colaborador->id)
                                            <button wire:click="save" class="btn btn-success btn-sm">Salvar</button>
                                            <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancelar</button>
                                        @else
                                            <button wire:click="edit({{ $colaborador->id }})" class="btn btn-warning btn-sm">Editar</button>
                                            <button wire:click="delete({{ $colaborador->id }})" class="btn btn-danger btn-sm">Excluir</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>