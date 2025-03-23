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
                <form id="place-order-form" action="{{ route('menu.place-order') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Enviar Pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>