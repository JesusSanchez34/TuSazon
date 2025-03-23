<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;

class PlatilloController extends Controller
{
    // Mostrar todos los platillos
    public function index()
    {
        $platillos = Platillo::with('category')->get();
        return view('admin.platillos.index', compact('platillos'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.platillos.create', compact('categories'));
    }

    // Guardar un nuevo platillo
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);

    $imagenPath = $request->hasFile('imagen') ? $request->file('imagen')->store('platillos', 'public') : null;

    Platillo::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'imagen' => $imagenPath,
        'category_id' => $request->category_id,
    ]);


    return redirect()->route('admin.platillos.index')->with('success', 'Platillo creado exitosamente.');
}

    // Mostrar el formulario de edición
    public function edit(Platillo $platillo)
    {   
        $categories = \App\Models\Category::all();
        return view('admin.platillos.edit', compact('platillo', 'categories'));
    }

    // Actualizar un platillo
    public function update(Request $request, Platillo $platillo)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        if ($request->hasFile('imagen')) {
            $platillo->imagen = $request->file('imagen')->store('platillos', 'public');
        }
    
        $platillo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->route('admin.platillos.index')->with('success', 'Platillo actualizado exitosamente.');
    }
    // Eliminar un platillo
    public function destroy(Platillo $platillo)
    {
        $platillo->delete();
        return redirect()->route('admin.platillos.index')->with('success', 'Platillo eliminado exitosamente.');
    }

    public function toggleStatus(Platillo $platillo)
    {
        // Cambiar el estado (activo/inactivo)
        $platillo->activo = !$platillo->activo;
        $platillo->save();

        return response()->json(['success' => true]);
    }
}
