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

    <!-- Main Content -->
    <div id="main-content" class="flex-grow-1 p-4" style="transition: margin-left 0.3s; margin-left: 220px;">
        <h1>Dashboard</h1>
        <div class="row my-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Grupos Econômicos</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <table class="table">
                                <tbody>
                                    @foreach($grupos as $grupo)
                                    <tr class="grupo-row" style="cursor: pointer;" data-nome="{{ $grupo->nome }}">
                                        <td>{{ $grupo->nome }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </h5>
                    </div>
                </div>
                <div id="grupo-selecionado" class="mt-3">
                    <strong>Grupo Selecionado:</strong> Nenhum
                </div>
            </div>
        </div>
    </div>
</div>