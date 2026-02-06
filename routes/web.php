<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index'])->name('index'); // Listar productos con filtros
Route::post('/chat', [ChatbotController::class, 'sendMessage']);
Route::get('/products.show', function () {
    return view('welcome');
})->name('products.show');
Route::prefix('products')->group(function () {
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



Route::prefix('cart')->group(function () {
    // View cart
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    
    // Add to cart (AJAX)
Route::post('/add', [CartController::class, 'addCar'])->name('cart.add');
    // Update quantity (AJAX)
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    
    // Remove item (AJAX)
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    
    // Clear cart (AJAX)
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    // Get cart data (AJAX)
    Route::get('/data', [CartController::class, 'getCart'])->name('cart.data');
    
    // Generate WhatsApp message (AJAX)
    Route::post('/whatsapp', [CartController::class, 'generateWhatsAppMessage'])->name('cart.whatsapp');
});