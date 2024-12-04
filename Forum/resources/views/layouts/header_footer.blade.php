<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="css/btn.css">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">

    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>CodeDentegler - Laravel</title>
</head>

<body>

    <div id="app">
        @if (Session::has('message-sucess'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    toastr.success("{{ session('message-sucess') }}");
                    timeOut: 4000
                });
            </script>
        @elseif (Session::has('message-error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    toastr.error("{{ session('message-error') }}");
                    timeOut: 4000
                });
            </script>
        @endif
        <div class="navbar">
            <div class="nav-search">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="" id="" placeholder="Busque Topicos">
                </div>
            </div>

            @if (Auth::check())
            <div class="Nav-Login">
                <a href="{{ route('listUserById', [Auth::user()->id]) }}" class="sidebar-user">
                    <!-- Exibir foto de perfil no mini círculo -->
                    <img src="{{ Storage::url(Auth::user()->photo) }}" alt="Foto de Perfil" class="profile-pic">
                </a>
                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-user">
                        Sair
                    </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            @else
            <div class="Nav-Login">
                <a class="navbar-link" href="register">Cadastre-se</a>
                <a class="navbar-link" href="login">Entrar</a>
            </div>
            @endif
        </div>

        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <img class="Navbarlogo" src="{{ asset('images/logo.png') }}">
            </div>
            <div class="sidebar-content">
                <a href="{{ route('teste') }}"><i class="fa fa-home"></i> Início</a>

                <!-- Exibir apenas para administradores -->
                @if (Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('listAllUsers') }}"><i class="fa-solid fa-users"></i> Lista de usuários</a>
                @endif

                <a href="#collapseCategory" data-bs-toggle="collapse"><i class="fa-solid fa-icons"></i> Category</a>
                <div id="collapseCategory" class="collapse">
                    <a href="{{ route('listAllCategories') }}"><i class="fa-solid fa-icons"></i> Ver Categories</a>
                    <a href="{{ route('listCreateCategory') }}"><i class="fa-solid fa-plus"></i> Criar Categories</a>
                </div>

                <a href="#collapseTag" data-bs-toggle="collapse"><i class="fa-solid fa-icons"></i> Tag</a>
                <div id="collapseTag" class="collapse">
                    <a href="{{ route('listAllTags') }}"><i class="fa-solid fa-icons"></i> Ver Tags</a>
                </div>

                <a href="#collapseTopicos" data-bs-toggle="collapse"><i class="fa-solid fa-arrow-trend-up"></i> Tópicos</a>
                <div id="collapseTopicos" class="collapse">
                    <a href="{{ route('teste') }}"><i class="fa-solid fa-arrow-trend-up"></i> Ver Tópicos</a>

                    <a href="{{ route('createTopic') }}"><i class="fa-solid fa-plus"></i> Criar Tópico</a>

                        <!-- <a href="#" class="text-muted"><i class="fa-solid fa-ban"></i> Suspenso</a> -->

                </div>

                <a href="settings"><i class="fa fa-cog"></i> Configurações</a>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

</body>

</html>
