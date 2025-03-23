@extends('layouts.admin')

@section('title', 'Administrar Promociones')

@section('content')
<br>
<br>
<!-- Botón para agregar nueva promoción -->
<div class="text-end mb-4">
    <a href="{{ route('admin.promociones.create') }}" class="btn btn-add">
        <i class="fas fa-plus"></i> Agregar Nueva Promoción
    </a>
</div>

<!-- Lista de promociones -->
<div class="card">
    <div class="card-header">Lista de Promociones</div>
    <div class="card-body">
        <!-- Mensaje de éxito -->
        <div id="success-message" class="alert alert-success d-none" role="alert">
            Estado de la promoción actualizado exitosamente.
        </div>
        <!-- Tabla de promociones -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promociones as $promocion)
                <tr>
                    <td>{{ $promocion->nombre }}</td>
                    <td>{{ $promocion->descripcion }}</td>
                    <td>{{ $promocion->descuento }}%</td>
                    <td>
                        <button class="btn btn-toggle {{ $promocion->activo ? 'active' : 'inactive' }}"
                            data-id="{{ $promocion->id }}">
                            {{ $promocion->activo ? 'Activo' : 'Inactivo' }}
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('admin.promociones.edit', $promocion) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('admin.promociones.destroy', $promocion) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
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
        document.querySelectorAll('.btn-toggle').forEach(button => {
            button.addEventListener('click', function() {
                togglePromoStatus(this);
            });
        });

        function togglePromoStatus(button) {
            const promoId = button.getAttribute('data-id');
            const isActive = button.classList.contains('active');

            fetch(`/admin/promociones/${promoId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ status: !isActive }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cambiar el estado del botón
                    button.classList.toggle('active');
                    button.classList.toggle('inactive');
                    button.textContent = isActive ? 'Inactivo' : 'Activo';
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection