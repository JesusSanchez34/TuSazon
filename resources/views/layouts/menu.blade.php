<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Digital - Marisquería Cocos Locos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

     <!-- jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #0a3d62; /* Azul marino */
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar h3 {
            margin: 0;
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
        .card-img-top {
            border-radius: 15px 15px 0 0;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #0a3d62; /* Azul marino */
        }
        .card-text {
            color: #6c757d; /* Gris */
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
        .btn-add-to-cart {
            background-color: #28a745; /* Verde */
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            color: white;
        }
        .btn-add-to-cart:hover {
            background-color: #218838; /* Verde más oscuro */
        }
        .btn-survey {
            background-color: #ffc107; /* Amarillo */
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            color: white;
        }
        .btn-survey:hover {
            background-color: #e0a800; /* Amarillo más oscuro */
        }
        .form-select {
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
        }
        .alert {
            border-radius: 10px;
        }
        .cart-section {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .cart-button {
            background-color: #0a3d62; /* Azul marino */
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .cart-button:hover {
            background-color: #48dbfb; /* Azul claro */
        }
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545; /* Rojo */
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-select {
        border-radius: 20px;
        border: 2px solid #007bff;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        border-color: #0056b3;
    }

    option:hover {
        background-color: #007bff !important;
        color: white !important;
    }

    .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0a3d62; /* Azul marino */
    color: white;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.navbar h3 {
    margin: 0;
    font-size: 1.5rem;
}

.navbar-buttons {
    display: flex;
    gap: 10px; /* Espacio entre botones */
}

.navbar-buttons .btn {
    display: flex;
    align-items: center;
    gap: 5px; /* Espacio entre ícono y texto */
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
}

.navbar-buttons .btn-primary {
    background-color: #3e7df1; /* Azul claro */
    border: none;
}

.navbar-buttons .btn-primary:hover {
    background-color: #3f58aa; /* Azul más oscuro */
}

.cart-count {
    background-color: #ff4757; /* Rojo */
    color: white;
    padding: 2px 6px;
    border-radius: 50%;
    font-size: 0.8rem;
    margin-left: 5px;
}
.navbar-logo {
    display: flex;
    align-items: center;
}

.logo-img {
    height: 50px; /* Ajusta el tamaño según tu logo */
    width: auto;
    border-radius: 10px;
    margin-right: 15px;
}

    </style>
</head>
<body>
    <!-- Incluir la barra superior -->
    @include('partials.menu-navbar')

    <!-- Contenido principal -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Modal del carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="cart-items" class="list-group">
                    <!-- Aquí se mostrarán los platillos agregados -->
                </ul>
                <div class="mt-3">
                    <h5>Total: <span id="cart-total">$0.00</span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="checkout()">Realizar Pedido</button>
            </div>
        </div>
    </div>
</div>
    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Scripts personalizados -->
    @yield('scripts')
</body>
</html>