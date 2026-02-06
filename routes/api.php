<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ReviewController;

Route::post('/chat', [ChatbotController::class, 'sendMessage']);

Route::prefix('products')->group(function () {
    // Route::get('/', [ProductController::class, 'index']); // Listar productos con filtros
    Route::get('/', [ProductController::class, 'todoslosproductos']); // Listar productos con filtros
    Route::get('/featured', [ProductController::class, 'featured']); // Productos destacados
    Route::get('/on-sale', [ProductController::class, 'onSale']); // Productos en oferta
    Route::get('/new-arrivals', [ProductController::class, 'newArrivals']); // Productos nuevos
    Route::get('/{slug}', [ProductController::class, 'show']); // Ver producto específico
});
// Categorías
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']); // Listar categorías
    Route::get('/{slug}', [CategoryController::class, 'show']); // Ver categoría con productos
});

// Marcas
Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']); // Listar marcas
    Route::get('/{slug}', [BrandController::class, 'show']); // Ver marca con productos
});

// Reseñas
Route::get('products/{productId}/reviews', [ReviewController::class, 'index']); // Listar reseñas
