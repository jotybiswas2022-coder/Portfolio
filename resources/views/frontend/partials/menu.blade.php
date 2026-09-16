<style>
    /* ===== Navbar (shared across all pages) ===== */
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
    .navbar-main::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: navSweep 5s linear infinite; opacity: 0.9;
        pointer-events: none;
    }
    @keyframes navSweep { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
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
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 4s ease infinite;
        letter-spacing: -0.5px;
        text-decoration: none;
    }
    .nav-logo::before {
        content: '❯'; font-size: 1rem; color: #34d399; font-weight: 700;
        -webkit-text-fill-color: #34d399;
        animation: logoBlink 1.4s steps(1) infinite;
    }
    @keyframes logoBlink { 50% { opacity: 0.35; } }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===== Desktop nav links ===== */
    .nav-links {
        display: flex; gap: 0.25rem; list-style: none; align-items: center; margin: 0; padding: 0;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
    }
    .nav-links a { 
        color: #94a3b8; font-weight: 500; font-size: 0.88rem;
        padding: 0.5rem 0.9rem; border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none; white-space: nowrap;
        display: inline-flex; align-items: center; gap: 0.4rem; position: relative;
    }
    html.light-theme .nav-links a { color: #475569; }
    .nav-links a::before {
        content: '$'; font-weight: 700; color: #34d399;
        opacity: 0; transform: translateX(-4px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .nav-links a:hover { color: #60a5fa; background: rgba(59, 130, 246, 0.08); }
    .nav-links a:hover::before,
    .nav-links a.nav-active::before { opacity: 1; transform: translateX(0); }
    .nav-links a.nav-active {
        color: #60a5fa; background: rgba(59, 130, 246, 0.12);
        box-shadow: inset 0 -2px 0 0 rgba(59, 130, 246, 0.55);
    }

    .nav-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.68rem; color: #94a3b8; margin: 0 0.4rem 0 0.2rem;
        padding: 0.28rem 0.65rem; border-radius: 6px; white-space: nowrap;
        background: rgba(59, 130, 246, 0.06); border: 1px solid rgba(59, 130, 246, 0.14);
    }
    html.light-theme .nav-status { color: #475569; background: rgba(59, 130, 246, 0.05); }
    .nav-status-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #34d399; box-shadow: 0 0 8px rgba(52, 211, 153, 0.8);
        animation: statusPulse 2s ease infinite;
    }
    @keyframes statusPulse { 50% { opacity: 0.4; } }

    .nav-action-login { 
        color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.25); 
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    .nav-action-login:hover { background: rgba(59, 130, 246, 0.12) !important; border-color: #3b82f6 !important; }
    .nav-action-signup { 
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important; color: #fff !important; 
        border: none !important; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; }
    .nav-action-admin { 
        background: rgba(59, 130, 246, 0.1) !important; color: #60a5fa !important; 
        border: 1px solid rgba(59, 130, 246, 0.2) !important; font-weight: 600 !important;
    }
    .nav-action-logout { 
        color: #f87171 !important; border: 1px solid rgba(248, 113, 113, 0.2) !important; font-weight: 600 !important;
    }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1) !important; }

    /* ===== RIGHT GROUP ===== */
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

    /* ===== Hamburger ===== */
    .hamburger {
        display: none; flex-direction: column; gap: 4px;
        cursor: pointer; z-index: 1002; padding: 7px;
        background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.15);
        border-radius: 10px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hamburger:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
    }
    .hamburger span {
        display: block; width: 20px; height: 2px;
        background: #e2e8f0; border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: center;
    }
    html.light-theme .hamburger {
        background: rgba(59, 130, 246, 0.06);
        border-color: rgba(59, 130, 246, 0.15);
    }
    html.light-theme .hamburger:hover {
        background: rgba(59, 130, 246, 0.12);
    }
    html.light-theme .hamburger span { background: #334155; }
    .hamburger.active {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.25);
    }
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(4px, 4px); width: 18px; }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(4px, -4px); width: 18px; }

    /* ===== Language switcher ===== */
    .lang-switcher { display: flex; align-items: center; gap: 2px; margin: 0 0.3rem; }
    .lang-btn {
        color: #64748b; font-size: 0.78rem; font-weight: 600;
        padding: 3px 6px; border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none !important;
        letter-spacing: 0.3px;
    }
    .lang-btn:hover { color: #60a5fa; }
    .lang-btn.active { color: #3b82f6; background: rgba(59, 130, 246, 0.12); }
    .lang-divider { color: #475569; font-size: 0.75rem; }

    /* ===== Mobile drawer and backdrop ===== */
    .mobile-backdrop {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1001;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.35s ease, visibility 0.35s ease;
        cursor: pointer;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    .mobile-backdrop.show {
        opacity: 1;
        visibility: visible;
    }
    html.light-theme .mobile-backdrop {
        background: rgba(0, 0, 0, 0.35);
    }

    .mobile-drawer {
        position: fixed;
        top: 0; right: 0;
        width: 82%; max-width: 340px;
        height: 100vh; height: 100dvh;
        z-index: 1002;
        background: rgba(10, 15, 30, 0.98);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }
    html.light-theme .mobile-drawer {
        background: rgba(248, 250, 252, 0.98);
    }
    .mobile-drawer.open {
        transform: translateX(0);
    }

    /* Drawer Header */
    .drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(59, 130, 246, 0.08);
        flex-shrink: 0;
        background: rgba(59, 130, 246, 0.03);
    }
    .drawer-header::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: navSweep 5s linear infinite;
        pointer-events: none;
    }
    .drawer-id {
        display: flex; align-items: center; gap: 0.5rem; min-width: 0;
    }
    .drawer-path {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.72rem; color: #94a3b8; white-space: nowrap;
        overflow: hidden; text-overflow: ellipsis;
    }
    html.light-theme .drawer-path { color: #475569; }
    .ft-k {
        color: #818cf8; background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.14rem 0.5rem; border-radius: 4px;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-weight: 700; letter-spacing: 0.5px;
        white-space: nowrap; display: inline-block;
    }
    html.light-theme .ft-k { color: #4f46e5; background: rgba(99, 102, 241, 0.08); border-color: rgba(99, 102, 241, 0.2); }
    .drawer-close {
        width: 34px; height: 34px;
        border-radius: 10px;
        border: 1px solid rgba(59, 130, 246, 0.2);
        background: rgba(59, 130, 246, 0.06);
        color: var(--text-muted, #64748b);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }
    .drawer-close:hover {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        transform: rotate(90deg);
    }

    /* Drawer Body */
    .drawer-body {
        flex: 1;
        padding: 0.5rem 0.8rem 1rem;
        display: flex;
        flex-direction: column;
    }
    .drawer-cmd {
        display: flex; align-items: center; gap: 0.45rem;
        padding: 0.45rem 1rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.75rem; flex-shrink: 0;
        background: rgba(2, 8, 23, 0.45); border-bottom: 1px solid rgba(148, 163, 184, 0.1);
    }
    html.light-theme .drawer-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .drawer-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .drawer-cmd-text { color: #e2e8f0; }
    html.light-theme .drawer-cmd-text { color: #1e293b; }
    .drawer-sec {
        padding: 0.6rem 0.85rem 0.2rem;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.5px;
        color: #64748b;
    }
    .drawer-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .drawer-nav + .drawer-nav {
        margin-top: 0.3rem;
    }
    .drawer-nav li {
        margin-bottom: 4px;
        opacity: 0;
        transform: translateX(20px);
        transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .mobile-drawer.open .drawer-nav li {
        opacity: 1;
        transform: translateX(0);
    }
    .mobile-drawer.open .drawer-nav li:nth-child(1) { transition-delay: 0.04s; }
    .mobile-drawer.open .drawer-nav li:nth-child(2) { transition-delay: 0.08s; }
    .mobile-drawer.open .drawer-nav li:nth-child(3) { transition-delay: 0.12s; }
    .mobile-drawer.open .drawer-nav li:nth-child(4) { transition-delay: 0.16s; }
    .mobile-drawer.open .drawer-nav li:nth-child(5) { transition-delay: 0.20s; }
    .mobile-drawer.open .drawer-nav li:nth-child(6) { transition-delay: 0.24s; }
    .mobile-drawer.open .drawer-nav li:nth-child(7) { transition-delay: 0.28s; }

    .drawer-nav a,
    .drawer-nav button {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.7rem 0.85rem;
        border-radius: 10px;
        font-size: 0.92rem;
        font-weight: 500;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        color: var(--text-secondary, #94a3b8);
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
    }
    .drawer-nav a i,
    .drawer-nav button i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
        color: #60a5fa;
        transition: color 0.2s;
    }
    .drawer-nav a:hover {
        background: rgba(59, 130, 246, 0.08);
        color: #60a5fa;
    }
    .drawer-nav a:hover i {
        color: #60a5fa;
    }
    .drawer-nav a.active {
        background: rgba(59, 130, 246, 0.14);
        color: #60a5fa;
        box-shadow: inset 3px 0 0 0 #22d3ee;
    }
    .drawer-nav a.active i {
        color: #22d3ee;
    }

    /* Divider */
    .drawer-divider {
        height: 1px;
        background: rgba(59, 130, 246, 0.1);
        margin: 0.4rem 0.8rem;
    }

    /* Auth buttons in drawer */
    .drawer-login-btn {
        justify-content: center !important;
        background: rgba(59, 130, 246, 0.08) !important;
        border: 1px solid rgba(59, 130, 246, 0.25) !important;
        color: #60a5fa !important;
        font-weight: 600 !important;
    }
    .drawer-login-btn:hover {
        background: rgba(59, 130, 246, 0.15) !important;
    }
    .drawer-signup-btn {
        justify-content: center !important;
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .drawer-signup-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important;
    }
    .drawer-logout-btn {
        color: #f87171 !important;
    }
    .drawer-logout-btn:hover {
        background: rgba(248, 113, 113, 0.08) !important;
        color: #f87171 !important;
    }
    .drawer-admin-btn {
        color: #60a5fa !important;
        border: 1px solid rgba(59, 130, 246, 0.2) !important;
    }
    .drawer-admin-btn:hover {
        background: rgba(59, 130, 246, 0.1) !important;
    }

    /* Drawer Footer (lang + status) */
    .drawer-bottom {
        margin-top: auto;
        padding-top: 0.6rem;
        border-top: 1px solid rgba(59, 130, 246, 0.08);
    }
    .drawer-status {
        display: flex; align-items: center; gap: 0.4rem;
        padding: 0.15rem 0.85rem 0.5rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.66rem; color: #34d399;
    }
    .drawer-status i { font-size: 0.7rem; }
    .drawer-footer {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.4rem 0.5rem 0.6rem;
    }

    @media (max-width: 992px) {
        .nav-status { display: none; }
    }

    /* ===== Mobile responsive ===== */
    @media (max-width: 768px) {
        .navbar-main {
            padding: 0.7rem 1rem;
        }
        .navbar-main.scrolled {
            padding: 0.45rem 1rem;
        }
        .nav-logo {
            font-size: 1.15rem;
        }
        .nav-links {
            display: none !important;
        }
        .hamburger {
            display: flex;
        }
        .nav-right-group {
            gap: 0.2rem;
        }
        .theme-toggle-btn {
            width: 34px; height: 34px; font-size: 0.9rem;
        }
        .drawer-cmd { font-size: 0.7rem; padding: 0.4rem 0.9rem; }
    }

    @media (max-width: 480px) {
        .navbar-main {
            padding: 0.55rem 0.8rem;
        }
        .navbar-main.scrolled {
            padding: 0.35rem 0.8rem;
        }
        .nav-logo {
            font-size: 1rem;
        }
        .hamburger {
            padding: 5px;
        }
        .hamburger span {
            width: 18px;
        }
        .hamburger.active span:nth-child(1),
        .hamburger.active span:nth-child(3) {
            width: 16px;
        }
        .theme-toggle-btn {
            width: 30px; height: 30px; font-size: 0.8rem;
        }
        .lang-btn { font-size: 0.65rem; padding: 2px 4px; }
        .drawer-header {
            padding: 0.8rem 1rem;
        }
        .drawer-cmd {
            font-size: 0.64rem;
            padding: 0.35rem 0.75rem;
        }
        .drawer-close {
            width: 30px; height: 30px; font-size: 0.85rem;
        }
        .drawer-body {
            padding: 0.3rem 0.6rem 0.8rem;
        }
        .drawer-nav a,
        .drawer-nav button {
            font-size: 0.85rem;
            padding: 0.6rem 0.75rem;
        }
        .drawer-nav a i,
        .drawer-nav button i {
            font-size: 0.9rem;
            width: 18px;
        }
        .drawer-nav li {
            margin-bottom: 3px;
        }
        .drawer-divider {
            margin: 0.3rem 0.6rem;
        }
        .drawer-sec {
            padding: 0.5rem 0.7rem 0.1rem;
        }
        .drawer-status {
            padding: 0.1rem 0.75rem 0.4rem;
        }
        .drawer-footer {
            padding: 0.3rem 0.3rem 0.5rem;
        }
    }

    /* ===== BODY SCROLL LOCK ===== */
    body.menu-open {
        overflow: hidden !important;
    }
</style>

<nav class="navbar-main" id="navbar">
    <!-- Logo -->
    <a href="/" class="nav-logo">{{ optional($account)->name ?? config('app.name', 'Portfolio') }}</a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links" id="navLinks">
        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill me-1"></i>{{ __('messages.home') }}</a></li>
        @auth
            <li><a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'nav-active' : '' }}"><i class="bi bi-chat-dots me-1"></i>{{ __('messages.inbox') }}</a></li>
            @if(auth()->user()->is_admin == 1)
                <li><a href="/admin" class="nav-action-admin">{{ __('messages.admin') }}</a></li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:0.88rem; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600;">
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <li><a href="/login" class="nav-action-login">{{ __('messages.login') }}</a></li>
            <li><a href="/register" class="nav-action-signup">{{ __('messages.signup') }}</a></li>
        @endauth
    </ul>

    <!-- Right Group -->
    <div class="nav-right-group">
        <div class="nav-status"><span class="nav-status-dot"></span> 200 OK</div>
        <div class="lang-switcher">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
        <button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}">
            <i class="bi bi-sun-fill"></i>
        </button>
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Backdrop -->
<div class="mobile-backdrop" id="mobileBackdrop"></div>

<!-- Mobile Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <!-- Drawer Header -->
    <div class="drawer-header">
        <div class="drawer-id">
            <span class="ab-dot red"></span>
            <span class="ab-dot yellow"></span>
            <span class="ab-dot green"></span>
            <span class="drawer-path"><i class="bi bi-folder-fill" style="color:#818cf8"></i> ~/portfolio</span>
        </div>
        <button class="drawer-close" id="drawerClose" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="drawer-cmd">
        <span class="drawer-prompt">&#10095;</span>
        <span class="drawer-cmd-text">open ./menu</span>
    </div>

    <!-- Drawer Body -->
    <div class="drawer-body">
        <div class="drawer-sec"><span class="ft-k">PAGES</span></div>
        <ul class="drawer-nav">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house-fill"></i>{{ __('messages.home') }}</a></li>
        </ul>

        <div class="drawer-divider"></div>

        <div class="drawer-sec"><span class="ft-k">SESSION</span></div>
        <ul class="drawer-nav">
            @auth
                <li><a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'active' : '' }}"><i class="bi bi-chat-dots"></i>{{ __('messages.inbox') }}</a></li>
                @if(auth()->user()->is_admin == 1)
                    <li><a href="/admin" class="drawer-admin-btn"><i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="drawer-logout-btn">
                            <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            @else
                <li><a href="/login" class="drawer-login-btn"><i class="bi bi-person-circle"></i>{{ __('messages.login') }}</a></li>
                <li><a href="/register" class="drawer-signup-btn"><i class="bi bi-person-plus"></i>{{ __('messages.signup') }}</a></li>
            @endauth
        </ul>

        <div class="drawer-footer">
                <a href="{{ route('language.switch', 'en') }}" 
                   class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                   title="{{ __('messages.english') }}">EN</a>
                <span class="lang-divider">|</span>
                <a href="{{ route('language.switch', 'bn') }}" 
                   class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
                   title="{{ __('messages.bengali') }}">বাংলা</a>
            </div>
            </div>
    </div>
</div>

<script>
// ===== MOBILE MENU TOGGLE =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var drawer = document.getElementById('mobileDrawer');
    var backdrop = document.getElementById('mobileBackdrop');
    var closeBtn = document.getElementById('drawerClose');
    var body = document.body;

    if (!hamburger || !drawer || !backdrop) return;

    function openMenu() {
        drawer.classList.add('open');
        backdrop.classList.add('show');
        hamburger.classList.add('active');
        body.classList.add('menu-open');
    }

    function closeMenu() {
        drawer.classList.remove('open');
        backdrop.classList.remove('show');
        hamburger.classList.remove('active');
        body.classList.remove('menu-open');
    }

    hamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (drawer.classList.contains('open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    // Click backdrop to close
    backdrop.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && drawer.classList.contains('open')) {
            closeMenu();
        }
    });

    // Close when a nav link is clicked
    drawer.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', closeMenu);
    });

    // Close when logout form is submitted (but allow form to submit)
    drawer.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            // Small delay to allow form submission
            setTimeout(closeMenu, 100);
        });
    });

    // Prevent clicks inside drawer from closing via backdrop
    drawer.addEventListener('click', function(e) {
        e.stopPropagation();
    });
})();
</script>
