@extends('layouts.admin')

@section('title', 'Reportes de Encuestas')

@section('content')
<br>
<br>

<!-- Filtro de fechas -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Filtrar por Fecha</h5>
        <form id="filter-form-encuestas">
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

<!-- Gráfico de resultados de encuestas -->
<div class="card">
    <div class="card-header">Resultados de Encuestas</div>
    <div class="card-body">
        <canvas id="surveyChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('filter-form-encuestas').addEventListener('submit', function(event) {
        event.preventDefault();
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;

        // Simulación de datos (puedes reemplazar con una llamada AJAX)
        const data = {
            labels: ['Calidad de la comida', 'Atención al cliente', 'Limpieza del establecimiento', 'Tiempo de espera'],
            datasets: [{
                label: 'Calificación Promedio',
                data: [4.5, 4.2, 4.7, 3.8],
                backgroundColor: '#48dbfb',
                borderColor: '#0abde3',
                borderWidth: 1
            }]
        };

        // Renderizar el gráfico
        const ctx = document.getElementById('surveyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    });
</script>
@endsection