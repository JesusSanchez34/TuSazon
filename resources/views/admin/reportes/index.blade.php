@extends('layouts.admin')

@section('title', 'Administrar Pedidos')

@section('content')

 <!-- Opciones de reportes -->
 <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Reportes de Platillos</h3>
                        </div>
                        <div class="card-body text-center">
                            <p>Consulta los reportes de los platillos más vendidos y su desempeño.</p>
                            <a href="{{ route('admin.reportes.platillos') }}" class="btn btn-primary">Ver Reportes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Reportes de Encuestas</h3>
                        </div>
                        <div class="card-body text-center">
                            <p>Consulta los resultados de las encuestas de satisfacción de los clientes.</p>
                            <a href="{{ route('admin.reportes.encuestas') }}" class="btn btn-primary">Ver Reportes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('scripts')

 <!-- Bootstrap JS y dependencias -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    @endsection