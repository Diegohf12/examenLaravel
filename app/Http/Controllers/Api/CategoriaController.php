<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(
            Categoria::all(),
            200
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable',
        ]);

        $categoria = Categoria::create($request->all());

        return response()->json([
            'message' => 'Categoria registrada correctamente',
            'data' => $categoria
        ], 201);
    }

    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria no encontrada'
            ], 404);
        }

        return response()->json($categoria);
    }

    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria no encontrada'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable',
        ]);

        $categoria->update($request->all());

        return response()->json([
            'message' => 'Categoria actualizada correctamente',
            'data' => $categoria
        ]);
    }

    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria no encontrada'
            ], 404);
        }

        $categoria->delete();

        return response()->json([
            'message' => 'Categoria eliminada correctamente'
        ]);
    }
}