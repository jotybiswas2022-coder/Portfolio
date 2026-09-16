<style>
    /* ================= NAVBAR — COMMAND BAR (coding design) ================= */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 1000; padding: 1rem 1.8rem;
        display: flex; justify-content: space-between; align-items: center; gap: 1rem;
        background: rgba(10, 15, 30, 0.88);
        backdrop-filter: blur(24px) saturate(1.4);
        -webkit-backdrop-filter: blur(24px) saturate(1.4);
        border-bottom: 1px solid rgba(59, 130, 246, 0.12);
        transition: padding 0.3s cubic-bezier(0.16, 1, 0.3, 1), background 0.3s ease,
                    border-color 0.3s ease, box-shadow 0.3s ease;
    }
    /* animated hairline running along the top edge */
    .navbar-main::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: navSweep 5s linear infinite; opacity: 0.9;
        pointer-events: none;
    }
    /* second hairline that fades in once the bar compresses */
    .navbar-main::after {
        content: ''; position: absolute; left: 0; right: 0; bottom: -1px; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(34,211,238,0.55), rgba(139,92,246,0.55), transparent);
        opacity: 0; transition: opacity 0.35s ease; pointer-events: none;
    }
    .navbar-main.scrolled::after { opacity: 1; }
    @keyframes navSweep { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    html.light-theme .navbar-main {
        background: rgba(248, 250, 252, 0.92);
        border-bottom-color: rgba(59, 130, 246, 0.12);
    }
    .navbar-main.scrolled {
        padding: 0.6rem 1.8rem;
        background: rgba(10, 15, 30, 0.96);
        border-bottom-color: rgba(59, 130, 246, 0.25);
        box-shadow: 0 6px 34px rgba(0, 0, 0, 0.34);
    }
    html.light-theme .navbar-main.scrolled {
        background: rgba(248, 250, 252, 0.96);
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
    }

    /* ===== brand ===== */
    .nav-logo {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 1.3rem; font-weight: 800; letter-spacing: -0.5px;
        text-decoration: none; white-space: nowrap; flex-shrink: 0;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
    }
    .nav-logo-prompt {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.98rem; font-weight: 700; color: #34d399;
        animation: mnBlink 1.8s steps(1) infinite;
    }
    .nav-logo-text {
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 4s ease infinite;
    }
    html.light-theme .nav-logo-text {
        background: none; -webkit-text-fill-color: #1e293b; color: #1e293b;
    }
    /* blinking block cursor, like a prompt waiting for input */
    .nav-logo-caret {
        display: inline-block; width: 8px; height: 1.05em; border-radius: 2px;
        background: linear-gradient(180deg, #22d3ee, #6366f1);
        box-shadow: 0 0 10px rgba(34, 211, 238, 0.55);
        animation: mnBlink 1s step-end infinite;
    }
    @keyframes mnBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0.15; } }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===== desktop tab strip ===== */
    .nav-center {
        position: relative; flex: 1 1 auto; min-width: 0;
        display: flex; justify-content: center;
    }
    .nav-links {
        position: relative; display: flex; align-items: center; gap: 0.15rem;
        list-style: none; margin: 0; padding: 0;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
    }
    /* block that slides under the hovered / active tab */
    .nav-cursor {
        position: absolute; left: 0; top: 50%; width: 0; height: 34px;
        border-radius: 9px; opacity: 0; pointer-events: none; z-index: 0;
        background: rgba(59, 130, 246, 0.09);
        border: 1px solid rgba(59, 130, 246, 0.22);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.14), 0 0 0 1px rgba(34, 211, 238, 0.06) inset;
        transform: translate(0, -50%);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                    width 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
    }
    .nav-cursor.on { opacity: 1; }
    html.light-theme .nav-cursor {
        background: rgba(59, 130, 246, 0.08);
        border-color: rgba(59, 130, 246, 0.2);
    }
    .nav-links li:not(.nav-cursor) { position: relative; z-index: 1; display: flex; }

    .nav-links a,
    .nav-links button {
        position: relative; display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.45rem 0.8rem; border-radius: 9px;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.8rem; font-weight: 500; color: #94a3b8;
        text-decoration: none; white-space: nowrap; background: none; border: none;
        cursor: pointer;
        transition: color 0.3s ease, background 0.3s ease, border-color 0.3s ease,
                    transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    }
    html.light-theme .nav-links a,
    html.light-theme .nav-links button { color: #475569; }
    .nav-links a i,
    .nav-links button i { font-size: 0.85rem; opacity: 0.85; }
    /* the $ prompt slides in on hover / active */
    .nav-links a::before,
    .nav-links button::before {
        content: '$'; font-weight: 700; color: #34d399;
        opacity: 0; transform: translateX(-4px);
        transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .nav-links a:hover,
    .nav-links a.nav-active { color: #60a5fa; }
    .nav-links a:hover::before,
    .nav-links a.nav-active::before,
    .nav-links button:hover::before { opacity: 1; transform: translateX(0); }
    .nav-links a:hover { transform: translateY(-2px); }

    /* index chip in front of every tab */
    .nav-tab-i {
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px; color: #64748b;
        background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.16);
        border-radius: 5px; padding: 0.1rem 0.3rem; line-height: 1.4;
        transition: color 0.3s ease, background 0.3s ease, border-color 0.3s ease;
    }
    html.light-theme .nav-tab-i { color: #64748b; background: rgba(59, 130, 246, 0.06); }
    .nav-tab:hover .nav-tab-i,
    .nav-tab.nav-active .nav-tab-i {
        color: #a5b4fc; border-color: rgba(99, 102, 241, 0.35); background: rgba(99, 102, 241, 0.14);
    }
    /* active tab: gradient underline draws itself in */
    .nav-tab::after {
        content: ''; position: absolute; left: 12%; right: 12%; bottom: 1px; height: 2px;
        border-radius: 2px; box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        background: linear-gradient(90deg, #22d3ee, #6366f1, #a78bfa);
        transform: scaleX(0); transform-origin: center;
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .nav-tab.nav-active::after { transform: scaleX(1); }
    /* no hover, no cursor block — give touch devices a plain active tint */
    @media (hover: none) {
        .nav-tab.nav-active { background: rgba(59, 130, 246, 0.1); }
        html.light-theme .nav-tab.nav-active { background: rgba(59, 130, 246, 0.08); }
    }

    /* auth / session chips */
    .nav-action-login {
        color: #60a5fa !important;
        background: rgba(59, 130, 246, 0.05);
        border: 1px solid rgba(59, 130, 246, 0.22) !important;
    }
    .nav-action-login:hover { background: rgba(59, 130, 246, 0.12); border-color: rgba(59, 130, 246, 0.45) !important; }
    .nav-action-signup {
        color: #fff !important;
        background: linear-gradient(135deg, #3b82f6, #4f46e5, #7c3aed) !important;
        border: 1px solid rgba(129, 140, 248, 0.45) !important;
        font-weight: 700; box-shadow: 0 8px 22px rgba(79, 70, 229, 0.3);
    }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(79, 70, 229, 0.42); }
    .nav-action-admin {
        color: #a5b4fc !important;
        background: rgba(99, 102, 241, 0.12); border: 1px solid rgba(99, 102, 241, 0.28) !important;
    }
    .nav-action-admin:hover { background: rgba(99, 102, 241, 0.2); }
    .nav-action-logout {
        color: #f87171 !important;
        border: 1px solid rgba(248, 113, 113, 0.24) !important;
    }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1); }

    /* ===== right group ===== */
    .nav-right-group { display: flex; align-items: center; gap: 0.45rem; flex-shrink: 0; }

    /* 200 OK chip */
    .nav-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.64rem; letter-spacing: 0.3px; color: #94a3b8;
        padding: 0.32rem 0.6rem; border-radius: 7px; white-space: nowrap;
        background: rgba(59, 130, 246, 0.06); border: 1px solid rgba(59, 130, 246, 0.14);
    }
    html.light-theme .nav-status { color: #475569; background: rgba(59, 130, 246, 0.05); }
    .nav-status-dot {
        width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0;
        background: #34d399; box-shadow: 0 0 8px rgba(52, 211, 153, 0.85);
        animation: statusPulse 2s ease infinite;
    }
    @keyframes statusPulse { 50% { opacity: 0.35; } }

    /* language: a segmented capsule, active flag gets the gradient */
    .lang-switcher {
        display: inline-flex; align-items: center; gap: 2px; margin: 0; padding: 2px;
        border-radius: 9px; background: rgba(59, 130, 246, 0.05);
        border: 1px solid rgba(59, 130, 246, 0.14);
    }
    html.light-theme .lang-switcher { background: rgba(59, 130, 246, 0.04); border-color: rgba(59, 130, 246, 0.16); }
    .lang-btn {
        display: inline-flex; align-items: center; justify-content: center;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 0.3px; color: #64748b;
        padding: 0.24rem 0.55rem; border-radius: 7px; white-space: nowrap;
        text-decoration: none !important;
        transition: color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
    }
    html.light-theme .lang-btn { color: #64748b; }
    .lang-btn:hover { color: #60a5fa; }
    .lang-btn.active {
        color: #e0f2fe;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.32);
    }
    .lang-divider { display: none; }

    /* theme toggle */
    .theme-toggle-btn {
        width: 34px; height: 34px; flex-shrink: 0; padding: 0;
        border-radius: 9px; border: 1px solid rgba(59, 130, 246, 0.18);
        background: rgba(59, 130, 246, 0.06); color: #60a5fa; font-size: 0.95rem;
        display: flex; align-items: center; justify-content: center; cursor: pointer;
        transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease,
                    transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .theme-toggle-btn:hover {
        background: rgba(59, 130, 246, 0.14); border-color: rgba(59, 130, 246, 0.4);
        transform: rotate(-20deg) scale(1.06);
    }
    .theme-toggle-btn:active { transform: rotate(20deg) scale(0.94); }
    html.light-theme .theme-toggle-btn {
        color: #f59e0b; border-color: rgba(245, 158, 11, 0.28); background: rgba(245, 158, 11, 0.1);
    }
    html.light-theme .theme-toggle-btn:hover { background: rgba(245, 158, 11, 0.18); }

    /* ===== hamburger ===== */
    .hamburger {
        display: none; flex-direction: column; gap: 4px;
        cursor: pointer; z-index: 1002; padding: 7px;
        background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.16);
        border-radius: 9px;
        transition: background 0.3s ease, border-color 0.3s ease;
    }
    .hamburger:hover { background: rgba(59, 130, 246, 0.16); border-color: rgba(59, 130, 246, 0.34); }
    .hamburger.active { background: rgba(59, 130, 246, 0.16); border-color: rgba(34, 211, 238, 0.45); }
    .hamburger span {
        display: block; width: 19px; height: 2px; border-radius: 2px;
        background: #e2e8f0; transform-origin: center;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease, width 0.35s ease;
    }
    html.light-theme .hamburger { background: rgba(59, 130, 246, 0.06); border-color: rgba(59, 130, 246, 0.15); }
    html.light-theme .hamburger:hover { background: rgba(59, 130, 246, 0.12); }
    html.light-theme .hamburger span { background: #334155; }
    .hamburger.active span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0.2); }
    .hamburger.active span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

    /* ================= MOBILE DRAWER — TERMINAL SESSION ================= */
    .mobile-backdrop {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.6); z-index: 1001;
        opacity: 0; visibility: hidden; cursor: pointer;
        transition: opacity 0.35s ease, visibility 0.35s ease;
        backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);
    }
    .mobile-backdrop.show { opacity: 1; visibility: visible; }
    html.light-theme .mobile-backdrop { background: rgba(0, 0, 0, 0.35); }

    .mobile-drawer {
        position: fixed; top: 0; right: 0;
        width: 84%; max-width: 350px;
        height: 100vh; height: 100dvh; z-index: 1002;
        display: flex; flex-direction: column; overflow: hidden;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.98), rgba(8, 13, 26, 0.99));
        -webkit-backdrop-filter: blur(24px); backdrop-filter: blur(24px);
        border-left: 1px solid rgba(147, 197, 253, 0.18);
        box-shadow: -20px 0 60px rgba(2, 8, 23, 0.6);
        transform: translateX(100%);
        transition: transform 0.42s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .mobile-drawer::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; z-index: 4;
        background: linear-gradient(90deg, transparent, #22d3ee, #6366f1, #a78bfa, transparent);
        background-size: 200% 100%; animation: navSweep 6s linear infinite;
        pointer-events: none;
    }
    html.light-theme .mobile-drawer {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(241, 245, 249, 0.99));
        border-left-color: rgba(59, 130, 246, 0.2);
        box-shadow: -20px 0 60px rgba(15, 23, 42, 0.18);
    }
    .mobile-drawer.open { transform: translateX(0); }

    /* window bar */
    .drawer-bar {
        display: flex; align-items: center; gap: 0.45rem; flex-shrink: 0;
        padding: 0.7rem 0.85rem;
        background: rgba(255, 255, 255, 0.03); border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    html.light-theme .drawer-bar { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .drawer-id { display: flex; align-items: center; gap: 0.35rem; min-width: 0; flex: 1 1 auto; }
    .mn-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .mn-dot.red { background: #ff5f57; }
    .mn-dot.yellow { background: #febc2e; }
    .mn-dot.green { background: #28c840; }
    .drawer-path {
        display: inline-flex; align-items: center; gap: 0.3rem; margin-left: 0.25rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.7rem; color: #94a3b8; white-space: nowrap;
        overflow: hidden; text-overflow: ellipsis;
    }
    .drawer-path i { color: #818cf8; }
    html.light-theme .drawer-path { color: #475569; }
    .mn-branch {
        display: inline-flex; align-items: center; gap: 0.3rem; flex-shrink: 0;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px;
        color: #93c5fd; background: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.26);
        padding: 0.14rem 0.45rem; border-radius: 50px; white-space: nowrap;
    }
    html.light-theme .mn-branch { color: #2563eb; }
    .drawer-close {
        width: 32px; height: 32px; padding: 0; flex-shrink: 0;
        border-radius: 9px; border: 1px solid rgba(59, 130, 246, 0.2);
        background: rgba(59, 130, 246, 0.06); color: var(--text-muted, #64748b);
        display: flex; align-items: center; justify-content: center; font-size: 0.95rem;
        cursor: pointer; transition: background 0.3s ease, color 0.3s ease, transform 0.35s ease;
    }
    .drawer-close:hover { background: rgba(59, 130, 246, 0.15); color: #60a5fa; transform: rotate(90deg); }

    /* typed command line */
    .drawer-cmd {
        display: flex; align-items: center; gap: 0.45rem; flex-shrink: 0;
        min-height: 2.05rem; padding: 0.4rem 0.85rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.7rem;
        background: rgba(2, 8, 23, 0.45); border-bottom: 1px solid rgba(148, 163, 184, 0.12);
    }
    html.light-theme .drawer-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .drawer-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .drawer-cmd-text { min-width: 0; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    html.light-theme .drawer-cmd-text { color: #1e293b; }
    .drawer-caret {
        flex-shrink: 0; width: 7px; height: 1em; border-radius: 1px;
        background: #34d399; box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: mnBlink 1s step-end infinite;
    }

    /* body */
    .drawer-body {
        flex: 1 1 auto; min-height: 0; overflow-y: auto;
        padding: 0.75rem 0.7rem 0.9rem;
        display: flex; flex-direction: column;
    }
    .drawer-sec { padding: 0.2rem 0.3rem 0.55rem; }
    .mn-k {
        display: inline-block;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.6px;
        color: #818cf8; background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.22);
        padding: 0.14rem 0.45rem; border-radius: 5px;
    }
    html.light-theme .mn-k { color: #4f46e5; background: rgba(99, 102, 241, 0.08); border-color: rgba(99, 102, 241, 0.2); }

    .drawer-nav { list-style: none; margin: 0; padding: 0; }
    .drawer-nav + .drawer-nav { margin-top: 0.15rem; }
    .drawer-nav li {
        margin-bottom: 4px; opacity: 0; transform: translateX(18px);
        transition: opacity 0.38s cubic-bezier(0.16, 1, 0.3, 1), transform 0.38s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .mobile-drawer.open .drawer-nav li { opacity: 1; transform: translateX(0); }
    .mobile-drawer.open .drawer-nav li:nth-child(1) { transition-delay: 0.05s; }
    .mobile-drawer.open .drawer-nav li:nth-child(2) { transition-delay: 0.10s; }
    .mobile-drawer.open .drawer-nav li:nth-child(3) { transition-delay: 0.15s; }
    .mobile-drawer.open .drawer-nav li:nth-child(4) { transition-delay: 0.20s; }
    .mobile-drawer.open .drawer-nav li:nth-child(5) { transition-delay: 0.25s; }
    .mobile-drawer.open .drawer-nav li:nth-child(6) { transition-delay: 0.30s; }
    .mobile-drawer.open .drawer-nav li:nth-child(7) { transition-delay: 0.35s; }
    .mobile-drawer.open .drawer-nav li:nth-child(8) { transition-delay: 0.40s; }

    .drawer-nav a,
    .drawer-nav button {
        position: relative; display: flex; align-items: center; gap: 0.6rem;
        width: 100%; padding: 0.6rem 0.7rem; text-align: left;
        border: 1px solid transparent; border-radius: 10px; background: none; cursor: pointer;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.84rem; font-weight: 500; color: #94a3b8; text-decoration: none;
        transition: color 0.25s ease, background 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
    }
    html.light-theme .drawer-nav a,
    html.light-theme .drawer-nav button { color: #475569; }
    /* rail that draws down the left edge on hover / active */
    .drawer-nav a::before,
    .drawer-nav button::before {
        content: ''; position: absolute; left: 0; top: 6px; bottom: 6px; width: 2px; border-radius: 2px;
        background: linear-gradient(180deg, #22d3ee, #6366f1);
        transform: scaleY(0); transform-origin: top;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .drawer-nav a:hover,
    .drawer-nav button:hover {
        color: #60a5fa; background: rgba(59, 130, 246, 0.07);
        border-color: rgba(59, 130, 246, 0.14); transform: translateX(3px);
    }
    .drawer-nav a:hover::before,
    .drawer-nav button:hover::before { transform: scaleY(1); }
    .drawer-nav a.active {
        color: #93c5fd; background: rgba(59, 130, 246, 0.12);
        border-color: rgba(99, 102, 241, 0.3);
    }
    .drawer-nav a.active::before { transform: scaleY(1); }
    .drawer-i {
        font-size: 0.58rem; font-weight: 700; color: #64748b;
        background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.16);
        border-radius: 5px; padding: 0.1rem 0.26rem; flex-shrink: 0;
    }
    html.light-theme .drawer-i { color: #64748b; }
    .drawer-nav a i.bi,
    .drawer-nav button i.bi { width: 18px; text-align: center; font-size: 0.9rem; color: #60a5fa; }
    .drawer-nav a.active i.bi { color: #22d3ee; }

    .drawer-divider { height: 1px; margin: 0.55rem 0.3rem; background: rgba(59, 130, 246, 0.12); }
    html.light-theme .drawer-divider { background: rgba(59, 130, 246, 0.16); }

    /* session chips */
    .drawer-login-btn {
        justify-content: center; color: #60a5fa;
        background: rgba(59, 130, 246, 0.08); border-color: rgba(59, 130, 246, 0.25) !important;
    }
    .drawer-login-btn:hover { background: rgba(59, 130, 246, 0.15); }
    .drawer-signup-btn {
        justify-content: center; color: #fff;
        background: linear-gradient(135deg, #3b82f6, #4f46e5, #7c3aed);
        border-color: rgba(129, 140, 248, 0.45) !important;
        box-shadow: 0 8px 22px rgba(79, 70, 229, 0.3);
    }
    .drawer-signup-btn:hover { transform: translateY(-1px); box-shadow: 0 12px 28px rgba(79, 70, 229, 0.4); }
    .drawer-signup-btn i.bi { color: #fff; }
    .drawer-logout-btn { color: #f87171; }
    .drawer-logout-btn i.bi { color: #f87171; }
    .drawer-logout-btn:hover { background: rgba(248, 113, 113, 0.08); color: #f87171; }
    .drawer-admin-btn { color: #a5b4fc; border-color: rgba(99, 102, 241, 0.24) !important; }
    .drawer-admin-btn:hover { background: rgba(99, 102, 241, 0.12); }

    /* footer: session status + language */
    .drawer-bottom {
        margin-top: auto; padding-top: 0.7rem;
        border-top: 1px dashed rgba(148, 163, 184, 0.18);
    }
    .drawer-status {
        display: flex; align-items: center; gap: 0.45rem;
        padding: 0 0.3rem 0.65rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem; color: #34d399;
    }
    .mn-live {
        width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0;
        background: #34d399; box-shadow: 0 0 9px rgba(52, 211, 153, 0.85);
        animation: mnPulse 2s ease-in-out infinite;
    }
    @keyframes mnPulse { 50% { opacity: 0.3; } }
    .drawer-footer { display: flex; justify-content: center; padding-bottom: 0.15rem; }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 992px) {
        .nav-status { display: none; }
    }

    @media (max-width: 768px) {
        .navbar-main { padding: 0.7rem 1rem; }
        .navbar-main.scrolled { padding: 0.45rem 1rem; }
        .nav-logo { font-size: 1.12rem; }
        .nav-center { display: none; }
        .nav-links { display: none !important; }
        .hamburger { display: flex; }
        .nav-right-group { gap: 0.4rem; }
        .theme-toggle-btn { width: 33px; height: 33px; font-size: 0.9rem; }
    }

    @media (max-width: 480px) {
        .navbar-main { padding: 0.55rem 0.8rem; }
        .navbar-main.scrolled { padding: 0.35rem 0.8rem; }
        .nav-logo { font-size: 1rem; }
        .nav-logo-caret { width: 7px; }
        .nav-right-group { gap: 0.3rem; }
        .hamburger { padding: 6px; }
        .hamburger span { width: 17px; }
        .hamburger.active span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
        .hamburger.active span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }
        .theme-toggle-btn { width: 30px; height: 30px; font-size: 0.82rem; }
        .lang-btn { font-size: 0.62rem; padding: 0.2rem 0.45rem; }
        .mobile-drawer { width: 88%; max-width: 330px; }
        .drawer-bar { padding: 0.6rem 0.7rem; }
        .drawer-path { font-size: 0.64rem; }
        .mn-branch { display: none; }
        .drawer-close { width: 29px; height: 29px; font-size: 0.85rem; }
        .drawer-cmd { font-size: 0.64rem; padding: 0.35rem 0.7rem; min-height: 1.9rem; }
        .drawer-body { padding: 0.6rem 0.55rem 0.75rem; }
        .drawer-nav a, .drawer-nav button { font-size: 0.78rem; padding: 0.52rem 0.6rem; gap: 0.5rem; }
        .drawer-nav a i.bi, .drawer-nav button i.bi { font-size: 0.84rem; width: 16px; }
        .drawer-status { font-size: 0.58rem; }
    }

    /* ===== BODY SCROLL LOCK ===== */
    body.menu-open { overflow: hidden !important; }

    /* ===== REDUCED MOTION ===== */
    @media (prefers-reduced-motion: reduce) {
        .navbar-main::before,
        .navbar-main::after,
        .mobile-drawer::before,
        .nav-logo-prompt,
        .nav-logo-caret,
        .nav-status-dot,
        .mn-live,
        .drawer-caret { animation: none; }
        .nav-cursor { transition: none; }
        .drawer-nav li { opacity: 1; transform: none; }
        .nav-links a:hover { transform: none; }
    }
</style>

<nav class="navbar-main" id="navbar">
    <!-- Brand -->
    <a href="/" class="nav-logo">
        <span class="nav-logo-prompt" aria-hidden="true">&#10095;</span>
        <span class="nav-logo-text">{{ optional($account)->name ?? config('app.name', 'Portfolio') }}</span>
        <span class="nav-logo-caret" aria-hidden="true"></span>
    </a>

    <!-- Desktop command tabs -->
    <div class="nav-center">
        <ul class="nav-links" id="navLinks">
            <li class="nav-cursor" aria-hidden="true"></li>
            <li>
                <a href="/" class="nav-tab {{ request()->is('/') ? 'nav-active' : '' }}">
                    <span class="nav-tab-i">01</span>
                    <i class="bi bi-house-fill"></i>{{ __('messages.home') }}
                </a>
            </li>
            @auth
                <li>
                    <a href="{{ route('inbox.index') }}" class="nav-tab {{ request()->is('inbox*') ? 'nav-active' : '' }}">
                        <span class="nav-tab-i">02</span>
                        <i class="bi bi-chat-dots"></i>{{ __('messages.inbox') }}
                    </a>
                </li>
                @if(auth()->user()->is_admin == 1)
                    <li>
                        <a href="/admin" class="nav-action-admin">
                            <i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}
                        </a>
                    </li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-action-logout">
                            <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="/login" class="nav-action-login">
                        <i class="bi bi-person-circle"></i>{{ __('messages.login') }}
                    </a>
                </li>
                <li>
                    <a href="/register" class="nav-action-signup">
                        <i class="bi bi-person-plus"></i>{{ __('messages.signup') }}
                    </a>
                </li>
            @endauth
        </ul>
    </div>

    <!-- Right group -->
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
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileDrawer">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile backdrop -->
<div class="mobile-backdrop" id="mobileBackdrop" aria-hidden="true"></div>

<!-- Mobile drawer: a terminal session window -->
<aside class="mobile-drawer" id="mobileDrawer" aria-label="Mobile navigation">
    <!-- window bar -->
    <div class="drawer-bar">
        <div class="drawer-id">
            <span class="mn-dot red" aria-hidden="true"></span>
            <span class="mn-dot yellow" aria-hidden="true"></span>
            <span class="mn-dot green" aria-hidden="true"></span>
            <span class="drawer-path"><i class="bi bi-folder-fill"></i> ~/portfolio</span>
        </div>
        <span class="mn-branch"><i class="bi bi-git"></i> nav</span>
        <button class="drawer-close" id="drawerClose" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- typed command -->
    <div class="drawer-cmd">
        <span class="drawer-prompt" aria-hidden="true">&#10095;</span>
        <span class="drawer-cmd-text" data-drawer-cmd="open ./menu">open ./menu</span>
        <span class="drawer-caret" aria-hidden="true"></span>
    </div>

    <!-- body -->
    <div class="drawer-body">
        <div class="drawer-sec"><span class="mn-k">PAGES</span></div>
        <ul class="drawer-nav">
            <li>
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                    <span class="drawer-i">01</span>
                    <i class="bi bi-house-fill"></i>{{ __('messages.home') }}
                </a>
            </li>
        </ul>

        <div class="drawer-divider"></div>

        <div class="drawer-sec"><span class="mn-k">SESSION</span></div>
        <ul class="drawer-nav">
            @auth
                <li>
                    <a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'active' : '' }}">
                        <span class="drawer-i">01</span>
                        <i class="bi bi-chat-dots"></i>{{ __('messages.inbox') }}
                    </a>
                </li>
                @if(auth()->user()->is_admin == 1)
                    <li>
                        <a href="/admin" class="drawer-admin-btn">
                            <span class="drawer-i">02</span>
                            <i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}
                        </a>
                    </li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="drawer-logout-btn">
                            <span class="drawer-i">03</span>
                            <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="/login" class="drawer-login-btn">
                        <span class="drawer-i">01</span>
                        <i class="bi bi-person-circle"></i>{{ __('messages.login') }}
                    </a>
                </li>
                <li>
                    <a href="/register" class="drawer-signup-btn">
                        <span class="drawer-i">02</span>
                        <i class="bi bi-person-plus"></i>{{ __('messages.signup') }}
                    </a>
                </li>
            @endauth
        </ul>

        <div class="drawer-bottom">
            <div class="drawer-status">
                <span class="mn-live" aria-hidden="true"></span>
                {{ auth()->check() ? 'session: user' : 'session: guest' }}
            </div>
            <div class="drawer-footer">
                <div class="lang-switcher">
                    <a href="{{ route('language.switch', 'en') }}"
                       class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                       title="{{ __('messages.english') }}">EN</a>
                    <a href="{{ route('language.switch', 'bn') }}"
                       class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
                       title="{{ __('messages.bengali') }}">বাংলা</a>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
// ===== MOBILE MENU TOGGLE (terminal drawer) =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var drawer = document.getElementById('mobileDrawer');
    var backdrop = document.getElementById('mobileBackdrop');
    var closeBtn = document.getElementById('drawerClose');
    var body = document.body;

    if (!hamburger || !drawer || !backdrop) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var cmdEl = drawer.querySelector('[data-drawer-cmd]');
    var typed = false;

    // the shell command types itself the first time the drawer opens
    function typeCmd() {
        if (!cmdEl || typed) return;
        typed = true;

        var full = cmdEl.getAttribute('data-drawer-cmd') || cmdEl.textContent || '';
        if (reduce) { cmdEl.textContent = full; return; }

        cmdEl.textContent = '';
        var i = 0;
        (function step() {
            cmdEl.textContent = full.slice(0, ++i);
            if (i < full.length) setTimeout(step, 60 + Math.random() * 40);
        })();
    }

    function openMenu() {
        drawer.classList.add('open');
        backdrop.classList.add('show');
        hamburger.classList.add('active');
        hamburger.setAttribute('aria-expanded', 'true');
        body.classList.add('menu-open');
        setTimeout(typeCmd, 260);
    }

    function closeMenu() {
        drawer.classList.remove('open');
        backdrop.classList.remove('show');
        hamburger.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
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
            setTimeout(closeMenu, 100);
        });
    });

    // Prevent clicks inside drawer from closing via backdrop
    drawer.addEventListener('click', function(e) {
        e.stopPropagation();
    });
})();

// ===== SLIDING TAB CURSOR (desktop) =====
(function() {
    var list = document.getElementById('navLinks');
    if (!list) return;

    var cursor = list.querySelector('.nav-cursor');
    var tabs = [].slice.call(list.querySelectorAll('.nav-tab'));
    if (!cursor || !tabs.length) return;

    // only worth it on real pointers, and never when motion is reduced
    if (!window.matchMedia || !window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var active = list.querySelector('.nav-tab.nav-active');

    // the tab <a> is position:relative, so measure its <li> instead — that one
    // is laid out against the tab strip, which is the cursor's containing block
    function park(el, animate) {
        var box = el ? (el.closest('li') || el) : null;
        if (!box || !box.offsetWidth) return;
        if (animate === false) cursor.style.transition = 'none';
        cursor.style.width = box.offsetWidth + 'px';
        cursor.style.transform = 'translate(' + box.offsetLeft + 'px, -50%)';
        cursor.classList.add('on');
        if (animate === false) {
            void cursor.offsetWidth;
            cursor.style.transition = '';
        }
    }

    tabs.forEach(function(tab) {
        tab.addEventListener('mouseenter', function() { park(tab, true); });
        tab.addEventListener('focus', function() { park(tab, true); });
    });

    list.addEventListener('mouseleave', function() {
        if (active) {
            park(active, true);
        } else {
            cursor.classList.remove('on');
        }
    });

    window.addEventListener('resize', function() {
        cursor.classList.remove('on');
        setTimeout(function() { park(active, false); }, 60);
    });

    // park it on the active tab once the bar has settled
    window.addEventListener('load', function() {
        setTimeout(function() { park(active, false); }, 120);
    });
    setTimeout(function() { park(active, false); }, 400);
})();
</script>
