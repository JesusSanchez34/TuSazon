@extends('layouts.admin')

@section('title', 'Reportes de Platillos')

@section('content')
<br>
<br>
<!-- Filtro de fechas -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Filtrar por Fecha</h5>
        <form id="filter-form-platillos">
            <div class="row">
                <div class="col-md-6">
                    <label for="start-date">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="start-date" required>
                </div>
                <div class="col-md-6">
                    <label for="end-date">Fecha de Fin</label>
                    <input type="date" class="form-control" id="end-date" required>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary w-100">Generar Reporte</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Gráfico de platillos más vendidos -->
<div class="card">
    <div class="card-header">Platillos Más Vendidos</div>
    <div class="card-body">
        <canvas id="salesChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('filter-form-platillos').addEventListener('submit', function(event) {
        event.preventDefault();
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;

        // Simulación de datos (puedes reemplazar con una llamada AJAX)
        const data = {
            labels: ['Ceviche de camarón', 'Arroz con mariscos', 'Limonada', 'Flan de coco'],
            datasets: [{
                label: 'Ventas',
                data: [120, 90, 150, 60],
                backgroundColor: '#48dbfb',
                borderColor: '#0abde3',
                borderWidth: 1
            }]
        };

        // Renderizar el gráfico
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection