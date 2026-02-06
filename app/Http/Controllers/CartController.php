<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    //
    public function index(){
        $cart = Session::get('cart', []);
        // dd($cart);
        $total = $this->calculateTotal($cart);
        return view('index', compact('cart', 'total'));
    }
    public function addCar(Request $request){
        // dd($request());
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        if(isset($cart[$productId])){
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,  // ⚠️ AGREGAR ESTA LÍNEA
                'name' => $request->name,
                'price' => $request->price,
                'image' => $request->image,
                'quantity' => $request->quantity,
            ];
        }
        session()->put('cart', $cart);
              return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cart_count' => $this->getCartCount($cart)
        ]);
        // return redirect()->back()->with('success', 'Producto agregado al carrito');
    }
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);

            $total = $this->calculateTotal($cart);
            $itemTotal = $cart[$productId]['price'] * $cart[$productId]['quantity'];

            return response()->json([
                'success' => true,
                'item_total' => number_format($itemTotal, 2),
                'cart_total' => number_format($total, 2)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado'
        ], 404);
    }

    /**
     * Eliminar producto del carrito
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);

            $total = $this->calculateTotal($cart);

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado',
                'cart_total' => number_format($total, 2),
                'cart_count' => $this->getCartCount($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado'
        ], 404);
    }

    /**
     * Vaciar carrito
     */
    public function clear()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Carrito vaciado'
        ]);
    }

    /**
     * Obtener datos del carrito (para AJAX)
     */
    public function getCart()
    {
        $cart = Session::get('cart', []);
        $total = $this->calculateTotal($cart);

        return response()->json([
            'cart' => $cart,
            'total' => number_format($total, 2),
            'count' => $this->getCartCount($cart)
        ]);
    }

    /**
     * Generar mensaje de WhatsApp
     */
    public function generateWhatsAppMessage(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500'
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'El carrito está vacío'
            ], 400);
        }

        $total = $this->calculateTotal($cart);

        // Construir mensaje de WhatsApp
        $message = "🛒 *NUEVO PEDIDO - DISLICORES AGS* 🛒\n\n";
        $message .= "👤 *Cliente:* {$request->name}\n";
        $message .= "📱 *Teléfono:* {$request->phone}\n";
        $message .= "📍 *Dirección:* {$request->address}\n\n";
        
        $message .= "📦 *PRODUCTOS:*\n";
        $message .= str_repeat("━", 30) . "\n\n";

        foreach ($cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $message .= "▪️ *{$item['name']}*\n";
            $message .= "   Cantidad: {$item['quantity']}\n";
            $message .= "   Precio unit: $" . number_format($item['price'], 2) . "\n";
            $message .= "   Subtotal: $" . number_format($itemTotal, 2) . "\n\n";
        }

        $message .= str_repeat("━", 30) . "\n";
        $message .= "💰 *TOTAL: $" . number_format($total, 2) . "*\n";

        if ($request->notes) {
            $message .= "\n📝 *Notas adicionales:*\n{$request->notes}\n";
        }

        $message .= "\n✅ Pedido generado automáticamente";

        // Número de WhatsApp del negocio (cambiar por el tuyo)
        $whatsappNumber = '573126151253'; // Formato: código país + número sin +
        
        // Codificar mensaje para URL
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl,
            'message' => 'Pedido preparado correctamente'
        ]);
    }

    /**
     * Calcular total del carrito
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Contar items en el carrito
     */
    private function getCartCount($cart)
    {
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
