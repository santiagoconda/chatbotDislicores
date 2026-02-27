    <x-layout.app>
        <!-- <div class="demo-card"> -->
        <div class="section-header">
            <h2>{{ $category->name }}</h2>
            <div class="line"></div>
        </div>
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