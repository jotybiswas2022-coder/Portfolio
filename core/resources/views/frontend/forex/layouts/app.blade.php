<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0D0D0D">
    <meta name="color-scheme" content="dark">
    <title>@yield('title', 'DarkEAs — Premium Expert Advisors')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/forex.js'])
    <style>
    /* ===== SHARED STYLES ===== */
    .section-padding { padding-top: 6rem; padding-bottom: 6rem; }
    @media (min-width: 768px) { .section-padding { padding-top: 8rem; padding-bottom: 8rem; } }
    .badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.375rem 1rem;
        background: rgba(0,174,239,0.06); border: 1px solid rgba(0,174,239,0.15);
        border-radius: 9999px; font-size: 0.75rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase; color: #00AEEF;
        margin-bottom: 1.5rem;
    }
    .badge-dot { width:6px; height:6px; border-radius:50%; background:#00FF9F; animation:pulse-dot 2s ease-in-out infinite; }
    @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:0.4} }
    .section-title {
        font-family:'Bebas Neue','Oswald',sans-serif;
        font-size:clamp(2rem,5vw,3.5rem); font-weight:700; line-height:1.1;
        color:#EAEAEA; margin-bottom:1rem;
    }
    .section-subtitle {
        font-size:clamp(0.95rem,1.2vw,1.1rem);
        color:rgba(234,234,234,0.5); max-width:36rem; margin:0 auto; line-height:1.6;
    }
    .card {
        background:rgba(17,17,17,0.6); border:1px solid rgba(255,255,255,0.06);
        border-radius:1rem; padding:1.5rem; transition:all 0.3s ease;
    }
    .card:hover { border-color:rgba(0,174,239,0.2); background:rgba(17,17,17,0.8); }
    .btn-primary {
        display:inline-flex; align-items:center; gap:0.5rem;
        padding:0.875rem 2rem;
        background:linear-gradient(135deg,#00AEEF,#0095CC);
        color:white; font-weight:600; font-size:1rem;
        border-radius:0.75rem; transition:all 0.3s ease;
    }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,174,239,0.25); }
    .btn-outline {
        display:inline-flex; align-items:center; gap:0.5rem;
        padding:0.875rem 2rem;
        border:1px solid rgba(0,174,239,0.25);
        background:rgba(0,174,239,0.04);
        color:#EAEAEA; font-weight:600; font-size:1rem;
        border-radius:0.75rem; transition:all 0.3s ease;
    }
    .btn-outline:hover { border-color:#00AEEF; background:rgba(0,174,239,0.08); box-shadow:0 0 20px rgba(0,174,239,0.12); }
    .gradient-text {
        background:linear-gradient(135deg,#00AEEF,#00FF9F);
        -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
    }
    .reveal { opacity:0; transform:translateY(24px); transition:all 0.6s ease; }
    .reveal.visible { opacity:1; transform:translateY(0); }
    .grid-bg {
        background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);
        background-size:64px 64px;
    }
    .hero-orb { position:absolute; border-radius:50%; filter:blur(100px); pointer-events:none; }
    .hero-orb-1 { width:500px;height:500px; background:rgba(0,174,239,0.08); top:-200px;right:-200px; }
    .hero-orb-2 { width:400px;height:400px; background:rgba(0,255,159,0.05); bottom:-150px;left:-150px; }
    .stat-divider { width:1px; height:3rem; background:linear-gradient(180deg,rgba(0,174,239,0.3),transparent); }
    @keyframes logo-scroll { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
    .logo-scroll { animation:logo-scroll 25s linear infinite; }
    .logo-scroll-wrapper:hover .logo-scroll { animation-play-state:paused; }
    .check-item { display:flex; align-items:flex-start; gap:0.625rem; font-size:0.9rem; color:rgba(234,234,234,0.65); line-height:1.5; }
    .check-icon { flex-shrink:0; width:1.25rem;height:1.25rem; margin-top:0.125rem; color:#00FF9F; }
    .star { color:#f59e0b; fill:currentColor; width:1rem; height:1rem; }
    .pricing-popular { border:1px solid #00AEEF; background:linear-gradient(180deg,rgba(0,174,239,0.06),rgba(17,17,17,0.6)); position:relative; }
    .pricing-popular-badge { position:absolute; top:-0.75rem; left:50%; transform:translateX(-50%); background:linear-gradient(135deg,#00AEEF,#0095CC); color:white; font-size:0.75rem; font-weight:700; padding:0.25rem 1rem; border-radius:9999px; white-space:nowrap; }
    .icon-box { width:2.75rem; height:2.75rem; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .icon-box-brand { background:rgba(0,174,239,0.1); color:#00AEEF; }
    .icon-box-profit { background:rgba(0,255,159,0.1); color:#00FF9F; }
    .accordion-btn { width:100%; display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; background:none; border:none; color:#EAEAEA; font-size:0.95rem; font-weight:500; text-align:left; cursor:pointer; transition:color 0.2s ease; }
    .accordion-btn:hover { color:#00AEEF; }
    .accordion-chevron { width:1.25rem; height:1.25rem; color:#00AEEF; transition:transform 0.3s ease; flex-shrink:0; }
    .accordion-content { max-height:0; overflow:hidden; transition:max-height 0.3s ease; }
    .accordion-content-inner { padding:0 1.25rem 1.25rem; font-size:0.9rem; color:rgba(234,234,234,0.55); line-height:1.7; }
    .review-card { min-width:100%; padding:0 0.5rem; }
    .review-track { display:flex; transition:transform 0.4s ease; }
    .carousel-btn { width:2.5rem; height:2.5rem; border-radius:50%; background:rgba(17,17,17,0.8); border:1px solid rgba(255,255,255,0.08); color:rgba(234,234,234,0.5); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.3s ease; }
    .carousel-btn:hover { border-color:rgba(0,174,239,0.3); color:#00AEEF; box-shadow:0 0 15px rgba(0,174,239,0.1); }
    @keyframes bar-grow { 0%{height:0% !important} 100%{height:var(--target-height)} }
    .perf-bar { animation:bar-grow 1.2s ease forwards; }
    .input-modern { background:rgba(10,10,10,0.8); border:1px solid rgba(255,255,255,0.08); transition:all 0.3s ease; color:#EAEAEA; }
    .input-modern:focus { border-color:#00AEEF; box-shadow:0 0 0 3px rgba(0,174,239,0.15); outline:none; }
    .underline-animate { position:relative; text-decoration:none; }
    .underline-animate::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:#00AEEF; transition:width 0.3s ease; }
    .underline-animate:hover::after { width:100%; }
    @media (max-width:640px) { .hero-title { font-size:clamp(2.2rem,10vw,3rem) !important; } }
    @media (prefers-reduced-motion:reduce) { *,::before,::after { animation-duration:0.01ms !important; transition-duration:0.01ms !important; } }
    .scroll-progress { position:fixed;top:0;left:0;z-index:9999;height:2px;background:linear-gradient(90deg,#00AEEF,#00FF9F);transition:width 0.1s ease; }
    @media (min-width:768px) { .md\:block { display:block !important; } }
    </style>
</head>
<body style="background-color:#0D0D0D;color:#EAEAEA;font-family:'DM Sans',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale">
    <!-- Scroll Progress Bar -->
    <div id="scrollProgress" class="scroll-progress"></div>

    <!-- Mouse Glow Effect -->
    <div id="mouseGlow" style="position:fixed;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(0,174,239,0.06) 0%,transparent 70%);pointer-events:none;z-index:0;transform:translate(-50%,-50%);transition:opacity 0.3s ease;opacity:0" class="md\:block"></div>

    @include('frontend.forex.partials.navbar')
    @include('frontend.forex.partials.toast')
    <main>@yield('content')</main>
    @include('frontend.forex.partials.footer')
    @include('frontend.forex.partials.cookie-banner')

    <!-- Back to Top Button -->
    <button id="backToTop" style="position:fixed;bottom:2rem;right:2rem;z-index:50;width:3rem;height:3rem;border-radius:9999px;background:rgba(255,255,255,0.04);border:1px solid #2a2a2a;display:flex;align-items:center;justify-content:center;color:rgba(156,163,175,1);transition:all 0.3s ease;opacity:0;transform:translateY(1rem);pointer-events:none;cursor:pointer" aria-label="Back to top" onmouseover="this.style.color='white';this.style.borderColor='#00AEEF';this.style.boxShadow='0 0 20px rgba(0,174,239,0.2)'" onmouseout="this.style.color='rgba(156,163,175,1)';this.style.borderColor='#2a2a2a';this.style.boxShadow='none'">
        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        'use strict';

        // --- Scroll Reveal Observer ---
        const revealObserver = new IntersectionObserver(function(e){
            e.forEach(function(entry){
                if(entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, {threshold: 0.1, rootMargin: '0px 0px -40px 0px'});
        document.querySelectorAll('.reveal').forEach(function(el){ revealObserver.observe(el); });

        // --- Scroll Progress Bar ---
        const scrollProgress = document.getElementById('scrollProgress');
        if (scrollProgress) {
            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
                scrollProgress.style.width = progress + '%';
            }, { passive: true });
        }

        // --- Mouse Glow Effect ---
        const mouseGlow = document.getElementById('mouseGlow');
        if (mouseGlow) {
            let mouseX = -400, mouseY = -400;
            let isVisible = true;

            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                mouseGlow.style.transform = 'translate(' + (mouseX - 200) + 'px, ' + (mouseY - 200) + 'px)';
                if (!isVisible) {
                    isVisible = true;
                    mouseGlow.style.opacity = '1';
                }
            }, { passive: true });

            document.addEventListener('mouseleave', function() {
                isVisible = false;
                mouseGlow.style.opacity = '0';
            });
        }

        // --- Back to Top ---
        const backToTop = document.getElementById('backToTop');
        if (backToTop) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    backToTop.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                } else {
                    backToTop.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                }
            }, { passive: true });

            backToTop.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // --- Navbar Scroll Effect ---
        const navbar = document.getElementById('mainNavbar');
        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.borderColor = 'rgba(255,255,255,0.06)';
                    navbar.style.background = 'rgba(10,10,10,0.85)';
                    navbar.style.backdropFilter = 'blur(16px)';
                } else {
                    navbar.style.borderColor = 'transparent';
                    navbar.style.background = 'rgba(10,10,10,0.6)';
                }
            }, { passive: true });
        }
    });
    </script>
    @stack('scripts')
</body>
</html>
