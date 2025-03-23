<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    // Mostrar todas las promociones
    public function index()
    {
        $promociones = Promotion::all();
        return view('admin.promociones.index', compact('promociones'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('admin.promociones.create');
    }

    // Guardar una nueva promoción
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Promotion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activo' => true, // Por defecto, la promoción estará activa
        ]);
    
        return redirect()->route('admin.promociones.index')->with('success', 'Promoción creada exitosamente.');
    }

    // Mostrar el formulario de edición
    public function edit(Promotion $promocion)
    {
        return view('admin.promociones.edit', compact('promocion'));
    }
    // Actualizar una promoción
    public function update(Request $request, Promotion $promocion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        $promocion->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    
        return redirect()->route('admin.promociones.index')->with('success', 'Promoción actualizada exitosamente.');
    }
    // Eliminar una promoción
    public function destroy(Promotion $promocion)
{
    $promocion->delete();
    return redirect()->route('admin.promociones.index')->with('success', 'Promoción eliminada exitosamente.');
}

public function toggleStatus(Promotion $promocion)
{
    $promocion->activo = !$promocion->activo;
    $promocion->save();

    return response()->json(['success' => true]);
}
}