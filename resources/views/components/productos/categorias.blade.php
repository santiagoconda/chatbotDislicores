    <x-layout.app>
        <!-- <div class="demo-card"> -->
            <h2 class="logo-text">{{ $category->name }}</h2>
        <!-- </div> -->
        <div class="features-grid-cards">
            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </x-layout.app>