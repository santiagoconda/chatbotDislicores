    <x-layout.app>
                <div class="demo-card">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="features-grid-cards">
            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </x-layout.app>