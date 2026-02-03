<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\AnthropicService;


class ChatbotController extends Controller
{
  
    protected $anthropicService;

    public function __construct(AnthropicService $anthropicService)
    {
        $this->anthropicService = $anthropicService;
    }

    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string'
            ]);

            $response = $this->anthropicService->sendMessage(
                $request->message,
                $request->conversation_history ?? []
            );

            // Extraer solo el texto de la respuesta
            $reply = $response['content'][0]['text'] ?? 'Sin respuesta';

            return response()->json([
                'reply' => $reply,
                'full_response' => $response // Por si necesitas la respuesta completa
            ]);
            
        } catch (Exception $e) {
            \Log::error('Error en chat: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Error al procesar el mensaje: ' . $e->getMessage()
            ], 500);
        }
    }
}