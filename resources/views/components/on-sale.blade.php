    <x-layout.app>
        <div class="features-grid-cards">
            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </x-layout.app>