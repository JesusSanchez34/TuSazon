<!-- Sidebar -->
<div class="sidebar">
    <h3>Tu Sazón Cuenta</h3>
    <ul>
        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-list"></i> Gestion de Categorías</a></li>
        <li><a href="{{ route('admin.platillos.index') }}"><i class="fas fa-utensils"></i> Gestión de Menú</a></li>
        <li><a href="{{ route('admin.promociones.index') }}"><i class="fas fa-tags"></i> Gestión de Promociones</a></li>
        <li><a href="{{ route('admin.orders.index') }}"><i class="fas fa-clipboard-list"></i> Pedidos</a></li>
        <li><a href="{{ route('admin.reportes.index') }}"><i class="fas fa-chart-bar"></i> Reportes</a></li>
        <li><a href="{{ route('admin.configuracion.index') }}"><i class="fas fa-cog"></i> Configuración</a></li>
        <li><a href="{{ route('menu.index') }}"><i class="fas fa-home"></i> Menú Principal</a></li>
        
    </ul>
</div>
