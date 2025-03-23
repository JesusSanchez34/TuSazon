<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Models\Platillo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class MenuController extends Controller
{
    // Mostrar el menú de platillos
    public function index(Request $request)
{
    $categories = \App\Models\Category::all(); // Solo obtener categorías
    
    // Filtrado básico
    $platillos = \App\Models\Platillo::when($request->category, function($query, $category) {
        return $query->where('category_id', $category);
    })->get();

    return view('menu.index', compact('platillos', 'categories'));
    }


    public function addToCart(Request $request)
{
    try {

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Debes iniciar sesión para continuar'], 401);
        }

        $platillo = Platillo::findOrFail($request->platillo_id);

        $cartItem = CartItem::firstOrNew([
            'user_id' => $user->id,
            'platillo_id' => $platillo->id,
        ]);

        $cartItem->cantidad += 1;
        $cartItem->save();

        return response()->json([
            'message' => 'Platillo agregado al carrito',
            'count' => $user->cartItems()->sum('cantidad'),
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
public function cartCount()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['count' => 0]);
    }

    $count = CartItem::where('user_id', $user->id)->sum('cantidad');

    return response()->json(['count' => $count]);
}

public function showCart()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver el carrito.');
    }

    $cartItems = CartItem::where('user_id', $user->id)->with('platillo')->get();
    $total = $cartItems->sum(fn ($item) => $item->platillo->precio * $item->cantidad);

    return view('menu.cart', compact('cartItems', 'total'));
}
    // Enviar el pedido
    public function placeOrder(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'Debes iniciar sesión para realizar un pedido'], 401);
        }
    
        // Obtener los items del carrito del usuario desde la base de datos
        $cartItems = CartItem::where('user_id', $user->id)
            ->with('platillo')
            ->get();
    
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'El carrito está vacío'], 400);
        }
    
        try {
            // Calcular el total del pedido
            $total = $cartItems->sum(function ($item) {
                return $item->platillo->precio * $item->cantidad;
            });
    
            // Crear la orden
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total'        => $total,
                'status'       => 'pendiente',
                'user_id'      => $user->id,
            ]);
    
            // Crear cada item de la orden
            foreach ($cartItems as $cartItem) {
                $order->items()->create([
                    'platillo_id' => $cartItem->platillo_id,
                    'quantity'    => $cartItem->cantidad,
                    'price'       => $cartItem->platillo->precio,
                ]);
            }
    
            // Limpiar el carrito (eliminar los items)
            CartItem::where('user_id', $user->id)->delete();
    
            // Generar el PDF con el ticket del pedido
            $pdf = Pdf::loadView('pdf.ticket', compact('order'));
            return $pdf->download('ticket.pdf');
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar el pedido: ' . $e->getMessage()], 500);
        }
    }
    

public function removeFromCart(Request $request)
{
    try {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Debes iniciar sesión para continuar'], 401);
        }

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('platillo_id', $request->platillo_id)
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'El platillo no está en el carrito'], 404);
        }

        // Captura el platillo y su nombre antes de modificar o eliminar
        $platillo = $cartItem->platillo;
        $nombre = $platillo->nombre;

        if ($cartItem->cantidad > 1) {
            $cartItem->cantidad -= 1;
            $cartItem->save();
            $itemQuantity = $cartItem->cantidad;
        } else {
            $cartItem->delete();
            $itemQuantity = 0;
        }

        $count = $user->cartItems->sum('cantidad');
        $total = $user->cartItems->sum(fn($item) => $item->platillo->precio * $item->cantidad);

        return response()->json([
            'message'       => 'Platillo actualizado en el carrito',
            'count'         => $count,
            'total'         => $total,
            'item_quantity' => $itemQuantity,
            'platillo_id'   => $request->platillo_id,
            'price'         => $platillo->precio,
            'name'          => $nombre
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
    }
}


}
