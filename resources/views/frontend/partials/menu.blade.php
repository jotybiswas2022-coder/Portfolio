<style>
    /* ===== NAVBAR (shared on every page — self contained, no page CSS can shift it) ===== */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0; width: 100%;
        z-index: 1000; box-sizing: border-box;
        display: flex; flex-wrap: nowrap; align-items: center; gap: 0.75rem;
        padding: 0.8rem 1.5rem; margin: 0;
        background: rgba(10, 15, 30, 0.92);
        -webkit-backdrop-filter: blur(20px) saturate(1.4); backdrop-filter: blur(20px) saturate(1.4);
        border-bottom: 1px solid rgba(59, 130, 246, 0.14);
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        line-height: 1.25; text-align: left;
        transition: padding 0.3s cubic-bezier(0.16, 1, 0.3, 1), background 0.3s ease,
                    border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .navbar-main *, .navbar-main *::before, .navbar-main *::after { box-sizing: border-box; }
    /* hairline that keeps running along the top edge */
    .navbar-main::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: navSweep 5s linear infinite;
        pointer-events: none;
    }
    @keyframes navSweep { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    html.light-theme .navbar-main {
        background: rgba(248, 250, 252, 0.94);
        border-bottom-color: rgba(59, 130, 246, 0.12);
    }
    .navbar-main.scrolled {
        padding: 0.55rem 1.5rem;
        background: rgba(10, 15, 30, 0.97);
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.32);
    }
    html.light-theme .navbar-main.scrolled {
        background: rgba(248, 250, 252, 0.97);
        box-shadow: 0 6px 26px rgba(0, 0, 0, 0.08);
    }

    /* ===== brand ===== */
    .navbar-main .nav-logo {
        flex: 0 0 auto; display: inline-flex; align-items: center; gap: 0.3rem;
        font-family: 'Poppins', 'Hind Siliguri', system-ui, sans-serif;
        font-size: 1.22rem; font-weight: 800; letter-spacing: -0.5px;
        text-decoration: none; white-space: nowrap; line-height: 1.2;
    }
    .navbar-main .nav-logo-prompt {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.95rem; font-weight: 700; color: #34d399;
        animation: mnBlink 1.8s steps(1) infinite;
    }
    @keyframes mnBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0.15; } }
    .navbar-main .nav-logo-text {
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: navGradient 4s ease infinite;
    }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    html.light-theme .navbar-main .nav-logo-text {
        background: none; -webkit-text-fill-color: #1e293b; color: #1e293b;
    }

    /* ===== links (takes the middle on desktop, scrolls sideways when tight) ===== */
    .navbar-main .nav-links {
        flex: 1 1 auto; min-width: 0;
        display: flex; align-items: center; justify-content: center; gap: 0.15rem;
        margin: 0; padding: 0; list-style: none;
        overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none;
    }
    .navbar-main .nav-links::-webkit-scrollbar { display: none; }
    .navbar-main .nav-links li { display: flex; margin: 0; padding: 0; list-style: none; }
    .navbar-main .nav-links a,
    .navbar-main .nav-links button {
        position: relative; display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.45rem 0.75rem; border-radius: 9px; border: 1px solid transparent;
        background: none; cursor: pointer; text-decoration: none; white-space: nowrap;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.78rem; font-weight: 500; line-height: 1.25; color: #94a3b8;
        transition: color 0.3s ease, background 0.3s ease, border-color 0.3s ease,
                    transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    }
    html.light-theme .navbar-main .nav-links a,
    html.light-theme .navbar-main .nav-links button { color: #475569; }
    .navbar-main .nav-links i { font-size: 0.85rem; opacity: 0.9; }
    /* $ prompt slides in on hover / on the active page */
    .navbar-main .nav-links a::before,
    .navbar-main .nav-links button::before {
        content: '$'; font-weight: 700; color: #34d399;
        opacity: 0; transform: translateX(-4px);
        transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .navbar-main .nav-links a:hover,
    .navbar-main .nav-links a.nav-active { color: #60a5fa; background: rgba(59, 130, 246, 0.1); }
    .navbar-main .nav-links a:hover::before,
    .navbar-main .nav-links a.nav-active::before,
    .navbar-main .nav-links button:hover::before { opacity: 1; transform: translateX(0); }
    .navbar-main .nav-links a:hover { transform: translateY(-2px); }
    /* active tab underline */
    .navbar-main .nav-links a.nav-active::after {
        content: ''; position: absolute; left: 14%; right: 14%; bottom: 2px; height: 2px;
        border-radius: 2px; box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        background: linear-gradient(90deg, #22d3ee, #6366f1, #a78bfa);
    }
    html.light-theme .navbar-main .nav-links a.nav-active { background: rgba(59, 130, 246, 0.08); }

    /* session chips */
    .navbar-main .nav-action-login { color: #60a5fa; border-color: rgba(59, 130, 246, 0.25); background: rgba(59, 130, 246, 0.06); }
    .navbar-main .nav-action-login:hover { background: rgba(59, 130, 246, 0.14); border-color: rgba(59, 130, 246, 0.45); }
    .navbar-main .nav-action-signup {
        color: #fff; border-color: rgba(129, 140, 248, 0.45);
        background: linear-gradient(135deg, #3b82f6, #4f46e5, #7c3aed);
        box-shadow: 0 6px 18px rgba(79, 70, 229, 0.28);
    }
    .navbar-main .nav-action-signup::before { color: #c7d2fe; }
    .navbar-main .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 10px 26px rgba(79, 70, 229, 0.4); }
    .navbar-main .nav-action-admin { color: #a5b4fc; border-color: rgba(99, 102, 241, 0.28); background: rgba(99, 102, 241, 0.12); }
    .navbar-main .nav-action-admin:hover { background: rgba(99, 102, 241, 0.2); }
    .navbar-main .nav-action-logout { color: #f87171; border-color: rgba(248, 113, 113, 0.24); }
    .navbar-main .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1); }

    /* ===== right group ===== */
    .navbar-main .nav-right-group {
        flex: 0 0 auto; display: flex; align-items: center; gap: 0.4rem; margin-left: auto;
    }
    .navbar-main .nav-status {
        display: inline-flex; align-items: center; gap: 0.4rem; white-space: nowrap;
        padding: 0.3rem 0.6rem; border-radius: 7px;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem; letter-spacing: 0.3px; color: #94a3b8;
        background: rgba(59, 130, 246, 0.06); border: 1px solid rgba(59, 130, 246, 0.14);
    }
    html.light-theme .navbar-main .nav-status { color: #475569; }
    .navbar-main .nav-status-dot {
        width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0;
        background: #34d399; box-shadow: 0 0 8px rgba(52, 211, 153, 0.85);
        animation: navPulse 2s ease infinite;
    }
    @keyframes navPulse { 50% { opacity: 0.35; } }

    .navbar-main .lang-switcher {
        display: inline-flex; align-items: center; gap: 2px; padding: 2px;
        border-radius: 9px; background: rgba(59, 130, 246, 0.05);
        border: 1px solid rgba(59, 130, 246, 0.14);
    }
    html.light-theme .navbar-main .lang-switcher { background: rgba(59, 130, 246, 0.04); border-color: rgba(59, 130, 246, 0.16); }
    .navbar-main .lang-btn {
        display: inline-flex; align-items: center; justify-content: center;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.66rem; font-weight: 700; letter-spacing: 0.3px; color: #64748b;
        padding: 0.22rem 0.5rem; border-radius: 7px; white-space: nowrap;
        text-decoration: none !important;
        transition: color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
    }
    html.light-theme .navbar-main .lang-btn { color: #64748b; }
    .navbar-main .lang-btn:hover { color: #60a5fa; }
    .navbar-main .lang-btn.active {
        color: #e0f2fe; background: linear-gradient(135deg, #3b82f6, #6366f1);
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.32);
    }
    .navbar-main .lang-divider { display: none; }

    .navbar-main .theme-toggle-btn {
        width: 32px; height: 32px; flex-shrink: 0; padding: 0;
        border-radius: 9px; border: 1px solid rgba(59, 130, 246, 0.18);
        background: rgba(59, 130, 246, 0.06); color: #60a5fa; font-size: 0.9rem;
        display: flex; align-items: center; justify-content: center; cursor: pointer;
        transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease,
                    transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .navbar-main .theme-toggle-btn:hover {
        background: rgba(59, 130, 246, 0.14); border-color: rgba(59, 130, 246, 0.4);
        transform: rotate(-20deg) scale(1.06);
    }
    .navbar-main .theme-toggle-btn:active { transform: rotate(20deg) scale(0.94); }
    html.light-theme .navbar-main .theme-toggle-btn {
        color: #f59e0b; border-color: rgba(245, 158, 11, 0.28); background: rgba(245, 158, 11, 0.1);
    }
    html.light-theme .navbar-main .theme-toggle-btn:hover { background: rgba(245, 158, 11, 0.18); }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 992px) {
        .navbar-main .nav-status { display: none; }
    }
    /* one row always: the link strip scrolls sideways instead of wrapping/breaking */
    @media (max-width: 768px) {
        .navbar-main { padding: 0.5rem 0.75rem; gap: 0.4rem; }
        .navbar-main.scrolled { padding: 0.4rem 0.75rem; }
        .navbar-main .nav-logo { font-size: 1rem; }
        .navbar-main .nav-logo-prompt { font-size: 0.85rem; }
        .navbar-main .nav-links { justify-content: flex-start; gap: 0.1rem; }
        .navbar-main .nav-links a,
        .navbar-main .nav-links button { padding: 0.35rem 0.55rem; font-size: 0.72rem; }
        .navbar-main .nav-links a.nav-active::after { bottom: 0; }
        .navbar-main .theme-toggle-btn { width: 30px; height: 30px; font-size: 0.82rem; }
        .navbar-main .lang-btn { font-size: 0.62rem; padding: 0.18rem 0.4rem; }
    }
    @media (max-width: 480px) {
        .navbar-main { padding: 0.45rem 0.6rem; gap: 0.3rem; }
        .navbar-main.scrolled { padding: 0.35rem 0.6rem; }
        .navbar-main .nav-logo { font-size: 0.92rem; }
        .navbar-main .nav-links a,
        .navbar-main .nav-links button { padding: 0.3rem 0.45rem; font-size: 0.68rem; gap: 0.25rem; }
        .navbar-main .nav-links a::before,
        .navbar-main .nav-links button::before { content: none; }
        .navbar-main .theme-toggle-btn { width: 28px; height: 28px; font-size: 0.78rem; }
        .navbar-main .lang-btn { font-size: 0.58rem; padding: 0.15rem 0.35rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        .navbar-main::before, .navbar-main .nav-logo-prompt, .navbar-main .nav-status-dot { animation: none; }
        .navbar-main .nav-links a:hover { transform: none; }
    }
</style>

<nav class="navbar-main" id="navbar">
    <!-- brand -->
    <a href="/" class="nav-logo">
        <span class="nav-logo-prompt" aria-hidden="true">&#10095;</span>
        <span class="nav-logo-text">{{ optional($account)->name ?? config('app.name', 'Portfolio') }}</span>
    </a>

    <!-- links -->
    <ul class="nav-links" id="navLinks">
        <li>
            <a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}" title="{{ __('messages.home') }}">
                <i class="bi bi-house-fill"></i>{{ __('messages.home') }}
            </a>
        </li>
        @auth
            <li>
                <a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'nav-active' : '' }}" title="{{ __('messages.inbox') }}">
                    <i class="bi bi-chat-dots"></i>{{ __('messages.inbox') }}
                </a>
            </li>
            @if(auth()->user()->is_admin == 1)
                <li>
                    <a href="/admin" class="nav-action-admin" title="{{ __('messages.admin') }}">
                        <i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}
                    </a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-action-logout" title="{{ __('messages.logout') }}">
                        <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="/login" class="nav-action-login" title="{{ __('messages.login') }}">
                    <i class="bi bi-person-circle"></i>{{ __('messages.login') }}
                </a>
            </li>
            <li>
                <a href="/register" class="nav-action-signup" title="{{ __('messages.signup') }}">
                    <i class="bi bi-person-plus"></i>{{ __('messages.signup') }}
                </a>
            </li>
        @endauth
    </ul>

    <!-- right group -->
    <div class="nav-right-group">
        <div class="nav-status"><span class="nav-status-dot" aria-hidden="true"></span> 200 OK</div>
        <div class="lang-switcher">
            <a href="{{ route('language.switch', 'en') }}"
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <a href="{{ route('language.switch', 'bn') }}"
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
        <button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}">
            <i class="bi bi-sun-fill"></i>
        </button>
    </div>
</nav>
