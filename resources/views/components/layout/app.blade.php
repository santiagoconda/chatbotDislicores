<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DISLICORESAGS</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <x-chat-bot />

</head>

<body>
    <header class="main-header">
        <div class="nav-container">
            <!-- Logo -->
            <div class="header-logo">
                <a href="/" class="logo-link">
                    <span class="logo-text">DISLICORES<span class="logo-accent">AGS</span></span>
                </a>
            </div>

            <!-- Navigation Desktop -->
            <nav class="header-nav" id="mainNav">
                <a href="" class="nav-link active">
                    <span>Inicio</span>
                </a>
                <a href="" class="nav-link">
                    <span>Productos</span>
                </a>
                <a href="{{route('on.sale')}}" class="nav-link">
                    <span>Ofertas</span>
                    <span class="nav-badge">Nuevo</span>
                </a>


                <a href="/contacto" class="nav-link">
                    <span>Contacto</span>
                </a>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <!-- Search Button -->
                <button class="action-btn search-btn" aria-label="Buscar">
                    <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="action-btn cart-btn" aria-label="Carrito de compras">
                    <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="cart-badge" id="cart-badge">3</span>
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Menú">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-nav" id="mobileNav">
            <nav class="mobile-nav-links">
                <a href="" class="mobile-nav-link active">Inicio</a>
                <a href="" class="mobile-nav-link">Productos</a>
                <a href="{{route('on.sale')}}" class="mobile-nav-link">
                    Ofertas
                    <span class="nav-badge-mobile">Nuevo</span>
                </a>
                <a href="/contacto" class="mobile-nav-link">Contacto</a>
            </nav>
        </div>
    </header>

    <main class="flex-1 container mx-auto py-8">
        {{ $slot }}
    </main>

    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                        <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                </div>
                <h3 class="feature-title">Envío Nacional</h3>
                <p class="feature-text">Entrega rápida y segura a todo el país con tracking en tiempo real
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>
                <h3 class="feature-title">Mejor Precio</h3>
                <p class="feature-text">Garantizamos los mejores precios del mercado en productos premium
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                </div>
                <h3 class="feature-title">Autenticidad</h3>
                <p class="feature-text">Todos nuestros productos son 100% originales y certificados</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                <h3 class="feature-title">Packaging Premium</h3>
                <p class="feature-text">Empaque elegante y seguro, perfecto para regalar</p>
            </div>
        </div>
    </div>
    <footer class="footer">

        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo">
                        <!-- <div class="logo-icon">
            <img src="Logos/DislicoresAGS10KB.png" alt="">
          </div> -->
                        <!-- <span class="logo-text">DISLICORES<span class="logo-accent">AGS</span></span> -->
                    </div>

                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Categorías</h4>
                        @foreach($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                        @endforeach
                        <!-- <a href="#">Whisky</a>
                        <a href="#">Ron</a>
                        <a href="#">Vodka</a>
                        <a href="#">Gin</a>
                        <a href="#">Tequila</a> -->
                    </div>

                    <div class="footer-column">
                        <h4>Ayuda</h4>
                        <a href="#">Preguntas Frecuentes</a>
                        <a href="#">Envíos</a>
                        <a href="#">Devoluciones</a>
                        <a href="#">Garantía</a>
                    </div>

                    <div class="footer-column">
                        <h4>Empresa</h4>
                        <a href="#">Sobre Nosotros</a>
                        <a href="#">Contacto</a>
                        <a href="#">Blog</a>
                        <a href="#">Términos</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>



<script>
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const mobileBtn = document.querySelector('.mobile-menu-btn');

    mobileNav.classList.toggle('active');
    mobileBtn.classList.toggle('active');

    // Animate hamburger lines
    const lines = mobileBtn.querySelectorAll('.hamburger-line');
    if (mobileNav.classList.contains('active')) {
        lines[0].style.transform = 'rotate(45deg) translateY(7px)';
        lines[1].style.opacity = '0';
        lines[2].style.transform = 'rotate(-45deg) translateY(-7px)';
    } else {
        lines[0].style.transform = 'none';
        lines[1].style.opacity = '1';
        lines[2].style.transform = 'none';
    }
}

// Add scroll effect
let lastScroll = 0;
const header = document.querySelector('.main-header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 50) {
        header.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.3)';
        header.style.background = 'rgba(10, 10, 10, 0.95)';
    } else {
        header.style.boxShadow = 'none';
        header.style.background = 'rgba(10, 10, 10, 0.8)';
    }

    lastScroll = currentScroll;
});
</script>

</html>