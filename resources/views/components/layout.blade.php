   <x-chat-bot/>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Dislicores ags</title>
</head>

<header class="main-header">
    <div class="header-container">
        <!-- Logo -->
        <div class="header-logo">
            <a href="/">
                <span class="logo-text">DISLICORES<span class="logo-accent">AGS</span></span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="header-nav">
            <a href="/" class="nav-link">Inicio</a>
            <a href="/productos" class="nav-link">Productos</a>
            <a href="/ofertas" class="nav-link">Ofertas</a>
            <a href="/contacto" class="nav-link">Contacto</a>
        </nav>

        <!-- Cart Icon -->
        <div class="header-actions">
            <a href="{{ route('cart.index') }}" class="cart-icon-wrapper">
                <svg class="cart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span id="cart-badge" style="display: none;">0</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>
</header>

<style>
/* Header Styles */
.main-header {
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 0;
    z-index: 100;
    padding: 1rem 0;
}

.header-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.header-logo a {
    text-decoration: none;
}

.logo-text {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.02em;
}

.logo-accent {
    color: #d4af37;
}

.header-nav {
    display: flex;
    gap: 2rem;
    flex: 1;
    justify-content: center;
}

.nav-link {
    color: #1a1a1a;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: color 0.2s ease;
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #d4af37, #c19b2a);
    transition: width 0.3s ease;
}

.nav-link:hover {
    color: #d4af37;
}

.nav-link:hover::after {
    width: 100%;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cart-icon-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.cart-icon-wrapper:hover {
    background: linear-gradient(135deg, #d4af37, #c19b2a);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
}

.cart-icon {
    width: 24px;
    height: 24px;
    color: #1a1a1a;
    transition: color 0.3s ease;
}

.cart-icon-wrapper:hover .cart-icon {
    color: white;
}

#cart-badge {
    position: absolute;
    top: -6px;
    right: -6px;
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

.mobile-menu-btn {
    display: none;
    width: 44px;
    height: 44px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
}

.mobile-menu-btn svg {
    width: 24px;
    height: 24px;
    color: #1a1a1a;
}

/* Responsive */
@media (max-width: 768px) {
    .header-nav {
        display: none;
    }

    .mobile-menu-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>

<script>
function toggleMobileMenu() {
    // Implementar toggle de menú móvil
    console.log('Toggle mobile menu');
}
</script>