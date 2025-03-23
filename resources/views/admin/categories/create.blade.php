@extends('layouts.admin')

@section('title', isset($category) ? 'Editar Categoría' : 'Crear Categoría')

@section('content')
<br>
<br>

<div class="card">
    <div class="card-header">{{ isset($category) ? 'Editar' : 'Nueva' }} Categoría</div>
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" 
                       class="form-control" required
                       value="{{ isset($category) ? $category->nombre : old('nombre') }}">
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection