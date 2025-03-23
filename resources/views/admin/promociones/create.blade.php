@extends('layouts.admin')

@section('title', 'Crear Nueva Promoción')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Nueva Promoción</div>
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

                    <!-- Formulario de creación de promoción -->
                    <form action="{{ route('admin.promociones.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Promoción</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: 2x1 en bebidas" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ej: Promoción válida todos los martes." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" placeholder="Ej: 50" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Crear Promoción</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

   
    <!-- Script para manejar la lógica del formulario -->
    <script>
        document.getElementById('create-promotion-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const discount = document.getElementById('discount').value;
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;

            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            // Validar que todos los campos estén completos
            if (!name || !description || !discount || !startDate || !endDate) {
                errorMessage.classList.remove('d-none');
                successMessage.classList.add('d-none');
                return;
            }

            // Simulación de envío de datos al servidor
            const promotionData = {
                name: name,
                description: description,
                discount: discount,
                startDate: startDate,
                endDate: endDate
            };

            console.log("Promoción creada:", promotionData);

            // Mostrar mensaje de éxito
            errorMessage.classList.add('d-none');
            successMessage.classList.remove('d-none');

            // Limpiar el formulario
            document.getElementById('create-promotion-form').reset();
        });
    </script>

@endsection