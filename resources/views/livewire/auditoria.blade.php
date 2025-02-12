<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoria</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        #sidebar {
            width: 250px;
            transition: width 0.3s ease-in-out;
            overflow: hidden;
            white-space: nowrap;
            position: fixed; 
            left: 0; 
        }

        #sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            transition: padding 0.3s ease-in-out;
        }

        #sidebar.collapsed {
            width: 70px;
        }

        #sidebar.collapsed .nav-link {
            justify-content: center;
        }

        #sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Esconde o nome e a seta quando o sidebar está colapsado */
        #sidebar.collapsed .user-menu span {
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Mantém apenas a imagem centralizada */
        #sidebar.collapsed .user-menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Ajusta a posição do dropdown para não quebrar ao colapsar */
        #sidebar.collapsed .dropdown-menu {
            position: absolute;
            right: 0;
            bottom: 40px;
            transform: translateX(50%); /* Centraliza corretamente */
        }

        .user-menu img {
            transition: width 0.3s ease-in-out, height 0.3s ease-in-out;
        }

        #main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }

        /*USUARIO*/

        /* Estilo do container do usuário */
        .user-menu {
            position: relative;
            display: inline-block;
            cursor: pointer;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        /* Estiliza o dropdown para manter posição correta */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #2c2c2c;
            min-width: 160px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            padding: 10px 0;
            z-index: 1000;
            right: 0;
            bottom: 40px; /* Para subir quando aberto */
            transition: left 0.3s ease-in-out, right 0.3s ease-in-out;
        }

        /* Estilizando os itens do menu */
        .dropdown-menu a, .dropdown-menu button {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border: none;
            width: 100%;
            text-align: left;
            background: none;
            font-size: 14px;
            cursor: pointer;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background-color: #444;
        }

        /* Ícone de seta */
        .arrow {
            font-size: 12px;
            margin-left: 5px;
            transition: transform 0.2s;
        }

        /* Girar seta para cima quando dropdown estiver aberto */
        .user-menu.active .arrow {
            transform: rotate(0deg); /* Normal */
        }

        /* Setinha padrão aponta para cima quando o menu estiver fechado */
        .arrow {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
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
    <div class="main-content" style="margin-left: 270px;">
        <h1 class="mb-2">Auditoria do Sistema</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Modelo</th>
                    <th>ID do Registro</th>
                    <th>Alterações</th>
                    <th>Data da Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audits as $audit)
                    <tr>
                        <td>{{ optional($audit->user)->name ?? 'Sistema' }}</td>
                        <td>{{ ucfirst($audit->event) }}</td>
                        <td>{{ class_basename($audit->auditable_type) }}</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <td>
                            <pre>{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre>
                        </td>
                        <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $audits->links() }}
    </div>

    
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            let sidebar = document.getElementById('sidebar');
            let content = document.getElementById('main-content');
            let userSpan = document.querySelector(".user-menu span"); // Nome do usuário
            let arrow = document.querySelector(".user-menu .arrow");  // Seta
            let userImage = document.querySelector(".user-menu img"); // Imagem do usuário
            let dropdown = document.getElementById("dropdownMenu"); // Dropdown

            if (sidebar.style.width === "70px") {
                // Expandindo
                sidebar.style.width = "250px";
                content.style.marginLeft = "250px";

                setTimeout(() => {
                    document.querySelectorAll("#sidebar .nav-link span").forEach(span => {
                        span.style.display = "inline";
                        span.style.opacity = "1";
                    });

                    if (userSpan) {
                        userSpan.style.display = "inline";
                        userSpan.style.opacity = "1";
                        userSpan.style.width = "auto";
                    }
                    if (arrow) {
                        arrow.style.display = "inline";
                        arrow.style.opacity = "1";
                    }
                    if (userImage) {
                        userImage.style.width = "32px";
                        userImage.style.height = "32px";
                    }

                    // Posição do dropdown no menu expandido
                    if (dropdown) {
                        dropdown.style.left = "auto";
                        dropdown.style.right = "0";
                    }
                }, 200);
            } else {
                // Colapsando
                sidebar.style.width = "70px";
                content.style.marginLeft = "70px";

                document.querySelectorAll("#sidebar .nav-link span").forEach(span => {
                    span.style.opacity = "0";
                    setTimeout(() => { span.style.display = "none"; }, 200);
                });

                if (userSpan) {
                    userSpan.style.opacity = "0";
                    userSpan.style.width = "0";
                    setTimeout(() => { userSpan.style.display = "none"; }, 200);
                }
                if (arrow) {
                    arrow.style.opacity = "0";
                    setTimeout(() => { arrow.style.display = "none"; }, 200);
                }
                if (userImage) {
                    userImage.style.width = "70px";
                    userImage.style.height = "70px";
                    userImage.css({"border-radius": "50%"});
                }

                // Posição do dropdown no menu colapsado
                if (dropdown) {
                    dropdown.style.left = "50px";  // Ajusta para ficar ao lado da imagem
                    dropdown.style.right = "auto";
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const userMenu = document.getElementById("userMenu");
            const dropdownMenu = document.getElementById("dropdownMenu");

            userMenu.addEventListener("click", function (event) {
                event.stopPropagation(); // Evita que o clique feche imediatamente
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
                userMenu.classList.toggle("active");
            });

            document.addEventListener("click", function (event) {
                if (!userMenu.contains(event.target)) {
                    dropdownMenu.style.display = "none";
                    userMenu.classList.remove("active");
                }
            });
        });
    </script>
</body>
</html>