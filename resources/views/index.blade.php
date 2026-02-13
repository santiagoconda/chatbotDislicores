<x-layout.app/>
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



{{-- VITE --}}
@vite('resources/js/addcar.js')

<style>
/* Cart Styles */
.cart-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
    
}

.cart-header {
    text-align: center;
    margin-bottom: 3rem;
}

.cart-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.cart-title svg {
    width: 40px;
    height: 40px;
    color: #d47e37;
}

.cart-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 4rem 2rem;
    /* background: white; */
}
.empty-cart-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-cart-icon svg {
    width: 60px;
    height: 60px;
    color: #9ca3af;
}

.empty-cart h2 {
    font-size: 1.8rem;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.empty-cart p {
    color: #6c757d;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

/* Cart Content */
.cart-content {
      color:#ffff;

    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;


}

@media (max-width: 1024px) {
    .cart-content {
        grid-template-columns: 1fr;
    }
}

/* Cart Items */
.cart-items {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    
}

.cart-item {
    background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  padding: 3rem;
  margin-bottom: 2rem;
}

.cart-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.item-image {
    width: 100px;
    height: 100px;
    border-radius: 12px;
    overflow: hidden;
    background: #f8f9fa;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-image-placeholder svg {
    width: 50px;
    height: 50px;
    color: #9ca3af;
}

.item-details {
    display:flex;
    
}

.item-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.item-price {
    color: #d4af37;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.item-quantity {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.qty-btn {
    width: 32px;
    height: 32px;
    border: 2px solid #e5e7eb;
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.qty-btn:hover {
    border-color: #d4af37;
    background: #fffbf0;
}

.qty-btn svg {
    width: 16px;
    height: 16px;
    color: #1a1a1a;
}

.qty-input {
    width: 60px;
    height: 32px;
    text-align: center;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
}

.item-actions {
    text-align: right;
}

.item-total {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.btn-remove {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #fee;
    color: #ef4444;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-remove:hover {
    background: #ef4444;
    color: white;
}

.btn-remove svg {
    width: 16px;
    height: 16px;
}

/* Cart Summary */
.cart-summary {
        background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  padding: 3rem;
  margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    height: fit-content;
    position: sticky;
    top: 2rem;

}

.summary-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    color: #6c757d;
}

.summary-value {
    font-weight: 600;
    color: #1a1a1a;
}

.summary-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 1.5rem 0;
}

.summary-total {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 2rem;
}

.btn-primary,
.btn-checkout {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #d4af37, #c19b2a);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-primary:hover,
.btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(212, 175, 55, 0.3);
}

.btn-checkout svg {
    width: 20px;
    height: 20px;
}

.btn-clear {
    width: 100%;
    padding: 0.75rem;
    background: white;
    color: #6c757d;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 1rem;
    transition: all 0.2s ease;
}

.btn-clear:hover {
    border-color: #ef4444;
    color: #ef4444;
}

.trust-badges {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.trust-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    text-align: center;
}

.trust-badge svg {
    width: 32px;
    height: 32px;
    color: #d4af37;
}

.trust-badge span {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 600;
}

/* Modal */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal.active {
    display: flex;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 20px;
    width: 100%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: modalSlideUp 0.3s ease;
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    padding: 2rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.modal-close {
    width: 36px;
    height: 36px;
    border: none;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.modal-close:hover {
    background: #e9ecef;
    transform: rotate(90deg);
}

.modal-close svg {
    width: 20px;
    height: 20px;
    color: #1a1a1a;
}

/* Form */
form {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.form-group label svg {
    width: 18px;
    height: 18px;
    color: #d4af37;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-family: inherit;
    font-size: 1rem;
    transition: all 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #d4af37;
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.btn-submit {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(37, 211, 102, 0.3);
}

.btn-submit svg {
    width: 20px;
    height: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .cart-item {
        grid-template-columns: 80px 1fr;
        gap: 1rem;
    }

    .item-actions {
        grid-column: 1 / -1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .cart-summary {
        position: static;
    }
}
</style>


