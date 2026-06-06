<style>
    /* ===== NAVBAR (SHARED ACROSS ALL PAGES) ===== */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 1000; padding: 1rem 2rem;
        display: flex; justify-content: space-between; align-items: center;
        background: rgba(10, 15, 30, 0.88);
        backdrop-filter: blur(24px) saturate(1.4);
        -webkit-backdrop-filter: blur(24px) saturate(1.4);
        border-bottom: 1px solid rgba(59, 130, 246, 0.12);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme .navbar-main {
        background: rgba(248, 250, 252, 0.92);
        border-bottom: 1px solid rgba(59, 130, 246, 0.12);
    }
    .navbar-main.scrolled {
        padding: 0.6rem 2rem;
        background: rgba(10, 15, 30, 0.96);
        border-bottom: 1px solid rgba(59, 130, 246, 0.25);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }
    html.light-theme .navbar-main.scrolled {
        background: rgba(248, 250, 252, 0.96);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    }
    .nav-logo {
        font-size: 1.4rem; font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 4s ease infinite;
        letter-spacing: -0.5px;
        text-decoration: none;
    }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===== NAV RIGHT GROUP (theme toggle + lang + hamburger) ===== */
    .nav-right-group {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Theme Toggle */
    .theme-toggle-btn {
        width: 36px; height: 36px;
        border-radius: 50%; border: 1px solid rgba(59, 130, 246, 0.25);
        background: rgba(59, 130, 246, 0.08);
        color: #60a5fa; font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 0;
    }
    .theme-toggle-btn:hover {
        background: rgba(59, 130, 246, 0.18);
        transform: scale(1.1);
    }
    html.light-theme .theme-toggle-btn {
        color: #f59e0b;
        border-color: rgba(245, 158, 11, 0.3);
        background: rgba(245, 158, 11, 0.1);
    }
    html.light-theme .theme-toggle-btn:hover {
        background: rgba(245, 158, 11, 0.2);
    }

    .nav-links { display: flex; gap: 0.5rem; list-style: none; align-items: center; margin: 0; padding: 0; }
    .nav-links a { 
        color: #94a3b8; font-weight: 500; font-size: 0.88rem;
        padding: 0.5rem 1rem; border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        text-decoration: none;
    }
    html.light-theme .nav-links a { color: #475569; }
    .nav-links a:hover { color: #60a5fa; background: rgba(59, 130, 246, 0.08); }
    .nav-links a.nav-active { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }

    .nav-action {
        display: inline-flex !important; align-items: center; gap: 0.4rem;
        padding: 0.45rem 1rem !important;
        border-radius: 8px !important; font-weight: 600 !important;
        font-size: 0.85rem !important;
    }
    .nav-action-login { color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.25); text-decoration: none !important; }
    .nav-action-login:hover { background: rgba(59, 130, 246, 0.12) !important; border-color: #3b82f6 !important; }
    .nav-action-signup { background: linear-gradient(135deg, #3b82f6, #2563eb) !important; color: #fff !important; border: none !important; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25); text-decoration: none !important; }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; }
    .nav-action-admin { background: rgba(59, 130, 246, 0.1) !important; color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.2) !important; text-decoration: none !important; }
    .nav-action-logout { color: #f87171 !important; border: 1px solid rgba(248, 113, 113, 0.2) !important; text-decoration: none !important; }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1) !important; }

    /* ===== HAMBURGER ===== */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; z-index: 1001; padding: 5px;
        background: none; border: none;
    }
    .hamburger span {
        width: 24px; height: 2px; background: #e2e8f0;
        border-radius: 2px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: center;
    }
    html.light-theme .hamburger span { background: #334155; }
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

    /* ===== LANGUAGE SWITCHER ===== */
    .lang-switcher { display: flex; align-items: center; gap: 2px; margin: 0 0.3rem; }
    .lang-btn {
        color: #64748b; font-size: 0.78rem; font-weight: 600;
        padding: 3px 6px; border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none !important;
        letter-spacing: 0.3px;
    }
    .lang-btn:hover { color: #60a5fa; }
    .lang-btn.active {
        color: #3b82f6;
        background: rgba(59, 130, 246, 0.12);
    }
    .lang-divider {
        color: #475569; font-size: 0.75rem;
    }

    html { padding-top: 0 !important; }
    body { padding-top: 0 !important; }

    /* ===== MOBILE OVERLAY MENU ===== */
    @media (max-width: 768px) {
        .navbar-main {
            padding: 0.8rem 1.2rem;
        }
        .navbar-main.scrolled {
            padding: 0.5rem 1.2rem;
        }
        .nav-logo {
            font-size: 1.2rem;
        }

        .nav-links {
            display: flex;
            position: fixed;
            top: 0; right: 0;
            width: 85%; max-width: 340px;
            height: 100vh;
            background: rgba(10, 15, 30, 0.98);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            flex-direction: column;
            align-items: stretch;
            justify-content: flex-start;
            padding: 5rem 1.5rem 2rem;
            gap: 0.25rem;
            transform: translateX(100%);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            box-shadow: -10px 0 40px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
        }
        html.light-theme .nav-links {
            background: rgba(248, 250, 252, 0.98);
        }
        .nav-links.open {
            transform: translateX(0);
            opacity: 1;
        }

        /* Mobile menu header with close button */
        .nav-links::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .nav-links.open::before {
            opacity: 1;
            pointer-events: auto;
        }

        .nav-links li {
            width: 100%;
        }
        .nav-links a,
        .nav-links button {
            font-size: 1rem !important;
            padding: 0.75rem 1rem !important;
            width: 100%;
            justify-content: flex-start !important;
            border-radius: 10px !important;
            text-align: left;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        .nav-links a i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }
        .nav-links a:hover {
            background: rgba(59, 130, 246, 0.1) !important;
        }
        .nav-links a.nav-active {
            background: rgba(59, 130, 246, 0.15) !important;
            color: #3b82f6 !important;
        }

        /* Divider between nav items and auth */
        .nav-divider {
            height: 1px;
            background: rgba(59, 130, 246, 0.12);
            margin: 0.8rem 1rem;
        }

        /* Close button */
        .mobile-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(59, 130, 246, 0.2);
            background: rgba(59, 130, 246, 0.06);
            color: var(--text-muted, #64748b);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .mobile-close-btn:hover {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            transform: rotate(90deg);
        }

        .hamburger { display: flex; }

        /* Hide theme toggle and lang from desktop nav-links on mobile */
        .nav-links .theme-toggle-btn,
        .nav-links .lang-switcher {
            display: none;
        }
    }

    /* Small mobile */
    @media (max-width: 480px) {
        .navbar-main {
            padding: 0.7rem 1rem;
        }
        .navbar-main.scrolled {
            padding: 0.4rem 1rem;
        }
        .nav-logo {
            font-size: 1.1rem;
        }
        .theme-toggle-btn {
            width: 32px;
            height: 32px;
            font-size: 0.85rem;
        }
        .lang-btn {
            font-size: 0.72rem;
            padding: 2px 4px;
        }
        .nav-links {
            width: 100%;
            max-width: none;
            padding: 4.5rem 1.2rem 1.5rem;
        }
        .nav-links a,
        .nav-links button {
            font-size: 0.95rem !important;
            padding: 0.65rem 0.8rem !important;
        }
    }
</style>
<nav class="navbar-main" id="navbar">
    <!-- Logo -->
    <a href="/" class="nav-logo">{{ config('app.name', 'Portfolio') }}</a>

    <!-- Nav Links (Desktop) -->
    <ul class="nav-links" id="navLinks">
        <!-- Close button (mobile only) -->
        <li class="d-md-none" style="list-style: none; position: relative;">
            <button class="mobile-close-btn" id="mobileCloseBtn" aria-label="Close menu">
                <i class="bi bi-x-lg"></i>
            </button>
        </li>

        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill"></i>{{ __('messages.home') }}</a></li>
        <li><a href="/#about"><i class="bi bi-person-fill"></i>{{ __('messages.about') }}</a></li>
        <li><a href="/#services"><i class="bi bi-gear"></i>{{ __('messages.services') }}</a></li>
        <li><a href="/#skills"><i class="bi bi-lightning-fill"></i>{{ __('messages.skills') }}</a></li>
        <li><a href="/#projects"><i class="bi bi-folder-fill"></i>{{ __('messages.projects') }}</a></li>
        <li><a href="/#contact"><i class="bi bi-envelope-fill"></i>{{ __('messages.contact') }}</a></li>
        <li><a href="/#faq"><i class="bi bi-question-circle"></i>FAQ</a></li>
        <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog') || request()->is('blog/*') ? 'nav-active' : '' }}"><i class="bi bi-journal-text"></i>{{ __('messages.blog') }}</a></li>

        <li class="nav-divider d-md-none"></li>

        @auth
            @if(auth()->user()->is_admin == 1)
                <!-- Desktop: use nav-action classes -->
                <li class="d-none d-md-block">
                    <a href="/admin" class="nav-action nav-action-admin">
                        <i class="bi bi-speedometer2 me-1"></i> {{ __('messages.admin') }}
                    </a>
                </li>
                <!-- Mobile: full-width styled -->
                <li class="d-md-none">
                    <a href="/admin" style="justify-content: flex-start !important; width: 100%; border-radius: 10px !important; padding: 0.75rem 1rem !important; font-size: 1rem !important; color: #60a5fa !important; border: 1px solid rgba(59,130,246,0.2) !important; display: flex !important; align-items: center; gap: 0.4rem;">
                        <i class="bi bi-speedometer2" style="width: 24px;"></i> {{ __('messages.admin') }}
                    </a>
                </li>
            @endif
            <!-- Desktop logout -->
            <li class="d-none d-md-block">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-action nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600; font-size:0.85rem;">
                        <i class="bi bi-box-arrow-right me-1"></i> {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
            <!-- Mobile logout -->
            <li class="d-md-none">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:1rem !important; display:flex; align-items:center; gap:0.4rem; padding:0.75rem 1rem !important; border-radius:10px !important; font-weight:600; width:100%; color:#f87171 !important;">
                        <i class="bi bi-box-arrow-right" style="width: 24px;"></i> {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <!-- Desktop login/signup -->
            <li class="d-none d-md-block">
                <a href="/login" class="nav-action nav-action-login">
                    <i class="bi bi-person-circle me-1"></i> {{ __('messages.login') }}
                </a>
            </li>
            <li class="d-none d-md-block">
                <a href="/register" class="nav-action nav-action-signup">
                    <i class="bi bi-person-plus me-1"></i> {{ __('messages.signup') }}
                </a>
            </li>
            <!-- Mobile login/signup -->
            <li class="d-md-none">
                <a href="/login" style="justify-content: flex-start !important; width: 100%; border-radius: 10px !important; padding: 0.75rem 1rem !important; font-size: 1rem !important; color: #60a5fa !important; border: 1px solid rgba(59,130,246,0.3) !important; display: flex !important; align-items: center; gap: 0.4rem;">
                    <i class="bi bi-person-circle" style="width: 24px;"></i> {{ __('messages.login') }}
                </a>
            </li>
            <li class="d-md-none">
                <a href="/register" style="justify-content: center !important; width: 100%; border-radius: 10px !important; padding: 0.75rem 1rem !important; font-size: 1rem !important; background: linear-gradient(135deg, #3b82f6, #2563eb) !important; color: #fff !important; border: none !important; display: flex !important; align-items: center; gap: 0.4rem;">
                    <i class="bi bi-person-plus" style="width: 24px;"></i> {{ __('messages.signup') }}
                </a>
            </li>
        @endauth

        <!-- Language Switcher (mobile) -->
        <li class="d-md-none" style="list-style: none; margin-top: 0.5rem;">
            <div class="lang-switcher justify-content-center" style="margin: 0;">
                <a href="{{ route('language.switch', 'en') }}" 
                   class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                   title="{{ __('messages.english') }}">
                    EN
                </a>
                <span class="lang-divider">|</span>
                <a href="{{ route('language.switch', 'bn') }}" 
                   class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
                   title="{{ __('messages.bengali') }}">
                    বাংলা
                </a>
            </div>
        </li>
    </ul>

    <!-- Right Group (Desktop - always visible) -->
    <div class="nav-right-group">
        <!-- Language Switcher (desktop) -->
        <div class="lang-switcher d-none d-md-flex">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">
                EN
            </a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">
                বাংলা
            </a>
        </div>

        <!-- Theme Toggle (always visible in navbar) -->
        <button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}">
            <i class="bi bi-sun-fill"></i>
        </button>

        <!-- Hamburger (mobile only) -->
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
