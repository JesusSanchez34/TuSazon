<?php

namespace Database\Seeders; // Namespace correcto

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Platillo;

class OrdersTableSeeder extends Seeder // Nombre de la clase correcto
{
    public function run(): void
    {
        // Crear platillos de prueba si no existen
        $platillo1 = Platillo::firstOrCreate([
            'nombre' => 'Hamburguesa',
            'precio' => 50.00,
            'descripcion' => 'Deliciosa hamburguesa con queso y tocino', // Agrega una descripción
        ]);

        $platillo2 = Platillo::firstOrCreate([
            'nombre' => 'Pizza',
            'precio' => 120.00,
            'descripcion' => 'Pizza familiar con pepperoni y champiñones', // Agrega una descripción
        ]);

        // Crear pedidos de prueba
        $order1 = Order::create([
            'order_number' => 'ORD-001',
            'total' => 100.00,
            'status' => 'pendiente',
        ]);

        $order2 = Order::create([
            'order_number' => 'ORD-002',
            'total' => 240.00,
            'status' => 'completado',
        ]);

        // Agregar items a los pedidos
        OrderItem::create([
            'order_id' => $order1->id,
            'platillo_id' => $platillo1->id,
            'quantity' => 2,
            'price' => 50.00,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'platillo_id' => $platillo2->id,
            'quantity' => 2,
            'price' => 120.00,
        ]);
    }
}