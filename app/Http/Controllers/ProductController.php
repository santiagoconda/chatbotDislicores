<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;



class ProductController extends Controller
{
    /**
     * Listar todos los productos con filtros
     */
    public function todoslosproductos($slug){
        $product = Product::where($slug)->get();
        return $product;
    }
    public function index(Request $request)
    {
        // $produc = Product::all();
        // return $produc;
        
        try {
            $query = Product::with(['category', 'brand', 'images', 'tags'])
                ->active()
                ->inStock();
            // dd($query->toSql());
            // Filtro por categoría
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Filtro por marca
            if ($request->has('brand_id')) {
                $query->where('brand_id', $request->brand_id);
            }

            // Filtro por tipo de licor
            if ($request->has('type')) {
                $query->where('type', $request->type);
            }

            // Filtro por rango de precio
            if ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Filtro por porcentaje de alcohol
            if ($request->has('min_alcohol')) {
                $query->where('alcohol_percentage', '>=', $request->min_alcohol);
            }

            // Búsqueda por nombre
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            // Filtros especiales
            if ($request->has('featured')) {
                $query->featured();
            }
            if ($request->has('on_sale')) {
                $query->onSale();
            }
            if ($request->has('is_new')) {
                $query->where('is_new', true);
            }

            // Ordenamiento
    $sortBy = $request->get('sort_by', 'created_at');
    $sortOrder = $request->get('sort_order', 'desc');

    $allowedSorts = ['created_at','price','name','views','rating'];

    if (!in_array($sortBy, $allowedSorts)) {
        $sortBy = 'created_at';
    }

    $query->orderBy($sortBy, $sortOrder);

    $products = $query->paginate(3);

            // return response()->json([
            //     'success' => true,
            //     'data' => $products
            // ]);
            // dd($products->toArray());
            return view('welcome', compact('products'));
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener productos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar un producto específico
     */
    public function show($slug)
    {

        try {
            $product = Product::with(['category', 'brand', 'images', 'tags', 'reviews.user'])
                ->where('slug', $slug)
                ->firstOrFail();
            // Incrementar vistas
            $product->increment('views');

            // Productos relacionados
            $relatedProducts = Product::with(['images'])
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->active()
                ->inStock()
                ->limit(4)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'product' => $product,
                    'related_products' => $relatedProducts
                ]
            ]);
            // return view('components.detalle-producto', compact('product','relatedProducts'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Crear un nuevo producto (Admin)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'short_description' => 'nullable|string',
                'alcohol_percentage' => 'nullable|numeric|min:0|max:100',
                'type' => 'nullable|string',
                'age' => 'nullable|integer',
                'origin_country' => 'nullable|string',
                'volume' => 'required|string',
                'price' => 'required|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'min_stock' => 'nullable|integer|min:0',
                'is_featured' => 'boolean',
                'is_new' => 'boolean',
                'is_on_sale' => 'boolean',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $product = Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Producto creado exitosamente',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar un producto (Admin)
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                'category_id' => 'sometimes|exists:categories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'short_description' => 'nullable|string',
                'alcohol_percentage' => 'nullable|numeric|min:0|max:100',
                'type' => 'nullable|string',
                'age' => 'nullable|integer',
                'origin_country' => 'nullable|string',
                'volume' => 'sometimes|string',
                'price' => 'sometimes|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'stock' => 'sometimes|integer|min:0',
                'min_stock' => 'nullable|integer|min:0',
                'is_active' => 'boolean',
                'is_featured' => 'boolean',
                'is_new' => 'boolean',
                'is_on_sale' => 'boolean',
            ]);

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado exitosamente',
                'data' => $product->load(['category', 'brand', 'images'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un producto (Admin)
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete(); // Soft delete

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Productos destacados
     */
    public function featured()
    {
        try {
            $products = Product::with(['category', 'brand', 'images'])
                ->featured()
                ->active()
                ->inStock()
                ->limit(8)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener productos destacados',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Productos en oferta
     */
    public function onSale()
    {
        try {
            $products = Product::with(['category', 'brand', 'images'])
                ->onSale()
                ->active()
                ->inStock()
                ->limit(8)
                ->paginate(3);

            // return response()->json([
            //     'success' => true,
            //     'data' => $products
            // ]);
            return view('components.on-sale', compact('products'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener productos en oferta',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Productos nuevos
     */
    public function newArrivals()
    {
        try {
            $products = Product::with(['category', 'brand', 'images'])
                ->where('is_new', true)
                ->active()
                ->inStock()
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener productos nuevos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}