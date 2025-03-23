<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Platillo;
use App\Models\User;
use Illuminate\Support\Facades\Validator; // Para usar Validator
use Illuminate\Support\Facades\Hash;     // Para usar Hash
use Illuminate\Support\Facades\Auth;    // Para usar Auth

class AdminController extends Controller
{
    // Vista principal del panel de administrador
    public function dashboard()
    {
        return view('dashboard');
    }

    // Mostrar todos los pedidos
    public function orders()
    {
        $orders = Order::with('items')->paginate(10); // Paginación de 10 pedidos por página
        return view('admin.pedidos.index', compact('orders'));
    }

    // Mostrar las promociones
    public function promotions()
    {
        $promotions = Promotion::all();
        return view('admin.promotions', compact('promotions'));
    }

    // Mostrar los reportes
    public function reports()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        return view('admin.reportes.index', compact('totalOrders', 'totalRevenue'));
    }

    public function reportesPlatillos()
{
    // Lógica para obtener los datos de los platillos más vendidos
    $platillosMasVendidos = Platillo::withCount('orders')
        ->orderBy('orders_count', 'desc')
        ->take(10) // Obtener los 10 platillos más vendidos
        ->get();

    return view('admin.reportes.platillos', compact('platillosMasVendidos'));
}

public function reportesEncuestas()
{
   

    return view('admin.reportes.encuestas', compact('encuestas'));
}

    // Mostrar los platillos
    public function platillos()
    {
        $platillos = Platillo::all();
        return view('admin.platillos', compact('platillos'));
    }

    // Mostrar la configuración
    public function configuracion()
    {
        return view('admin.configuracion.index');
    }

// Método para actualizar el perfil
public function updateProfile(Request $request)
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Verificar que el usuario esté autenticado y sea una instancia de User
    if (!$user instanceof \App\Models\User) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
    }

    // Validar los datos del formulario
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    // Si la validación falla, redirigir con errores
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Actualizar los datos del usuario
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save(); // Guardar los cambios

    // Redirigir con un mensaje de éxito
    return redirect()->route('admin.configuracion.index')->with('success', 'Perfil actualizado correctamente.');
}
// Método para cambiar la contraseña
public function updatePassword(Request $request)
{
    // Validar los datos del formulario
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    // Si la validación falla, redirigir con errores
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Verificar que la contraseña actual sea correcta
     /** @var User $user */
    $user = Auth::user();
    if (!Hash::check($request->input('current_password'), $user->password)) {
        return redirect()->back()
            ->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])
            ->withInput();
    }

    // Actualizar la contraseña
    $user->password = Hash::make($request->input('new_password'));
    $user->save(); // Guardar los cambios

    // Redirigir con un mensaje de éxito
    return redirect()->route('admin.configuracion.index')->with('success', 'Contraseña cambiada correctamente.');
}

}