<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Listar reseñas de un producto
     */
    public function index($productId)
    {
        try {
            $reviews = Review::with('user')
                ->where('product_id', $productId)
                ->where('is_approved', true)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $reviews
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener reseñas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear una reseña
     */
    public function store(Request $request, $productId)
    {
        try {
            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'title' => 'nullable|string|max:255',
                'comment' => 'nullable|string',
            ]);

            // Verificar que el producto existe
            $product = Product::findOrFail($productId);

            // Verificar si el usuario ya dejó una reseña
            $existingReview = Review::where('product_id', $productId)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya has dejado una reseña para este producto'
                ], 400);
            }

            $review = Review::create([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
                'title' => $validated['title'] ?? null,
                'comment' => $validated['comment'] ?? null,
            ]);

            // Actualizar rating del producto
            $this->updateProductRating($productId);

            return response()->json([
                'success' => true,
                'message' => 'Reseña creada exitosamente. Será revisada antes de publicarse.',
                'data' => $review
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear reseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar rating del producto
     */
    private function updateProductRating($productId)
    {
        $product = Product::find($productId);
        
        $avgRating = Review::where('product_id', $productId)
            ->where('is_approved', true)
            ->avg('rating');
        
        $reviewsCount = Review::where('product_id', $productId)
            ->where('is_approved', true)
            ->count();

        $product->update([
            'rating' => round($avgRating, 2),
            'reviews_count' => $reviewsCount
        ]);
    }

    /**
     * Aprobar una reseña (Admin)
     */
    public function approve($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->update(['is_approved' => true]);

            // Actualizar rating del producto
            $this->updateProductRating($review->product_id);

            return response()->json([
                'success' => true,
                'message' => 'Reseña aprobada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar reseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar una reseña
     */
    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            $productId = $review->product_id;
            
            $review->delete();

            // Actualizar rating del producto
            $this->updateProductRating($productId);

            return response()->json([
                'success' => true,
                'message' => 'Reseña eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar reseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}