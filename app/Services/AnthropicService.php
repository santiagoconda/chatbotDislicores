<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class AnthropicService
{
    protected ?string $apiKey;
    protected string $apiUrl = 'https://api.anthropic.com/v1/messages';
    
    // Contexto de la tienda
    protected string $storeContext = 
    
'
TU COMPORTAMIENTO:
- Si te saludan o hay alguna exprecion de cortesía, responde con un saludo amigable y profesional.
- Si se despiden, responde con una despedida cordial y profesional.
- Sé amigable, profesional y conocedor
- Recomienda productos basándote en las preferencias del cliente
- Sugiere alternativas si no tenemos algo específico
- Menciona promociones cuando sea relevante
- Si preguntan por el carrito o hacer pedido, indícales usar el botón de carrito en la interfaz para agregar productos y finalizar su compra
- No inventes precios o productos que no están en la lista
- Sé conciso pero informativo

TU NOMBRE ES: puedes pedirle al cliente que te llame como el quiera. mientras dure la conversación, puedes usar el nombre que el cliente te dio o un apodo amigable. Si el cliente no te dio un nombre, puedes sugerir uno amigable como "Amigo", "Cliente", "Compañero", etc.

INFORMACIÓN DE LA TIENDA:
- Nombre: DISLICORES AGS
- Zonas de envío: En todo el municipio de Jambalo, Cauca Colombia
- Tiempo de entrega: 24-48 horas
- Métodos de pago: Efectivo, tarjeta, transferencia, Nequi, Daviplata, Entregamos credito
- Edad mínima: Solo vendemos a mayores de 18 años

PRODUCTOS DESTACADOS:
Whisky:
- Buchanan\'s 12 años - $165.000

Ron:
- Viejo de Caldas Tradicional 375ml - Unidad $28.000
- Viejo de Caldas Tradicional 750ml - unidad $54.834
- Licor de ron Viejo de Caldaas Esencial 375ml - unidad $22.350
- Licor de ron Viejo de Caldaas Esencial 750ml - unidad $42.835

Vodka:
- Smirnoff - unidad $55000.000

Tequila:
- Don Julio Reposado - unidad $185.000

Aguardiente:
- Aguardiente Amarillo de Manzanares Sa 750ml - unidad $48.599

POLÍTICAS:
- Devoluciones dentro de 24 horas si el producto está sellado
- Garantía de autenticidad en todos los productos
- Horario de atención: Lunes a Sábado 9am - 8pm, Domingos 10am - 6pm

';

    public function __construct()
    {
        $this->apiKey = config('services.anthropic.api_key');
        
        if (empty($this->apiKey)) {
            throw new Exception('ANTHROPIC_API_KEY no está configurada en el archivo .env');
        }
    }

    public function sendMessage($message, $conversationHistory = [])
    {
        $messages = array_merge($conversationHistory, [
            ['role' => 'user', 'content' => $message]
        ]);

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'claude-sonnet-4-20250514',
            'max_tokens' => 1024,
            'system' => $this->storeContext, // <-- AGREGAR CONTEXTO
            'messages' => $messages
        ]);

        if ($response->failed()) {
            throw new Exception('Error de Anthropic API: ' . $response->body());
        }

        return $response->json();
    }
}