<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Listar todas las marcas
     */
    public function index()
    {
        try {
            $brands = Brand::where('is_active', true)
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $brands
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener marcas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar una marca con sus productos
     */
    public function show($slug)
    {
        try {
            $brand = Brand::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $products = $brand->products()
                ->with(['category', 'images'])
                ->active()
                ->inStock()
                ->paginate(12);

            return response()->json([
                'success' => true,
                'data' => [
                    'brand' => $brand,
                    'products' => $products
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Crear marca (Admin)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:brands',
                'description' => 'nullable|string',
                'logo' => 'nullable|string',
                'country_origin' => 'nullable|string',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $brand = Brand::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Marca creada exitosamente',
                'data' => $brand
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar marca (Admin)
     */
    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255|unique:brands,name,' . $id,
                'description' => 'nullable|string',
                'logo' => 'nullable|string',
                'country_origin' => 'nullable|string',
                'is_active' => 'boolean',
            ]);

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $brand->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Marca actualizada exitosamente',
                'data' => $brand
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar marca (Admin)
     */
    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            
            // Verificar si tiene productos
            if ($brand->products()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar una marca con productos asociados'
                ], 400);
            }

            $brand->delete();

            return response()->json([
                'success' => true,
                'message' => 'Marca eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}