@extends('layouts.admin')

@section('title', 'Administrar Pedidos')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Lista de Pedidos</div>
        <div class="card-body">
            <!-- Mensaje de éxito -->
            <div id="success-message" class="alert alert-success d-none" role="alert">
                Estado del pedido actualizado exitosamente.
            </div>
            <!-- Tabla de pedidos -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Número de Pedido</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'pendiente' ? 'warning' : ($order->status == 'completado' ? 'success' : 'danger') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm view-details" data-order-id="{{ $order->id }}">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </button>
                            @if ($order->status == 'pendiente')
                            <button class="btn btn-success btn-sm complete-order" data-order-id="{{ $order->id }}">
                                <i class="fas fa-check"></i> Completar
                            </button>
                            <button class="btn btn-danger btn-sm cancel-order" data-order-id="{{ $order->id }}">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ver detalles del pedido
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                window.location.href = `/admin/orders/${orderId}`;
            });
        });

        // Completar pedido
        document.querySelectorAll('.complete-order').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                completeOrder(orderId);
            });
        });

        // Cancelar pedido
        document.querySelectorAll('.cancel-order').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                cancelOrder(orderId);
            });
        });

        // Función para ver detalles del pedido
        function viewOrderDetails(orderId) {
            // Redirigir a la página de detalles del pedido
            window.location.href = `/admin/orders/${orderId}`;
        }

        // Función para completar un pedido
        function completeOrder(orderId) {
            if (confirm("¿Estás seguro de marcar este pedido como completado?")) {
                fetch(`/admin/orders/${orderId}/complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mostrar mensaje de éxito
                            document.getElementById('success-message').classList.remove('d-none');
                            document.getElementById('success-message').textContent = 'Pedido completado exitosamente.';

                            // Recargar la página después de 2 segundos
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Función para cancelar un pedido
        function cancelOrder(orderId) {
            if (confirm("¿Estás seguro de cancelar este pedido?")) {
                fetch(`/admin/orders/${orderId}/cancel`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mostrar mensaje de éxito
                            document.getElementById('success-message').classList.remove('d-none');
                            document.getElementById('success-message').textContent = 'Pedido cancelado exitosamente.';

                            // Recargar la página después de 2 segundos
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    });
</script>
@endsection