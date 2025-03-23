@extends('layouts.menu')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>
    <ul class="list-group" id="cart-items">
    @if ($cartItems->count() > 0)
        @foreach ($cartItems as $item)
            <li class="list-group-item" id="cart-item-{{ $item->platillo_id }}">
                {{ $item->platillo->nombre }} - {{ $item->cantidad }} x ${{ $item->platillo->precio }}
                <button class="btn btn-danger btn-sm remove-from-cart" data-platillo-id="{{ $item->platillo_id }}">Eliminar</button>
            </li>
        @endforeach
    @else
        <li class="list-group-item">El carrito está vacío.</li>
    @endif
    </ul>
    <div class="mt-3">
        <h5>Total: ${{ $total }}</h5>
    </div>
    <div class="mt-3">
        <a href="{{ route('menu.index') }}" class="btn btn-primary">Seguir comprando</a>
        <form action="{{ route('menu.place-order') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Realizar Pedido</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Usar delegación para que funcione en elementos dinámicos
    $(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var platilloId = $(this).data('platillo-id');
        $.ajax({
            url: '{{ route("menu.remove-from-cart") }}',
            method: 'POST',
            data: {
                platillo_id: platilloId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.item_quantity > 0) {
                    // Reconstruir el contenido del <li> con el nombre, cantidad, precio y el botón
                    $('#cart-item-' + platilloId).html(
                        response.name + ' - ' + response.item_quantity + ' x $' + response.price +
                        ' <button class="btn btn-danger btn-sm remove-from-cart" data-platillo-id="' + platilloId + '">Eliminar</button>'
                    );
                } else {
                    $('#cart-item-' + platilloId).remove();
                }
                $('#cart-count').text(response.count);
                $('#cart-total').text('Total: $' + response.total);
                alert(response.message);
                if ($('#cart-items').children().length === 0) {
                    $('#cart-items').html('<li class="list-group-item">El carrito está vacío.</li>');
                }
            },
            error: function(xhr, status, error) {
                alert('Hubo un error al eliminar el platillo del carrito.');
            }
        });
    });
});


</script>

@endsection
