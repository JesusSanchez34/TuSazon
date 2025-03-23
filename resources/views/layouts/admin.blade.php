<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tu Sazón</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0a3d62; /* Azul marino */
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .sidebar ul li a:hover {
            color: #48dbfb; /* Azul claro */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h4 {
            margin: 0;
            color: #0a3d62; /* Azul marino */
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar .admin-info {
            display: flex;
            align-items: center;
        }
        .navbar .admin-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #0a3d62; /* Azul marino */
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 15px;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #48dbfb; /* Azul claro */
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0abde3; /* Azul más oscuro */
        }

        .btn-toggle {
    border: none;
    border-radius: 10px;
    padding: 10px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    color: white;
}

.btn-toggle.active {
    background-color: #28a745; /* Verde */
}

.btn-toggle.inactive {
    background-color: #dc3545; /* Rojo */
    
}
.btn-add { background-color: #28a745; color: white; }
.btn-edit { background-color: #ffc107; color: black; }
.btn-delete { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <!-- Barra lateral -->
    @include('partials.sidebar')

    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Barra superior -->
        @include('partials.navbar')

        <!-- Contenido dinámico -->
        @yield('content')
        <!-- Scripts -->
    @yield('scripts')
    @stack('scripts')

    </div>

   

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>