<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>DISLICORES AGS</title> -->
    @vite('resources/css/products.css')

</head>
<header>
    <x-layout.app>
    </x-layout.app>
</header>

<body>
    <div class="demo-content">
        <!-- <div class="demo-card">
            <h2>DESCUBRE LA EXELENCIA EN CADA BOTELLA</h2>
            <p>Llevamos el sabor de la celebración hasta tu mesa, para que cada momento con familia y amigos sea inolvidable</p>
        </div> -->
        <div class="demo-card">
            <div class="features-grid">
                @foreach($products as $product)
                @include('components.product-card')
                @endforeach
            </div>
        </div>
        <div class="demo-card">
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
        </div>

    </div>





</body>
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
                <!-- <p class="footer-description">
          Calidad, autenticidad y servicio excepcional.
        </p> -->
            </div>

            <div class="footer-links">
                <div class="footer-column">
                    <h4>Categorías</h4>
                    <a href="#">Whisky</a>
                    <a href="#">Ron</a>
                    <a href="#">Vodka</a>
                    <a href="#">Gin</a>
                    <a href="#">Tequila</a>
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

</html>