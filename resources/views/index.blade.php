@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menú</h1>
    <div class="row">
        @foreach ($platillos as $platillo)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('storage/' . $platillo->imagen) }}" class="card-img-top" alt="{{ $platillo->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $platillo->nombre }}</h5>
                    <p class="card-text">{{ $platillo->descripcion }}</p>
                    <p class="card-text">${{ $platillo->precio }}</p>
                    <button class="btn btn-primary add-to-cart" data-id="{{ $platillo->id }}">Agregar al carrito</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection