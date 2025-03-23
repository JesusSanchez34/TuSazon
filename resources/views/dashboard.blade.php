@extends('layouts.admin')

@section('title', 'Reportes de Encuestas')

@section('content')

<!-- Resumen rápido -->
<div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">Ventas Hoy</div>
                    <div class="card-body">
                        <h5 class="card-title">$1,500.00</h5>
                        <p class="card-text">Total de ventas realizadas hoy.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">Pedidos Activos</div>
                    <div class="card-body">
                        <h5 class="card-title">12</h5>
                        <p class="card-text">Pedidos en proceso.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">Encuestas</div>
                    <div class="card-body">
                        <h5 class="card-title">5</h5>
                        <p class="card-text">Encuestas registradas hoy.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de pedidos recientes -->
        <div class="card mt-4">
            <div class="card-header">Pedidos Recientes</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>Juan Pérez</td>
                            <td>$120.00</td>
                            <td><span class="badge bg-success">Completado</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Ver Detalles</button>
                            </td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>María López</td>
                            <td>$80.00</td>
                            <td><span class="badge bg-warning">En Proceso</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">
                                    Ver Detalles</button>
                            </td>
                        </tr>
                        <tr>
                            <td>103</td>
                            <td>Carlos Sánchez</td>
                            <td>$200.00</td>
                            <td><span class="badge bg-danger">Cancelado</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Ver Detalles</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection