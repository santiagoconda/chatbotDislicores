<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use Illuminate\Http\Request;
use App\Http\Middleware\Cors;

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('api')
//     ->withoutMiddleware([VerifyCsrfToken::class])
//     ->group(function () {

//         Route::post('/chat', [ChatbotController::class, 'Send']);
//         Route::get('/health', [ChatbotController::class, 'health']);

//     });