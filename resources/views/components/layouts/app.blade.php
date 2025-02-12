<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @switch(Route::currentRouteName())
            @case('dashboard')
                Dashboard
                @break
            @case('grupos-economicos')
                Grupos Econômicos - Nome do Sistema
                @break
            @case('bandeiras')
                Bandeiras
                @break
            @case('unidades')
                Unidades
                @break
            @case('colaboradores')
                Colaboradores
                @break
            @case('relatorio-colaboradores')
                Relatório de Colaboradores
                @break
            @default
                Nome Padrão
        @endswitch
    </title>
    <link rel="icon" href="{{ asset('image/favicon-32x32.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container">
        @if(Route::currentRouteName() == 'dashboard')
            <livewire:dashboard />
        @elseif(Route::currentRouteName() == 'grupos-economicos')
            <livewire:grupos-economicos />
        @elseif(Route::currentRouteName() == 'bandeiras')
            <livewire:bandeiras />
        @elseif(Route::currentRouteName() == 'unidades')
            <livewire:unidades />
        @elseif(Route::currentRouteName() == 'colaboradores')
            <livewire:colaboradores />
        @elseif(Route::currentRouteName() == 'relatorio-colaboradores')
            <livewire:relatorio-colaboradores />
        @endif
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
