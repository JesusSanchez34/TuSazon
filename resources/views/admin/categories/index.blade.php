@extends('layouts.admin')

@section('title', 'Administrar Categorías')

@section('content')
<br>
<br>

<div class="text-end mb-4">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-add">
        <i class="fas fa-plus"></i> Agregar Nueva Categoría
    </a>
</div>

<div class="card">
    <div class="card-header">Lista de Categorías</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($categories->isEmpty())
            <p class="text-muted">No hay categorías registradas.</p>
        @endif
    </div>
</div>
@endsection