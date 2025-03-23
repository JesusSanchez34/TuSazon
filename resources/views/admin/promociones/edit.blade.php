@extends('layouts.admin')

@section('title', 'Editar Promoción')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Promoción</div>
                <div class="card-body">
                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Mensaje de éxito -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario de edición de promoción -->
                    <form action="{{ route('admin.promociones.update', ['promocion' => $promocion->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Promoción</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $promocion->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ $promocion->descripcion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" value="{{ $promocion->descuento }}" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $promocion->fecha_inicio }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $promocion->fecha_fin }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Actualizar Promoción</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection