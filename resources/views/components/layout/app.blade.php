<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DISLICORESAGS</title>
    @vite('resources/css/layouts.css')

</head>
<body>
    <x-chatBot/>
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
                <a href="/" class="nav-link active">
                    <span>Inicio</span>
                </a>
                <a href="/productos" class="nav-link">
                    <span>Productos</span>
                </a>
                <a href="/ofertas" class="nav-link">
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
                <a href="/" class="mobile-nav-link active">Inicio</a>
                <a href="/productos" class="mobile-nav-link">Productos</a>
                <a href="/ofertas" class="mobile-nav-link">
                    Ofertas
                    <span class="nav-badge-mobile">Nuevo</span>
                </a>
                <a href="/contacto" class="mobile-nav-link">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Demo Content -->

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
</body>
</html>