<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AppBook')</title>

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados opcionales -->
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        
        <a class="navbar-brand" href="{{ route('home') }}">AppBook</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Menú izquierdo -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog') }}">Catálogo</a>
                </li>

                @if(session()->has('user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Mi Perfil</a>
                    </li>
                @endif

                @if(session()->has('user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my.favorites') }}">Mis Favoritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reviews.my') }}">Mis Reseñas</a>
                    </li>
                @endif

                @if(session()->has('user') && session('user')->is_admin)
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">
                                Administrador
                            </a>
                        </li>
                @endif

            </ul>

            <!-- Menú derecho -->
            <ul class="navbar-nav ms-auto">

                @if(!Session::has('user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endif

                @if(Session::has('user'))
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">Cerrar sesión</button>
                        </form>
                    </li>
                @endif

            </ul>

        </div>

    </div>
</nav>



    <!-- Contenido dinámico -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        &copy; {{ date('Y') }} AppBook - Tu librería en línea
    </footer>

    <!-- JS de Bootstrap (bundle con Popper incluido) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
