<!-- menu/index.blade.php -->
@extends('layouts.menu')


@section('content')
<div class="container">
    <h1>Menú de Platillos</h1>
    
     <!-- Selector de categorías -->
     <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('menu.index') }}" method="GET" id="categoryFilter">
                <select name="category" class="form-select" onchange="document.getElementById('categoryFilter').submit()">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <!-- Listado de Platillos -->
    <div class="row">
        @foreach ($platillos as $platillo)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($platillo->imagen)
                <img src="{{ asset('storage/' . $platillo->imagen) }}" class="card-img-top" alt="{{ $platillo->nombre }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $platillo->nombre }}</h5>
                    <p class="card-text">{{ $platillo->descripcion }}</p>
                    <p class="card-text"><strong>Precio: ${{ $platillo->precio }}</strong></p>
                    <p class="card-text"><strong>Categoría: {{ $platillo->category ? $platillo->category->nombre : 'Sin categoría' }}</strong></p>
                    <form class="add-to-cart-form" action="{{ route('menu.add-to-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="platillo_id" value="{{ $platillo->id }}">
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Función para actualizar el contador del carrito
    function updateCartCount() {
        $.ajax({
            url: '{{ route("menu.cart-count") }}',
            method: 'GET',
            success: function(response) {
                $('#cart-count').text(response.count); // Actualizar el contador
            },
            error: function(response) {
                console.error('Error al actualizar el contador del carrito:', response);
            }
        });
    }

    // Actualizar el carrito al agregar un platillo
    $(document).on('submit', '.add-to-cart-form', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response); // Depura la respuesta
                updateCartCount(); // Actualiza el contador del carrito
            },
            error: function(response) {
                alert('Error al agregar al carrito: ' + response.responseJSON.error);
            }
        });
    });

    // Actualizar el contador del carrito al cargar la página
    updateCartCount();
});
</script>
@endsection