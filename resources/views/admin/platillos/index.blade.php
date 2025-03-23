@extends('layouts.admin')

@section('title', 'Administrar Platillos')

@section('content')
<br>
<br>

    <!-- Botón para agregar nuevo platillo -->
    <div class="text-end mb-4">
        <a href="{{ route('admin.platillos.create') }}" class="btn btn-add">
            <i class="fas fa-plus"></i> Agregar Nuevo Platillo
        </a>
  
<br>
<br>
    <!-- Lista de platillos -->
    <div class="card">
        <div class="card-header">Lista de Platillos</div>
        <div class="card-body">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de platillos -->
            <table class="table">
                <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($platillos as $platillo)
                        <tr>
                            <td>{{ $platillo->nombre }}</td>
                            <td>{{ $platillo->descripcion }}</td>
                            <td>${{ number_format($platillo->precio, 2) }}</td>
                            <td>
                            {{ $platillo->category ? $platillo->category->nombre : 'Sin categoría' }}
                        </td>
                        
                            <td>
                                <a href="{{ route('admin.platillos.edit', $platillo) }}" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('admin.platillos.destroy', $platillo) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este platillo?')">
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

@endsection