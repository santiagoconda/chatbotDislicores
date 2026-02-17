   <div class="demo-card">
       <h1 class="hero-title">
           El arte de<br>
           <em>lo extraordinario</em><br>
           en cada copa.
       </h1>
       <div class="search-wrapper">
           <div class="search-box">
               <input class="search-input" type="text" placeholder="Busca tu bebida perfecta...">
                <button class="action-btn search-btn" aria-label="Buscar">
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
   <style>
/* =========================
   THEME COLORS (premium)
========================= */
:root {
    --bg-dark: #0b0b0f;
    --bg-soft: #12121a;
    --wine: #6b0f1a;
    --purple: #3b1c71;
    --gold: #d4af37;
    --cream: #f5f3ef;
    --muted: #a7a7b3;
    --glass: rgba(255, 255, 255, 0.06);
    --border: rgba(255, 255, 255, 0.12);
}

/* =========================
   HERO BACKGROUND
========================= */


/* =========================
   HERO TITLE
========================= */
.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3.2rem, 6vw, 5.5rem);
    font-weight: 300;
    line-height: 1.05;
    letter-spacing: 1px;
    margin-bottom: 28px;

    /* degradado elegante */
    background: linear-gradient(90deg, #ffffff, #dcd6ff 40%, #ffffff 80%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    text-shadow:
        0 0 30px rgba(255, 255, 255, .05),
        0 0 60px rgba(59, 28, 113, .2);

    animation: fadeUp .9s ease both;
}

.hero-title em {
    font-style: normal;
    color: var(--gold);
    -webkit-text-fill-color: var(--gold);
}

/* =========================
   SEARCH WRAPPER
========================= */
.search-wrapper {
    max-width: 720px;
    margin-top: 24px;
}


/* =========================
   SEARCH BOX (glass)
========================= */
.search-box {
    display: flex;
    align-items: center;
    background: var(--glass);
    backdrop-filter: blur(14px);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 6px;
    transition: .3s ease;
}

.search-box:focus-within {
    border-color: rgba(212, 175, 55, .5);
    box-shadow:
        0 0 0 1px rgba(212, 175, 55, .2),
        0 0 25px rgba(212, 175, 55, .25);
}

/* =========================
   INPUT
========================= */
.search-input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    font-size: 1rem;
}

.search-input::placeholder {
    color: #8b8b9a;
}

/* =========================
   BUTTON
========================= */



/* =========================
   TAGS
========================= */
.search-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 18px;
}

.search-tag {
    font-size: .82rem;
    padding: 8px 14px;
    border-radius: 999px;
    cursor: pointer;

    background: rgba(255, 255, 255, .05);
    border: 1px solid rgba(255, 255, 255, .1);
    color: #dcdcdc;

    transition: .25s ease;
}

.search-tag:hover {
    background: linear-gradient(135deg, var(--wine), var(--purple));
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, .4);
}

/* =========================
   ANIMATION
========================= */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(18px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
   </style>


   </style>