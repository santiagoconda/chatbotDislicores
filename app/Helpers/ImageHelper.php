<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getProductImage($path)
    {
        if (!$path) {
            return asset('images/no-image.png'); // Imagen por defecto
        }
        
        // Si ya es una URL completa, retornarla
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        
        // Construir URL de Supabase
        return env('SUPABASE_STORAGE_URL') . '/' . $path;
    }
}