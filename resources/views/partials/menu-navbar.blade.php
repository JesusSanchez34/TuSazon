<!-- Barra de navegación -->
<div class="navbar">
    <!-- Logo del restaurante (enlace al menú digital) -->
    <a href="{{ route('menu.index') }}" class="navbar-logo">
        <img src="{{ asset('build/assets/images/logo.jpeg') }}" alt="Logo Marisquería Cocos Locos" class="logo-img">
    </a>

    <h3>Menú Digital - Marisquería Cocos Locos</h3>

    <div class="navbar-buttons">
        <!-- Botón de Encuesta -->
        <a href="{{ route('encuesta') }}" class="btn btn-primary">
            <i class="fas fa-poll"></i> Encuesta
        </a>

        <!-- Botón de Iniciar Sesión -->
        @auth
            <!-- Si el usuario está autenticado, mostrar un enlace al dashboard -->
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        @else
            <!-- Si el usuario no está autenticado, mostrar el botón de Iniciar Sesión -->
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
        @endauth

        <!-- Botón del carrito -->
        <a href="{{ route('menu.cart') }}" class="btn btn-primary">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count" class="cart-count">{{ count(Session::get('cart', [])) }}</span>
        </a>
    </div>
</div>