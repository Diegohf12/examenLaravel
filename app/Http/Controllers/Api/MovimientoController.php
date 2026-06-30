<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return response()->json(
            Movimiento::all(),
            200
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'fecha_movimiento' => 'required|date',
        ]);

        $movimiento = Movimiento::create($request->all());

        return response()->json([
            'message' => 'Movimiento registrado correctamente',
            'data' => $movimiento
        ], 201);
    }

    public function show(string $id)
    {
        $movimiento = Movimiento::find($id);

        if (!$movimiento) {
            return response()->json([
                'message' => 'Movimiento no encontrado'
            ], 404);
        }

        return response()->json($movimiento);
    }

    public function update(Request $request, string $id)
    {
        $movimiento = Movimiento::find($id);

        if (!$movimiento) {
            return response()->json([
                'message' => 'Movimiento no encontrado'
            ], 404);
        }

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'fecha_movimiento' => 'required|date',
        ]);

        $movimiento->update($request->all());

        return response()->json([
            'message' => 'Movimiento actualizado correctamente',
            'data' => $movimiento
        ]);
    }

    public function destroy(string $id)
    {
        $movimiento = Movimiento::find($id);

        if (!$movimiento) {
            return response()->json([
                'message' => 'Movimiento no encontrado'
            ], 404);
        }

        $movimiento->delete();

        return response()->json([
            'message' => 'Movimiento eliminado correctamente'
        ]);
    }
}