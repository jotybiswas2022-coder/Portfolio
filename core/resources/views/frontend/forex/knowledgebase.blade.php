@extends('frontend.forex.layouts.app')

@section('title', 'Knowledge Base — Core Trading Solutions')

@section('content')
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:40vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem;width:100%;text-align:center">
        <div class="badge animate-fade-in-up"><span class="badge-dot"></span> Learning Center</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:3rem;font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Knowledge <span class="gradient-text">Base</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:1.125rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">Find answers, guides, and tutorials</p>

        <!-- Search -->
        <div style="max-width:36rem;margin:0 auto;animation:fadeInUp 0.6s ease 0.3s both">
            <div style="position:relative">
                <svg style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);width:1.25rem;height:1.25rem;color:rgba(234,234,234,0.3);transition:color 0.3s;pointer-events:none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="kbSearch" oninput="filterArticles()" placeholder="Search articles..." style="width:100%;background:rgba(10,10,10,0.8);border:1px solid #2a2a2a;border-radius:0.75rem;padding:1rem 1rem 1rem 3rem;color:#EAEAEA;font-size:0.875rem;transition:all 0.3s;box-sizing:border-box" onfocus="this.style.borderColor='#00AEEF';this.style.boxShadow='0 0 0 3px rgba(0,174,239,0.12)'" onblur="this.style.borderColor='#2a2a2a';this.style.boxShadow='none'">
            </div>
        </div>
    </div>
</section>

<!-- ==================== CONTENT ==================== -->
<section style="padding-top:1rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;right:0;transform:translate(50%,-50%);opacity:0.03;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.kb-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.kb-px{padding-left:2rem;padding-right:2rem}}
            .cat-btn{width:100%;text-align:left;padding:0.5rem 0.75rem;border-radius:0.5rem;font-size:0.875rem;transition:all 0.2s;cursor:pointer;display:flex;align-items:center;gap:0.5rem;background:transparent;border:none;color:rgba(234,234,234,0.6)}
            .cat-btn:hover{color:#EAEAEA;background:rgba(255,255,255,0.04)}
            .cat-btn.active{color:#00AEEF;background:rgba(0,174,239,0.05)}
            .kb-input{width:100%;background:rgba(10,10,10,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.75rem;padding:0.875rem 1rem;font-size:0.875rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box}
            .kb-input:focus{border-color:#00AEEF;box-shadow:0 0 0 3px rgba(0,174,239,0.15);outline:none}
        </style>
        <div style="display:grid;grid-template-columns:1fr;gap:2rem">
            <style>@media (min-width:1024px){.kb-grid{grid-template-columns:1fr 3fr}}</style>

            <!-- Categories Sidebar -->
            <div>
                <div style="background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.25rem;position:sticky;top:7rem" class="reveal">
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem">
                        <svg style="width:1rem;height:1rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Categories
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:0.25rem">
                        <button onclick="filterByCategory('all')" class="cat-btn active" data-cat="all" style="color:#00AEEF;background:rgba(0,174,239,0.05)">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-4-4m4 4l-4 4"/></svg>
                            All Categories
                        </button>
                        @foreach($categories as $cat)
                        <button onclick="filterByCategory('{{ $cat }}')" class="cat-btn" data-cat="{{ $cat }}">
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:rgba(0,174,239,0.5);display:inline-block"></span>
                            {{ $cat }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Articles -->
            <div>
                <div id="kbArticles" style="display:flex;flex-direction:column;gap:1rem">
                    @foreach($articles as $i => $article)
                    <div class="kb-article" style="background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;transition:all 0.3s" data-category="{{ $article['category'] }}" data-title="{{ strtolower($article['title']) }}" onmouseover="this.style.borderColor='rgba(0,174,239,0.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem">
                            <span style="padding:0.25rem 0.625rem;background:rgba(0,174,239,0.05);color:#00AEEF;font-size:0.75rem;border-radius:9999px;border:1px solid rgba(0,174,239,0.15)">{{ $article['category'] }}</span>
                            <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">{{ $article['date'] }}</span>
                            <span style="margin-left:auto;color:rgba(234,234,234,0.2);font-size:0.75rem;display:flex;align-items:center;gap:0.25rem">
                                <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ rand(3, 15) }} min read
                            </span>
                        </div>
                        <h3 style="color:#EAEAEA;font-weight:600;font-size:1rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">{{ $article['title'] }}</h3>
                        <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">{{ Str::limit($article['content'], 160) }}</p>
                        <button onclick="toggleArticle(this)" style="color:#00AEEF;font-size:0.875rem;margin-top:0.75rem;cursor:pointer;display:inline-flex;align-items:center;gap:0.25rem;background:none;border:none;padding:0" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            Read More
                            <svg style="width:0.75rem;height:0.75rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <div class="article-full" style="display:none;margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06);color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">
                            {{ $article['content'] }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No results -->
                <div id="kbNoResults" style="display:none;text-align:center;padding-top:4rem;padding-bottom:4rem">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:50%;background:#1a1a1a;border:1px solid #2a2a2a;display:flex;align-items:center;justify-content:center">
                        <svg style="width:2rem;height:2rem;color:#4b5563" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <p style="color:#9ca3af;font-size:1.125rem;margin-bottom:0.5rem">No articles found</p>
                    <p style="color:#4b5563;font-size:0.875rem">Try a different search term or category.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let activeCategory = 'all';
function filterArticles() {
    const query = document.getElementById('kbSearch').value.toLowerCase();
    const articles = document.querySelectorAll('.kb-article');
    let visible = 0;
    articles.forEach(a => {
        const title = a.dataset.title;
        const cat = a.dataset.category;
        const match = title.includes(query) && (activeCategory === 'all' || cat === activeCategory);
        a.style.display = match ? 'block' : 'none';
        if (match) visible++;
    });
    document.getElementById('kbNoResults').style.display = visible > 0 ? 'none' : 'block';
}
function filterByCategory(cat) {
    activeCategory = cat;
    document.querySelectorAll('.cat-btn').forEach(b => {
        const isActive = b.dataset.cat === cat;
        b.style.color = isActive ? '#00AEEF' : 'rgba(234,234,234,0.6)';
        b.style.background = isActive ? 'rgba(0,174,239,0.05)' : 'transparent';
    });
    filterArticles();
}
function toggleArticle(btn) {
    const content = btn.nextElementSibling;
    const isHidden = content.style.display === 'none' || content.style.display === '';
    content.style.display = isHidden ? 'block' : 'none';
    btn.innerHTML = isHidden
        ? 'Show Less <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>'
        : 'Read More <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
    if (isHidden) {
        btn.closest('.kb-article').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}
</script>
@endsection
