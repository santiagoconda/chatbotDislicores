<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('components.layout.app', function ($view) {
        try {
            $categories = Category::where('is_active', true)
                ->orderBy('order')
                ->get();

            // return response()->json([
            //     'success' => true,
            //     'data' => $categories
            // ]);
            $view->with('categories', $categories);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener categorías',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    
    }
}