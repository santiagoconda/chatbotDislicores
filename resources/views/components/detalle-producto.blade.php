<!-- <div>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text"><small class="text-muted">Categoría: {{ $product->category->name }}</small></p>        
</div> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards - Diseño Inclinado</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #e0e0e0 0%, #f5f5f5 100%);
            font-family: 'Arial', sans-serif;
            padding: 80px 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 1400px;
            width: 100%;
        }

        /* Ribbon "IMAGE NOT INCLUDED" */
        .ribbon {
            position: fixed;
            top: 50px;
            left: -80px;
            background: white;
            color: #333;
            padding: 15px 100px;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 2px;
            transform: rotate(-45deg);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .cards-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            perspective: 1000px;
        }

        .product-card {
            position: relative;
            width: 100%;
            height: 550px;
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
            background: linear-gradient(135deg, #1dd1a1 0%, #10ac84 100%);
        }

        .card-purple .background-shape {
            background: linear-gradient(135deg, #a55eea 0%, #8854d0 100%);
        }

        .card-orange .background-shape {
            background: linear-gradient(135deg, #ff8a5b 0%, #ff6348 100%);
        }

        /* Tarjeta blanca principal */
        .card-content {
            position: absolute;
            right: 0;
            top: 50px;
            width: 85%;
            height: calc(100% - 50px);
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 40px 30px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 2;
        }

        /* Precio en la esquina */
        .price {
            position: absolute;
            top: -30px;
            right: 40px;
            background: white;
            color: #333;
            font-size: 42px;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            z-index: 3;
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
            background: #1dd1a1;
        }

        .card-purple .dot {
            background: #a55eea;
        }

        .card-orange .dot {
            background: #ff8a5b;
        }

        /* Imagen del producto */
        .product-image-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
        }

        .product-image {
            max-width: 250px;
            max-height: 250px;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }

        /* Contenido del producto */
        .product-info {
            text-align: center;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .product-title-line1 {
            display: block;
        }

        .product-title-line2 {
            display: block;
        }

        .card-cyan .product-title-line2 {
            color: #1dd1a1;
        }

        .card-purple .product-title-line2 {
            color: #a55eea;
        }

        .card-orange .product-title-line2 {
            color: #ff8a5b;
        }

        .product-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 15px 0 25px;
        }

        /* Botón Add to Cart */
        .add-to-cart-btn {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
            letter-spacing: 1px;
        }

        .add-to-cart-btn:hover {
            background: #34495e;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 62, 80, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cards-wrapper {
                grid-template-columns: 1fr;
            }

            .product-card {
                height: 500px;
            }

            .price {
                font-size: 36px;
                right: 30px;
            }

            .dots-pattern {
                left: -50px;
                gap: 10px;
            }

            .dot {
                width: 15px;
                height: 15px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="cards-wrapper">
            <!-- Card 1 - Cyan/Green -->
            <div class="product-card card-cyan">
                <div class="background-shape"></div>
                
                <div class="dots-pattern">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>

                <div class="card-content">
                    <div class="price">$69</div>
                    
                    <div class="product-image-wrapper">
                        <img src="https://via.placeholder.com/250x250/1dd1a1/ffffff?text=Smartwatch" alt="Product" class="product-image">
                    </div>

                    <div class="product-info">
                        <h3 class="product-title">
                            <span class="product-title-line1">PRODUCT</span>
                            <span class="product-title-line2">{{ $product->name }}</span>
                        </h3>
                        <p class="product-description">
                            Lorem ipsum dolor sit amet, ederereli consectetuer adipis.
                        </p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>