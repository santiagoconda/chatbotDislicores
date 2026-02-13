@vite('resources/css/app.css')
<div class="card-products">

    <!-- Imagen con efecto parallax -->
    <div class="relative overflow-hidden  from-gray-50 to-gray-100">

        <div class="w-full h-56 rounded-xl flex items-center justify-center overflow-hidden">
            <img src="{{ $product->images->first()?->image_path}}" class="max-h-full max-w-full object-contain">
        </div>


        <!-- Overlay gradient sutil -->
        <div
            class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>

        <!-- Badges modernos -->
        <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">

            @if($product->is_new)
            <span
                class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full shadow-lg backdrop-blur-sm animate-pulse">
                 Nuevo
            </span>
            @endif

            @if($product->is_on_sale && $product->discount_price)
            <span
                class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-rose-500 to-pink-600 text-white rounded-full shadow-lg backdrop-blur-sm">
                 -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
            </span>
            @endif

            @if($product->is_featured)
            <span
                class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-violet-600 to-purple-700 text-white rounded-full shadow-lg backdrop-blur-sm">
                 Destacado
            </span>
            @endif

        </div>

        <!-- Acciones rápidas (wishlist, quick view) -->
        <div
            class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-2 group-hover:translate-x-0">
            <button 
                class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full shadow-lg hover:bg-white hover:scale-110 transition-all duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-700 hover:text-red-500 transition-colors" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg> 
            </button>
            <button
                class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full shadow-lg hover:bg-white hover:scale-110 transition-all duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>

        <!-- Stock bajo -->
        @if($product->stock > 0 && $product->stock < $product->min_stock)
            <div
                class="absolute bottom-4 left-4 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm animate-bounce">
                ⚡ ¡Solo {{ $product->stock }} disponibles!
            </div>
            @endif

            @if($product->stock == 0)
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <span class="text-white text-lg font-bold">Agotado</span>
            </div>
            @endif

    </div>

    <!-- Info del producto -->
    <div class="p-6 flex flex-col flex-1">

        <!-- Categoría / Marca -->
        <!-- <div class="flex justify-between items-center text-xs uppercase tracking-wider mb-3">
            <span class="text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                {{ $product->category->name ?? 'Sin categoría' }}
            </span>
            <span class="text-indigo-600 font-bold">
                {{ $product->brand->name ?? '' }}
            </span>
        </div> -->

        <!-- Nombre del producto -->
        <h3 class="title-product">
            {{ $product->name }}
        </h3>

        <!-- Volumen -->


        <!-- Specs con íconos mejorados -->
        <div class="flex flex-wrap gap-2 mb-4">
            @if($product->volume)
            <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full border border-purple-200">
                {{ $product->volume }}📦</span>
            @endif

            @if($product->alcohol_percentage)
            <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full border border-purple-200">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" />
                </svg>
                {{ $product->alcohol_percentage }}% Vol
            </span>
            @endif
            @if($product->origin_country)
            <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-200">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                </svg>
                {{ $product->origin_country }}
            </span>
            @endif
            @if($product->age)
            <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full border border-amber-200">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd" />
                </svg>
                {{ $product->age }} años
            </span>
            @endif
        </div>

        <!-- Rating moderno -->
        @if($product->rating > 0)
        <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
            <div class="flex text-yellow-400 text-lg">
                @for($i = 1; $i <= 5; $i++) <span>{{ $i <= $product->rating ? '★' : '☆' }}</span>
                    @endfor
            </div>
            <span class="text-sm text-gray-500 font-medium">
                {{ number_format($product->rating, 1) }} <span class="text-gray-400">({{ $product->reviews_count ?? 0 }}
                    reseñas)</span>
            </span>
        </div>
        @endif

        <!-- Precio con diseño destacado -->
        <div class="mt-auto mb-4">

            <div class="flex items-baseline gap-3 mb-1">
                <span class="text-2xl text-gray-200 tracking-tight">
                    ${{ number_format($product->discount_price ?? $product->price, 2) }}
                </span>

                @if($product->discount_price)
                <span class="text-lg line-through text-gray-400 font-medium">
                    ${{ number_format($product->price, 2) }}
                </span>
                @endif
            </div>

            @if($product->discount_price)
            <div
                class="inline-flex items-center gap-1 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-600 text-sm font-bold px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                        clip-rule="evenodd" />
                </svg>
                Ahorras ${{ number_format($product->price - $product->discount_price, 2) }}
            </div>
            @endif
        </div>

        <!-- Acciones con mejor diseño -->
        <div class="flex gap-3">

            @if($product->stock > 0)
            <button
                onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image ?? '' }}')"
                class="flex-1 relative bg-gradient-to-r from-[#d96314] to-[#E7B605] hover:from-[#d96314]
                hover:from-[#d96314] text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all duration-200
                shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex
                items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Agregar al carrito
            </button>
            @else
            <button disabled
                class="flex-1 bg-gray-100 text-gray-400 text-sm font-bold py-3.5 px-6 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Sin stock
            </button>
            @endif

            <a href="{{ route('products.show', $product->slug) }}"
                class="px-5 py-3.5 text-sm font-bold border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>

        </div>

        <!-- Envío gratis (opcional) -->
        @if($product->free_shipping ?? false)
        <div
            class="mt-4 flex items-center justify-center gap-2 text-xs text-emerald-600 font-semibold bg-emerald-50 py-2 px-4 rounded-lg border border-emerald-200">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                <path
                    d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
            </svg>
            Envío gratis
        </div>
        @endif

    </div>

    <!-- Efecto de brillo al hacer hover -->
    <div
        class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/10 to-transparent pointer-events-none">
    </div>

</div>
<script>
/**
 * Add to Cart Functionality
 * Include this script ONLY ONCE in your layout
 */

// Prevent multiple declarations
if (typeof window.cartFunctionsLoaded === 'undefined') {
    window.cartFunctionsLoaded = true;

    // Get CSRF token
    function getCSRFToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (!token) {
            console.error(
                'CSRF token not found. Add <meta name="csrf-token" content="{{ csrf_token() }}"> to your layout head.'
            );
            return null;
        }
        return token.content;
    }

    // Add to cart function
    window.addToCart = async function(productId, productName, productPrice, productImage = null) {
        const csrfToken = getCSRFToken();
        if (!csrfToken) {
            showNotification('❌ Error de configuración. Recarga la página.', 'error');
            return false;
        }

        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    product_id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                })
            });

            const data = await response.json();
            // console.log(data);
            if (data.success) {
                // Show success notification
                showNotification('✅ Producto agregado al carrito', 'success');

                // Update cart badge
                updateCartBadge(data.cart_count);

                return true;
            } else {
                showNotification('❌ Error al agregar producto', 'error');
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('❌ Error de conexión', 'error');
            return false;
        }
    }
    // Update cart badge in header
    window.updateCartBadge = function(count) {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';

            // Animate badge
            badge.style.animation = 'none';
            setTimeout(() => {
                badge.style.animation = 'bounce 0.5s ease';
            }, 10);
        }
    }

    // Show notification
    window.showNotification = function(message, type = 'success') {
        // Remove existing notifications
        const existing = document.querySelector('.cart-notification');
        if (existing) existing.remove();

        // Create notification
        const notification = document.createElement('div');
        notification.className = `cart-notification cart-notification-${type}`;
        notification.textContent = message;

        document.body.appendChild(notification);

        // Show with animation
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Auto hide after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Load cart count on page load
    window.loadCartCount = async function() {
        try {
            const response = await fetch('/cart/data');
            const data = await response.json();
            updateCartBadge(data.count);
        } catch (error) {
            console.error('Error loading cart:', error);
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadCartCount();
    });

    // Inject styles only once
    if (!document.querySelector('#cart-notification-styles')) {
        const styleElement = document.createElement('style');
        styleElement.id = 'cart-notification-styles';
        styleElement.textContent = `
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    font-weight: 600;
    font-size: 0.95rem;
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.cart-notification.show {
    transform: translateX(0);
}

.cart-notification-success {
    border-left: 4px solid #22c55e;
    color: #1a1a1a;
}

.cart-notification-error {
    border-left: 4px solid #ef4444;
    color: #1a1a1a;
}

@keyframes bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.cart-icon-wrapper {
    position: relative;
    display: inline-block;
}

#cart-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
}
`;
        document.head.appendChild(styleElement);
    }
}
</script>