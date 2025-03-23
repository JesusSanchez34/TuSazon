@extends('layouts.admin')

@section('title', 'Detalles de la Orden')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Detalles de la Orden #{{ $order->order_number }}
        </div>
        <div class="card-body">
            <!-- Información general de la orden -->
            <div class="mb-4">
                <h5>Información de la Orden</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Número de Orden:</strong> {{ $order->order_number }}
                    </li>
                    <li class="list-group-item">
                        <strong>Total:</strong> ${{ number_format($order->total, 2) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Estado:</strong>
                        <span class="badge bg-{{ $order->status == 'pendiente' ? 'warning' : ($order->status == 'completado' ? 'success' : 'danger') }}">
                            {{ $order->status }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Creación:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                    </li>
                </ul>
            </div>

            <!-- Detalles de los platillos en la orden -->
            <div class="mb-4">
                <h5>Platillos en la Orden</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Platillo</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->platillo->nombre }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Botón para regresar a la lista de órdenes -->
            <div class="text-end">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Regresar a la Lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection