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
        
        <!-- Resumo de Entidades -->
        <div class="row my-4">
            <!-- Total de Grupos Econômicos -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Total de Grupos Econômicos</h5>
                        <p>{{ $totalGrupos }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Total de Bandeiras -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Total de Bandeiras</h5>
                        <p>{{ $totalBandeiras }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Unidades -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Total de Unidades</h5>
                        <p>{{ $totalUnidades }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Colaboradores -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Total de Colaboradores</h5>
                        <p>{{ $totalColaboradores }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico -->
        <div class="row my-4">
            <div class="col-md-4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resumo do Sistema</h5>
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('dashboardChart').getContext('2d');

        // Pegando os dados passados pelo Laravel e convertendo em JSON no JavaScript
        var dados = JSON.parse('{!! $dadosJson !!}');

        var dashboardChart = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico (pode ser 'bar', 'line', 'pie', etc.)
            data: {
                labels: Object.keys(dados), // Nomes das categorias
                datasets: [{
                    label: 'Quantidade',
                    data: Object.values(dados), // Valores correspondentes
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'], // Cores
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>