@extends('layouts.admin')

@section('title', 'Editar Platillo')

@section('content')
<div class="card mt-4">
    <div class="card-header">Editar Platillo</div>
    <div class="card-body">
        <form action="{{ route('admin.platillos.update', $platillo) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $platillo->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ $platillo->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ $platillo->precio }}" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
                @if ($platillo->imagen)
                    <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="{{ $platillo->nombre }}" class="img-thumbnail mt-2" width="100">
                @endif
            </div>
            <!-- Selector de Categoría -->
            <div class="mb-3">
            <label for="category_id">Categoría</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $platillo->category_id ? 'selected' : '' }}>
                {{ $category->nombre }}
            </option>
        @endforeach
    </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
