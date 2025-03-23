<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Pedido</title>
</head>
<body>
    <h1>Ticket de Pedido</h1>
    <p>Número de Pedido: {{ $order->order_number }}</p>
    <p>Total: ${{ $order->total }}</p>
    <h2>Platillos:</h2>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->platillo->nombre }} - {{ $item->quantity }} x ${{ $item->price }}</li>
        @endforeach
    </ul>
</body>
</html>