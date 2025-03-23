<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Platillo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

     // Mostrar todos los pedidos
     public function index()
     {
         $orders = Order::with('items.platillo')->get(); // Cargar relaciones
         return view('admin.orders.index', compact('orders'));
     }
     // Mostrar los detalles de una orden
    public function show(Order $order)
    {
        // Cargar los items de la orden y sus platillos relacionados
        $order->load('items.platillo');

        return view('admin.orders.show', compact('order'));
    }
    // Mostrar el carrito
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Agregar un platillo al carrito
    public function addToCart(Request $request)
    {
        // Validar que el platillo exista
        $platillo = Platillo::find($request->id);
        if (!$platillo) {
            return response()->json(['error' => 'Platillo no encontrado'], 404);
        }

        // Obtener el carrito de la sesión
        $cart = session()->get('cart', []);

        // Agregar o actualizar el platillo en el carrito
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                'name' => $platillo->nombre,
                'price' => $platillo->precio,
                'quantity' => 1,
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('cart', $cart);

        return response()->json(['success' => 'Platillo agregado al carrito']);
    }

    // Eliminar un platillo del carrito
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => 'Platillo eliminado del carrito']);
    }

    // Enviar el pedido
    public function placeOrder(Request $request)
    {
        // Obtener el carrito de la sesión
        $cart = session()->get('cart', []);

        // Validar que el carrito no esté vacío
        if (empty($cart)) {
            return response()->json(['error' => 'El carrito está vacío'], 400);
        }

        try {
            // Calcular el total del pedido
            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            // Crear el pedido
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Número de orden único
                'total' => $total,
                'status' => 'pendiente',
            ]);

            // Guardar los elementos del carrito en la tabla `order_items`
            foreach ($cart as $id => $item) {
                $order->items()->create([
                    'platillo_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Limpiar el carrito
            session()->forget('cart');

            // Generar el ticket (PDF)
            $pdf = Pdf::loadView('pdf.ticket', compact('order'));

            // Descargar el PDF
            return $pdf->download('ticket.pdf');
        } catch (\Exception $e) {
            // Manejar errores
            return response()->json(['error' => 'Error al procesar el pedido: ' . $e->getMessage()], 500);
        }
    }

    // Cambiar el estado de un pedido a "completado"
    public function completeOrder(Order $order)
    {
        $order->status = 'completado';
        $order->save();

        return response()->json(['success' => true]);
    }

    // Cambiar el estado de un pedido a "cancelado"
    public function cancelOrder(Order $order)
    {
        $order->status = 'cancelado';
        $order->save();

        return response()->json(['success' => true]);
    }
}