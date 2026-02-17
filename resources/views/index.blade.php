<x-layout.app>
<div class="cart-container">
    <div class="cart-header">
        <h1 class="cart-title">🛒 Mi Carrito</h1>
        <p class="cart-subtitle">Revisa tus productos antes de realizar el pedido</p>
    </div>
    @if(empty($cart))
        <div class="empty-cart">
            <h2>Tu carrito está vacío</h2>

            <a href="{{ route('index') }}" class="btn-primary">
                Ver productos
            </a>
        </div>
    @else
        <div class="cart-content">
            <div class="cart-items">
                @foreach($cart as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}">
                    <img
                        src="{{asset('storage/'.$item['image'] ?? '/img/no-image.png')}}"
                        class="item-img">

                    <div class="item-details">
                        <h3>{{ $item['name'] }}</h3>
                        <p>$ {{ number_format($item['price'],0,',','.') }}</p>
                        <div class="qty-controls">
                            <button class="qty-btn" data-qty data-id="{{ $item['id'] }}" data-amount="-1">
                                −
                            </button>

                            <input
                                class="qty-input"
                                type="number"
                                min="1"
                                value="{{ $item['quantity'] }}"
                                data-id="{{ $item['id'] }}"
                                data-qty-input
                            >

                            <button
                                class="qty-btn"
                                data-qty
                                data-id="{{ $item['id'] }}"
                                data-amount="1">
                                +
                            </button>

                        </div>
                    </div>


                    <div class="item-actions">

                        <span class="item-total">
                            $ {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
                        </span>

                        <button
                            class="btn-remove"
                            data-remove="{{ $item['id'] }}">
                            🗑
                        </button>

                    </div>

                </div>
                @endforeach

            </div>
            <div class="cart-summary">
                <h2>Total</h2>
                <p class="summary-total">
                    $ <span id="cart-total">{{ number_format($total,0,',','.') }}</span>
                </p>

                <button id="checkoutBtn" class="btn-checkout">
                    Finalizar pedido por WhatsApp
                </button>

                <button id="clearCartBtn" class="btn-clear">
                    Vaciar carrito
                </button>

            </div>

        </div>
    @endif

</div>


<div id="checkoutModal" class="modal">

    <div class="modal-overlay"></div>

    <div class="modal-content">

        <form id="checkoutForm">

            <div class="form-group">
                <label for="customer_name">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Nombre Completo *
                </label>
                <input type="text" id="customer_name" name="name" required placeholder="Ej: Juan Pérez">
            </div>

            <div class="form-group">
                <label for="customer_phone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Teléfono / WhatsApp *
                </label>
                <input type="tel" id="customer_phone" name="phone" required placeholder="Ej: 300 123 4567">
            </div>

            <div class="form-group">
                <label for="customer_address">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Dirección de Entrega *
                </label>
                <textarea id="customer_address" name="address" required rows="3" placeholder="Calle, número, barrio, ciudad..."></textarea>
            </div>

            <div class="form-group">
                <label for="customer_notes">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Notas Adicionales (opcional)
                </label>
                <textarea id="customer_notes" name="notes" rows="2" placeholder="Instrucciones especiales, referencias, etc."></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
                Enviar Pedido por WhatsApp
            </button>
        </form>

    </div>
</div>
</x-layout.app>    







