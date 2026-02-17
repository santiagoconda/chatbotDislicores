<style>
.container {
    width: 100%;
}

.cards-wrapper {
    display: grid;
    grid-template-columns: repeat(3, minmax(350px, 1fr));
    gap: 40px;
    perspective: 1000px;
}

.product-card {
    position: relative;
    width: 100%;
    height: 600px;
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-10px);
}

/* Forma geométrica de fondo inclinada */
.background-shape {
    position: absolute;
    top: 0;
    left: 0;
    width: 60%;
    height: 100%;
    border-radius: 30px;
    transform: skewY(-5deg);
    overflow: hidden;
    z-index: 1;
}

.background-shape::before {
    content: '';
    position: absolute;
    top: -20%;
    left: -10%;
    width: 120%;
    height: 140%;
    background: inherit;
}

/* Colores de fondo */
.card-cyan .background-shape {
    background: rgba(177, 100, 0, 0.35);
}

/* Tarjeta blanca principal */
.card-content {
    position: absolute;
    right: 0;
    top: 40px;
    width: 85%;
    height: calc(100% - 40px);
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    padding: 30px 25px 25px;
    display: flex;
    flex-direction: column;
    z-index: 2;
}

/* Badges superiores */
.card-content>.absolute {
    position: absolute;
    top: 15px;
    left: 15px;
}

/* Precio en la esquina - MEJORADO */
.price {

    position: absolute;
    top: -25px;
    right: 30px;
    background: white;
    color: #333;
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.32);
    z-index: 3;
    min-width: 140px;
}



.price .text-2xl {
    font-size: 28px;
    font-weight: 700;
    /* letter-spacing: -0.5px; */
}

.price .line-through {
    font-size: 16px;
}

.price>div:last-child {
    margin-top: 6px;
    font-size: 11px;
    padding: 4px 10px;
}

/* Patrón de puntos decorativos a la izquierda */
.dots-pattern {
    position: absolute;
    left: -60px;
    top: 50%;
    transform: translateY(-50%);
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    z-index: 2;
}

.dot {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    opacity: 0.9;
}

.card-cyan .dot {
    background: #ff8a5b;
}

/* Imagen del producto - MEJORADO */
.product-image-wrapper {
    margin-top: 50px;
    margin-bottom: 20px;
    flex-shrink: 0;
}

.product-image-wrapper .w-full {
    height: 200px;
}

.product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15));
}

/* Contenido del producto - MEJORADO */
.product-info {
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 12px;
    flex: 1;
    justify-content: flex-end;
}

/* Título - MEJORADO */
.product-title {
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0;
    line-height: 1.2;
}

.product-title-line2 {
    display: block;
}

.card-cyan .product-title-line2 {
    color: #250546;
}

/* Rating - MEJORADO */
.product-info>.flex.items-center.gap-3 {
    justify-content: center;
    margin-bottom: 8px;
    padding-bottom: 12px;
}

.product-info .flex.text-yellow-400 {
    font-size: 16px;
    gap: 2px;
}

.product-info .text-sm.text-gray-500 {
    font-size: 13px;
}

/* Tags de características - MEJORADO */
.product-description {
    margin: 0;
}

.product-description .flex.flex-wrap {
    justify-content: center;
    gap: 6px;
    margin-bottom: 12px;
}

.product-description .flex.flex-wrap>span {
    font-size: 11px;
    padding: 6px 12px;
}

.product-description .flex.flex-wrap svg {
    width: 12px;
    height: 12px;
}

/* Botones - MEJORADO */
.product-info>.flex.gap-3 {
    margin-top: 12px;
    gap: 10px;
}

.product-info button,
.product-info a {
    font-size: 13px;
    font-weight: 700;
    padding: 14px 20px;
    border-radius: 14px;
}

.product-info button svg,
.product-info a svg {
    width: 18px;
    height: 18px;
}

/* Botón principal más destacado */
.product-info button:first-child {
    box-shadow: 0 6px 20px rgba(217, 99, 20, 0.3);
}

/* Botón secundario */
.product-info a:last-child {
    padding: 14px 16px;
}

/* Responsive - MEJORADO */
@media (max-width: 768px) {
    .cards-wrapper {
        grid-template-columns: 1fr;
    }

    .product-card {
        height: 580px;
    }

    .price {
        top: -20px;
        right: 25px;
        padding: 10px 16px;
        min-width: 120px;
    }

    .price .text-2xl {
        font-size: 24px;
    }

    .price .line-through {
        font-size: 14px;
    }

    .dots-pattern {
        left: -50px;
        gap: 10px;
    }

    .dot {
        width: 15px;
        height: 15px;
    }

    .product-image-wrapper {
        margin-top: 45px;
    }

    .product-image-wrapper .w-full {
        height: 180px;
    }

    .product-title {
        font-size: 18px;
    }

    .product-info button,
    .product-info a {
        font-size: 12px;
        padding: 12px 16px;
    }
}

@media (max-width: 480px) {
    .product-card {
        height: 560px;
    }

    .card-content>.absolute {
        top: 12px;
        left: 12px;
    }

    .card-content>.absolute span {
        font-size: 10px;
        padding: 5px 10px;
    }

    .product-description .flex.flex-wrap>span {
        font-size: 10px;
        padding: 5px 10px;
    }

    .product-info .flex.gap-3 {
        flex-direction: column;
        gap: 8px;
    }

    .product-info a:last-child {
        padding: 12px 16px;
    }
}
</style>

<div class="container">
    <div class="cards-wrapper">
        <!-- Card 1 -->
        <div class="product-card card-cyan">
            <div class="background-shape"></div>

            <div class="card-content">
                <!-- Badges en la parte superior -->
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

                <!-- Precio -->
                <div class="price">
                    <div class="">
                        <span class="text-2xl tracking-tight">
                            ${{ number_format($product->discount_price ?? $product->price) }}
                        </span>

                        @if($product->discount_price)
                        <span class="text-lg line-through text-gray-400 font-medium">
                            ${{ number_format($product->price) }}
                        </span>
                        @endif
                    </div>

                </div>

                <!-- Imagen del producto -->
                <div class="product-image-wrapper">
                    <div class="w-full h-56 rounded-xl flex items-center justify-center overflow-hidden">
                        <img src="{{ $product->images->first()?->image_path }}"
                            class="max-h-full max-w-full object-contain">
                    </div>
                </div>

                <!-- Información del producto -->
                <div class="product-info">
                    <!-- Título -->
                    <h3 class="product-title">
                        <span class="product-title-line2">{{ $product->name }}</span>
                    </h3>

                    <!-- Rating -->
                    @if($product->rating > 0)
                    <div class="flex items-center border-b border-gray-100">
                        <div class="flex text-yellow-400 text-lg">
                            @for($i = 1; $i <= 5; $i++) <span>{{ $i <= $product->rating ? '★' : '☆' }}</span>
                                @endfor
                        </div>
                        <span class="text-sm text-gray-500 font-medium">
                            {{ number_format($product->rating, 1) }}
                            <span class="text-gray-400">({{ $product->reviews_count ?? 0 }} reseñas)</span>
                        </span>
                    </div>
                    @endif

                    <!-- Tags de características -->
                    <p class="product-description">
                        @if($product->discount_price)
                    <div
                        class="inline-flex items-center gap-1 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-600 text-sm font-bold px-3 py-1 rounded-full">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Ahorras ${{ number_format($product->price - $product->discount_price) }}
                    </div>
                    @endif
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($product->volume)
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full border border-purple-200">
                            {{ $product->volume }} 📦
                        </span>
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
                    </p>

                    <!-- Botones de acción -->
                    <div class="flex gap-3">
                        @if($product->stock > 0)
                        <button
                            onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image ?? '' }}')"
                            class="flex-1 relative bg-gradient-to-r from-[#d96314] to-[#E7B605] hover:from-[#d96314] text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Sin stock
                        </button>
                        @endif
<!-- 
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="px-5 py-3.5 text-sm font-bold border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
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