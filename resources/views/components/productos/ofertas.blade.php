    <x-layout.app>
            <div class="section-header">
        <h2>Ofertas disponibles</h2>
        <div class="line"></div>
    </div>
        <div class="features-grid-cards">
            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </x-layout.app>