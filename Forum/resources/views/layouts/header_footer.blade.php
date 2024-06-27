<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/masterIcon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title> CodeDentegler - Laravel </title>
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
                    toastr.success("{{ session('message-error') }}");

                    timeOut: 4000
                });
            </script>
        @endif
        <div class="navbar">
            <img class="Navbarlogo" src="{{ asset('images/logo.png') }}" id="btn-navbar">
            <div class="nav-search">
               <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="" id="" placeholder="Busque Topicos">
               </div> 
            </div>

            @if (Auth::check())
            <div class="Nav-Login">
                <a class="Nav-Enter" href="{{ route('listUserById', [Auth::user()->id]) }}" class="sidebar-user">
                            Meu Perfil
                </a>
                <a class="Nav-Enter" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-user">
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
                <i class="fas fa-times" id="close-btn"></i>
            </div>
            <div class="sidebar-content">
                <a href="{{ route('teste') }}"><i class="fa fa-home"></i> Início</a>
                <a href="{{ route('listAllUsers') }}"><i class="fa-solid fa-users"></i> Lista de usuários</a>

                <a href="#collapsePost" data-bs-toggle="collapse"><i class="fa-solid fa-comments"></i> Posts</a>
                <a class="collapse" id="collapsePost" href="{{ route('VizuPost') }}"><i
                        class="fa-solid fa-comments"></i> Ver Post</a>
                <a class="collapse" id="collapsePost" href="{{ route('createPost') }}"><i class="fa-solid fa-plus"></i>
                    Criar Posts</a>

                <a data-bs-toggle="collapse" href="#collapseTopicos"><i class="fa-solid fa-arrow-trend-up"></i>
                    Topicos</a>
                <a class="collapse" id="collapseTopicos" href="{{ route('TopicsAll')}}"><i class="fa-solid fa-arrow-trend-up"></i> Ver Topicos</a>
                <a class="collapse" id="collapseTopicos"><i class="fa-solid fa-plus"></i> Criar Topicos</a>

                <a href="#collapseTag" data-bs-toggle="collapse"><i class="fa-solid fa-hashtag"></i> Tags</a>
                <a class="collapse" id="collapseTag"><i class="fa-solid fa-hashtag"></i> Ver Tags</a>
                <a class="collapse" id="collapseTag"><i class="fa-solid fa-plus"></i> Criar Tags</a>
                
                @if (Auth::check())
                <a href="{{ route('listUserById', [Auth::user()->id]) }}" class="sidebar-user">
                        Meu Perfil
                    </a>
                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-user">
                        Sair
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="sidebar-user" href="register">Cadastre-se</a>
                    <a class="sidebar-user"href="login">Entrar</a>
                @endif

                <a href="settings"><i class="fa fa-cog"></i> Configurações</a>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; Filipe Fogaca Lopes</p>
        </div>
    </footer>

</body>

</html>
