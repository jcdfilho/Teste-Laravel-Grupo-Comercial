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
    <div id="main-content" class="container mt-5 ms-5" style="margin-left: 270px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Grupo Econômico</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <div class="mb-3">
                                <label for="nomegrupo" class="form-label">Nome do Grupo</label>
                                <input wire:model="nome" type="text" class="form-control" id="nomegrupo" placeholder="Digite o nome do grupo">
                                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Criar Grupo</button>
                        </form>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-outline-primary" wire:click="exportToExcel">🗒️ Exportar para Excel</button>
                </div>
                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Relatório de Grupos Econômicos</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <!-- <div class="mb-3">
                                <input wire:model.debounce.350ms="search" type="text" class="form-control" placeholder="Buscar grupos...">
                            </div> -->
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Criado em</th>
                                    <th>Atualizado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grupos as $grupo)
                                    <tr>
                                        <td>{{ $grupo->id }}</td>
                                        <td>
                                            @if($grupoId === $grupo->id)
                                                <input wire:model="nome" type="text" class="form-control">
                                            @else
                                                {{ $grupo->nome }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($grupo->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($grupo->updated_at)->format('d/m/Y') }}</td>
                                        <td>
                                            @if($grupoId === $grupo->id)
                                                <button wire:click="save" class="btn btn-success btn-sm">Salvar</button>
                                                <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancelar</button>
                                            @else
                                                <button wire:click="edit({{ $grupo->id }})" class="btn btn-warning btn-sm">Editar</button>
                                                <button wire:click="delete({{ $grupo->id }})" class="btn btn-danger btn-sm">Excluir</button>
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

