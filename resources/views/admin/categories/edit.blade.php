@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('content')
<br><br>

<div class="card">
    <div class="card-header">Editar Categoría - {{ $category->nombre }}</div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" 
                       class="form-control" 
                       value="{{ old('nombre', $category->nombre) }}" 
                       required>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection