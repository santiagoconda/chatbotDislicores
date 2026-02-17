<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Listar todas las categorías
     */
    public function index()
    {
        try {
            $categories = Category::where('is_active', true)
                ->orderBy('order')
                ->get();

            // return response()->json([
            //     'success' => true,
            //     'data' => $categories
            // ]);
            return view('components.layout.app', compact('categories'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener categorías',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar una categoría con sus productos
     */
    public function show($slug)
    {
        try {
            $category = Category::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $products = $category->products()
                ->with(['brand', 'images'])
                ->active()
                ->inStock()
                ->paginate(3);

            // return response()->json([
            //     'success' => true,
            //     'data' => [
            //         'category' => $category,
            //         'products' => $products
            //     ]
            // ]);
            return view('components.categorias', compact('category', 'products'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Crear categoría (Admin)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories',
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'order' => 'nullable|integer',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $category = Category::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría creada exitosamente',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar categoría (Admin)
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255|unique:categories,name,' . $id,
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'order' => 'nullable|integer',
                'is_active' => 'boolean',
            ]);

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $category->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada exitosamente',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar categoría (Admin)
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Verificar si tiene productos
            if ($category->products()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar una categoría con productos asociados'
                ], 400);
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}