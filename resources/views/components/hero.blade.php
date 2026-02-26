   <div class="demo-card">
       <!-- <h1 class="hero-title">
           El arte de<br>
           <em>lo extraordinario</em><br>
           en cada copa.
       </h1> -->
       <div class="search-wrapper">
           <div class="search-box">
    
               <input class="search-input" type="text" id="slug" placeholder="Busca tu bebida perfecta...">
                <button class="action-btn" aria-label="Buscar" >
                    <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
           </div>
           <div class="search-tags">
               @foreach($categories as $category)
               <a class="search-tag" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
               @endforeach

           </div>
       </div>
   </div>
