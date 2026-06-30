<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return response()->json(
            Proveedor::all(),
            200
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'ruc' => 'nullable|max:15|unique:proveedores,ruc',
            'telefono' => 'nullable|max:20',
            'correo' => 'nullable|email',
        ]);

        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'message' => 'Proveedor registrado correctamente',
            'data' => $proveedor
        ], 201);
    }

    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json([
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        return response()->json($proveedor);
    }

    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json([
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|max:100',
            'ruc' => 'nullable|max:15|unique:proveedores,ruc,' . $id,
            'telefono' => 'nullable|max:20',
            'correo' => 'nullable|email',
        ]);

        $proveedor->update($request->all());

        return response()->json([
            'message' => 'Proveedor actualizado correctamente',
            'data' => $proveedor
        ]);
    }

    public function destroy(string $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json([
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        $proveedor->delete();

        return response()->json([
            'message' => 'Proveedor eliminado correctamente'
        ]);
    }
}