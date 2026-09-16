<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name', 'Portfolio') }} | {{ __('messages.home') }}</title>
    <link rel="icon" href="/core/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="/core/favicon.svg" type="image/svg+xml">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Page loading animation -->
    <style>
        /* Ensure full-width layout */
        html { width: 100%; max-width: 100%; margin: 0; padding: 0; overflow-x: hidden; }
        body { width: 100%; max-width: 100%; margin: 0; padding: 0; overflow-x: hidden; }

        /* Remove underline from ALL links across the entire site */
        a { text-decoration: none !important; }

        /* Center page layout - full width wrapper */
        #pageContent {
            width: 100%;
            overflow-x: hidden;
        }

        /* Light theme - works on all pages */
        html.light-theme {
            --bg-primary: #f8fafc;
            --bg-secondary: #f1f5f9;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-nav: rgba(248, 250, 252, 0.92);
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --border-color: rgba(59, 130, 246, 0.15);
            --border-hover: rgba(59, 130, 246, 0.35);
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.12);
            --shadow-accent: 0 10px 40px rgba(59, 130, 246, 0.2);
        }
        .light-theme .footer { background: #e2e8f0; }
        .light-theme .map-container iframe { filter: none; }

        /* ===== Loading overlay ===== */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: var(--bg-primary, #0a0f1e);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1.5rem;
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.6s ease;
        }
        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-ring {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 4px solid rgba(59, 130, 246, 0.1);
            border-top-color: #3b82f6;
            border-bottom-color: #8b5cf6;
            animation: loaderSpin 1s cubic-bezier(0.16, 1, 0.3, 1) infinite;
        }
        @keyframes loaderSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-text {
            font-family: 'Poppins', 'Hind Siliguri', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted, #64748b);
            letter-spacing: 1px;
            animation: loaderPulse 1.5s ease-in-out infinite;
        }
        @keyframes loaderPulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }
        .loader-logo {
            font-size: 1.6rem;
            font-weight: 900;
            background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: loaderGradient 3s ease infinite;
            letter-spacing: -1px;
        }
        @keyframes loaderGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Fade-in animation for page content */
        .page-content {
            width: 100%;
            opacity: 1 !important;
            animation: pageFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes pageFadeIn {
            from { opacity: 1; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== Page exit transition overlay ===== */
        .page-transition-overlay {
            position: fixed;
            inset: 0;
            z-index: 99998;
            background: var(--bg-primary, #0a0f1e);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .page-transition-overlay.active {
            opacity: 1;
        }
        html.light-theme .page-transition-overlay {
            background: var(--bg-primary, #f8fafc);
        }

        /* View Transitions API support */
        @view-transition {
            navigation: auto;
        }

        @keyframes viewTransitionFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes viewTransitionFadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-8px); }
        }

        ::view-transition-old(root) {
            animation: viewTransitionFadeOut 0.25s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        ::view-transition-new(root) {
            animation: viewTransitionFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
        }

        /* Prevent overflow from decorative elements */
        section, .hero { overflow: hidden; }

        /* ===== ONE TYPEFACE EVERYWHERE =====
           Same English font as the hero tagline (Poppins). Bengali has no
           Poppins glyphs, so it still falls back to Hind Siliguri.
           Icon fonts are pinned by their own vendor !important rules, and the
           icon classes are excluded here as a second guard. */
        html body,
        html body *:not(.bi):not([class*="bi-"]):not([class^="bi-"]):not([class*="fa-"]):not([class^="fa-"]) {
            font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif !important;
        }
        html body code, html body pre, html body kbd, html body samp {
            font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif !important;
        }
    </style>
</head>
<body>
    <script>
        // Apply saved theme immediately on ALL pages
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-theme');
        }
    </script>

    <!-- Background Music -->
    <audio id="bgMusic" src="{{ optional($account)->music ? config('app.storage_url') . $account->music : config('app.storage_url') . 'music/music.mp3' }}" loop preload="auto" autoplay muted></audio>
    <div id="musicWidget" class="music-widget" role="button" tabindex="0" aria-label="Toggle music">
        <span class="music-ring"></span>
        <span class="music-icon-box">
            <i class="bi bi-music-note-beamed"></i>
            <span class="music-eq">
                <span class="eq-bar"></span>
                <span class="eq-bar"></span>
                <span class="eq-bar"></span>
                <span class="eq-bar"></span>
            </span>
        </span>
        <span class="music-label">
            <span class="music-label-text">Music On</span>
            <span class="music-label-off">Music Off</span>
        </span>
    </div>
    <style>
        .music-widget {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99995;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
            animation: musicFloatIn 0.8s 1s cubic-bezier(0.16,1,0.3,1) both,
                       musicFloat 3s ease-in-out 1.8s infinite;
        }
        @keyframes musicFloatIn {
            from { opacity: 0; transform: translateY(30px) scale(0.7); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes musicFloat {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-6px); }
        }
        .music-widget:hover { animation-play-state: paused, paused; transform: translateY(0) scale(1.05); }

        /* Glowing ring pulse */
        .music-ring {
            position: absolute;
            left: 0;
            top: 0;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            border: 2px solid #22d3ee;
            animation: ringPulse 2s ease-in-out infinite;
        }
        .music-widget.muted .music-ring {
            border-color: #64748b;
            animation: none;
            opacity: 0.3;
        }
        @keyframes ringPulse {
            0%   { transform: scale(1);   opacity: 0.9; border-color: #22d3ee; }
            50%  { transform: scale(1.35); opacity: 0;   border-color: #a78bfa; }
            100% { transform: scale(1);   opacity: 0;   border-color: #22d3ee; }
        }

        /* Icon circle */
        .music-icon-box {
            position: relative;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #06b6d4, #3b82f6, #8b5cf6);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            color: #fff;
            font-size: 1.5rem;
            border: 2px solid rgba(255,255,255,0.35);
            box-shadow:
                0 0 18px 4px rgba(34,211,238,0.45),
                0 0 40px 8px rgba(139,92,246,0.25),
                inset 0 1px 0 rgba(255,255,255,0.35);
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1), box-shadow 0.3s ease;
        }
        .music-widget:hover .music-icon-box {
            transform: scale(1.08);
            box-shadow:
                0 0 24px 6px rgba(34,211,238,0.6),
                0 0 50px 12px rgba(139,92,246,0.35),
                inset 0 1px 0 rgba(255,255,255,0.45);
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .music-icon-box i { transition: opacity 0.2s ease; }
        .music-widget.muted .music-icon-box {
            background: linear-gradient(135deg, #475569, #334155);
            box-shadow: 0 4px 18px rgba(0,0,0,0.4);
            border-color: rgba(255,255,255,0.15);
        }

        /* Equalizer bars */
        .music-eq {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: flex-end;
            gap: 2px;
            height: 14px;
        }
        .eq-bar {
            width: 3px;
            border-radius: 2px;
            background: rgba(255,255,255,0.9);
            height: 3px;
            transition: opacity 0.3s ease;
        }
        .music-widget.playing .eq-bar { animation: eqBounce 0.5s ease-in-out infinite; }
        .music-widget.playing .eq-bar:nth-child(1) { animation-delay: 0s; }
        .music-widget.playing .eq-bar:nth-child(2) { animation-delay: 0.12s; }
        .music-widget.playing .eq-bar:nth-child(3) { animation-delay: 0.24s; }
        .music-widget.playing .eq-bar:nth-child(4) { animation-delay: 0.36s; }
        .music-widget.muted .eq-bar { opacity: 0.2; animation: none; }
        @keyframes eqBounce {
            0%, 100% { height: 3px; }
            50%      { height: 12px; }
        }

        /* Label */
        .music-label {
            background: rgba(15, 23, 42, 0.88);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 5px 14px;
            border-radius: 20px;
            white-space: nowrap;
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.35);
            transition: opacity 0.25s ease, transform 0.25s ease;
        }
        .music-label-off { display: none; }
        .music-widget.muted .music-label-text  { display: none; }
        .music-widget.muted .music-label-off   { display: inline; }
        .music-widget:hover .music-label { transform: translateX(-3px); }
    </style>
    <script>
        (function() {
            var music = document.getElementById('bgMusic');
            var widget = document.getElementById('musicWidget');
            if (!music || !widget) return;

            var playing = false;
            music.volume = 0.3;

            // Toggle the actual sound (respects browser autoplay policy)
            function toggleSound() {
                if (music.paused) {
                    music.muted = false;
                    music.play().then(function() {
                        playing = true;
                        widget.classList.remove('muted');
                        widget.classList.add('playing');
                    }).catch(function() {});
                } else {
                    music.pause();
                    playing = false;
                    widget.classList.remove('playing');
                    widget.classList.add('muted');
                }
            }

            widget.addEventListener('click', toggleSound);
            widget.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleSound();
                }
            });

            // Muted autoplay starts instantly on load (no click needed).
            // Browsers only allow audible autoplay AFTER a user gesture,
            // so music starts silent, then sound is enabled on first interaction.
            music.play().then(function() {
                playing = true;
                widget.classList.add('playing');
            }).catch(function() {});

            // First interaction (scroll, mousemove, touch, keydown) = enable sound,
            // WITHOUT pausing the currently-playing track.
            var soundOn = false;
            function enableSound() {
                if (soundOn) return;
                soundOn = true;
                music.muted = false;
                document.removeEventListener('scroll', enableSound);
                document.removeEventListener('mousemove', enableSound);
                document.removeEventListener('touchstart', enableSound);
                document.removeEventListener('keydown', enableSound);
                document.removeEventListener('wheel', enableSound);
            }
            document.addEventListener('scroll', enableSound);
            document.addEventListener('mousemove', enableSound);
            document.addEventListener('touchstart', enableSound);
            document.addEventListener('keydown', enableSound);
            document.addEventListener('wheel', enableSound);

            // Restore loop on ended (safety)
            music.addEventListener('ended', function() {
                music.currentTime = 0;
                music.play();
            });
        })();
    </script>
    <!-- Page Transition Overlay (for link clicks) -->
    <div class="page-transition-overlay" id="pageTransitionOverlay"></div>

    <!-- Loading Overlay (initial page load) -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-logo">{{ optional($account)->name ?? config('app.name', 'Portfolio') }}</div>
        <div class="loader-ring"></div>
        <div class="loader-text">{{ __('messages.loading') }}</div>
    </div>

    @include('frontend.partials.menu')
    
    <!-- Page Content Wrapper -->
    <div class="page-content" id="pageContent">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
    // ===== PAGE LOADING ANIMATION (initial load) =====
    (function() {
        var loader = document.getElementById('pageLoader');
        if (!loader) return;

        window.addEventListener('load', function() {
            setTimeout(function() {
                loader.classList.add('hidden');
            }, 500);
        });

        // Fallback: hide after 3s max
        setTimeout(function() {
            if (!loader.classList.contains('hidden')) {
                loader.classList.add('hidden');
            }
        }, 3000);

        // Ensure content is visible even if animation fails
        setTimeout(function() {
            var content = document.getElementById('pageContent');
            if (content) content.style.opacity = '1';
        }, 2000);
    })();

    // Ensure content is visible immediately (runs before Bootstrap loads)
    (function() {
        var content = document.getElementById('pageContent');
        if (content) content.style.opacity = '1';
    })();

    // ===== SMOOTH PAGE TRANSITIONS (link clicks) =====
    (function() {
        var overlay = document.getElementById('pageTransitionOverlay');
        if (!overlay) return;

        // Check if View Transitions API is supported
        var supportsViewTransitions = typeof document.startViewTransition === 'function';

        function navigateTo(url) {
            if (supportsViewTransitions) {
                // Use modern View Transitions API
                document.startViewTransition(function() {
                    window.location.href = url;
                });
            } else {
                // Fallback: fade overlay then navigate
                overlay.classList.add('active');
                setTimeout(function() {
                    window.location.href = url;
                }, 350);
            }
        }

        // Intercept all internal link clicks
        document.addEventListener('click', function(e) {
            var link = e.target.closest('a');
            if (!link) return;

            var href = link.getAttribute('href');
            if (!href) return;

            // Only handle internal links (same origin or relative)
            var isInternal = href.startsWith('/') || 
                             href.startsWith('#') || 
                             (href.startsWith(window.location.origin)) ||
                             (href.startsWith('.') && !href.startsWith('..'));

            // Skip anchor links (same page navigation)
            if (href.startsWith('#')) return;

            // Skip external links
            if (href.startsWith('http') && !href.startsWith(window.location.origin)) return;

            // Skip download links and files
            if (link.hasAttribute('download')) return;
            if (href.match(/\.(pdf|doc|docx|zip|png|jpg|jpeg)$/i)) return;

            // Skip if user is holding modifier keys (open in new tab)
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

            // Skip if it's a logout or form submission
            if (link.closest('form')) return;

            e.preventDefault();
            navigateTo(href);
        });
    })();

    // ===== THEME TOGGLE (global - works on ALL pages) =====
    (function() {
        var toggle = document.getElementById('themeToggle');
        if (!toggle) return;

        // Set initial icon based on saved theme
        var saved = localStorage.getItem('theme');
        if (saved === 'light') {
            toggle.innerHTML = '<i class="bi bi-moon-fill"></i>';
        }

        toggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('light-theme');
            var isLight = document.documentElement.classList.contains('light-theme');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            this.innerHTML = isLight ? '<i class="bi bi-moon-fill"></i>' : '<i class="bi bi-sun-fill"></i>';
        });
    })();
    </script>
</body>
</html>
