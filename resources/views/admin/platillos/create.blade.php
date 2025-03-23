@extends('layouts.admin')

@section('title', 'Crear Platillo')

@section('content')


    <div class="card mt-4">
        <div class="card-header">Nuevo Platillo</div>
        <div class="card-body">
            <form action="{{ route('admin.platillos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" name="imagen" id="imagen" class="form-control">
    </div>
     <!-- Selector de Categoría -->
     <div class="mb-3">
     <div class="form-group">
    <label for="category_id">Categoría</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->nombre }}
            </option>
        @endforeach
    </select>
</div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection