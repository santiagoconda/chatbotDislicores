<div class="demo">
    <div class="section-header">
        <h2>Explorar categorías</h2>
        <div class="line"></div>
    </div>
    <div class="search-tags">
        @foreach($categories as $category)
        <a class="search-tag" href="{{ route('category.show', $category->slug) }}">
            <span class="dot"></span>
            <span>{{ $category->name }}</span>
        </a>
        @endforeach
    </div>
</div>