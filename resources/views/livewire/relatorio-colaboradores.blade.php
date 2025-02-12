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
    <div class="flex-grow-1 p-4" style="margin-left: 250px;">
        <h2 class="text-lg font-semibold mb-4">Relatório de Colaboradores</h2>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @foreach(Auth::user()->unreadNotifications as $notification)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> {{ $notification->data['message'] }}
                <a href="{{ asset('storage/' . $notification->data['file_path']) }}" 
                    wire:click="markAsRead('{{ $notification->id }}')"
                    class="btn btn-success btn-sm" 
                    download>
                    Baixar Relatório
                </a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach


        <!-- Filtros -->
        <div class="grid grid-cols-4 gap-4 bg-gray-100 p-4 rounded-lg">
            <div>
                <label for="grupo_economico_id">Grupo Econômico:</label>
                <select id="grupo_economico_id" wire:model.live="grupo_economico_id" class="w-full p-2 border rounded">
                    <option value="">Todos</option>
                    @foreach($grupos_economicos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="bandeira_id">Bandeira:</label>
                <select id="bandeira_id" wire:model.live="bandeira_id" class="w-full p-2 border rounded">
                    <option value="">Todas</option>
                    @foreach($bandeiras as $bandeira)
                        <option value="{{ $bandeira->id }}">{{ $bandeira->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="unidade_id">Unidade:</label>
                <select id="unidade_id" wire:model.live="unidade_id" class="w-full p-2 border rounded">
                    <option value="">Todas</option>
                    @foreach($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nome_fantasia }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="search">Nome ou CPF:</label>
                <input id ="search" type="text" wire:model.live="search" class="w-full p-2 border rounded" placeholder="Buscar colaborador">
            </div>
        </div>

        <!-- Tabela -->
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">E-mail</th>
                    <th class="border p-2">CPF</th>
                    <th class="border p-2">Unidade</th>
                    <th class="border p-2">Bandeira</th>
                    <th class="border p-2">Grupo Econômico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colaboradores as $colaborador)
                    <tr class="border">
                        <td class="p-2">{{ $colaborador->nome }}</td>
                        <td class="p-2">{{ $colaborador->email }}</td>
                        <td class="p-2">{{ $colaborador->cpf }}</td>
                        <td class="p-2">{{ $colaborador->unidade->nome_fantasia }}</td>
                        <td class="p-2">{{ $colaborador->unidade->bandeira->nome }}</td>
                        <td class="p-2">{{ $colaborador->unidade->bandeira->grupoEconomico->nome }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $colaboradores->links() }}
        </div>

        <button wire:click="exportExcel" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
            Exportar para Excel
        </button>
    </div>
</div>