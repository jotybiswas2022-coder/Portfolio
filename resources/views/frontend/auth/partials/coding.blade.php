<style>
    /* ===== AUTH — TERMINAL SHELL (shared by every auth page) ===== */
    .login-container .login-card {
        position: relative; overflow: hidden;
        padding: 0 !important;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.94) 0%, rgba(8, 15, 32, 0.97) 100%) !important;
        border: 1px solid rgba(147, 197, 253, 0.22) !important;
        border-radius: 16px !important;
        box-shadow: 0 30px 90px rgba(2, 8, 23, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.04) inset !important;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        -webkit-backdrop-filter: blur(18px) saturate(150%); backdrop-filter: blur(18px) saturate(150%);
        animation: authRise 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    html.light-theme .login-container .login-card {
        background: rgba(255, 255, 255, 0.96) !important;
        border-color: rgba(59, 130, 246, 0.25) !important;
        box-shadow: 0 24px 70px rgba(59, 130, 246, 0.14) !important;
    }
    /* hairline that keeps sweeping the top edge */
    .login-container .login-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; z-index: 4;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: authSweep 6s linear infinite;
        pointer-events: none;
    }
    @keyframes authSweep { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    @keyframes authRise { from { opacity: 0; transform: translateY(22px); } to { opacity: 1; transform: none; } }
    @keyframes authBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0.15; } }
    @keyframes authEnter { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: none; } }

    /* ---- window bar ---- */
    .auth-chrome {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.8rem; margin: 0;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }
    html.light-theme .auth-chrome { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .auth-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .auth-dot.red { background: #ff5f57; }
    .auth-dot.yellow { background: #febc2e; }
    .auth-dot.green { background: #28c840; }
    .auth-file {
        margin-left: 0.3rem; min-width: 0; font-size: 0.68rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    html.light-theme .auth-file { color: #334155; }
    .auth-branch {
        margin-left: auto; flex-shrink: 0; white-space: nowrap;
        font-size: 0.55rem; font-weight: 700; letter-spacing: 0.4px;
        color: #93c5fd; background: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.26);
        padding: 0.12rem 0.45rem; border-radius: 50px;
    }
    html.light-theme .auth-branch { color: #2563eb; }

    /* ---- typed command line ---- */
    .auth-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 2rem; padding: 0.4rem 0.85rem;
        font-size: 0.68rem;
        background: rgba(2, 8, 23, 0.45);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
    }
    html.light-theme .auth-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .auth-prompt { flex-shrink: 0; color: #34d399; font-weight: 700; }
    .auth-cmd-text { min-width: 0; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    html.light-theme .auth-cmd-text { color: #1e293b; }
    .auth-caret {
        flex-shrink: 0; width: 7px; height: 1em; border-radius: 1px;
        background: #34d399; box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: authBlink 1s step-end infinite;
    }

    /* ---- header becomes the prompt block ---- */
    .login-container .login-header {
        background: none !important; border: none !important; box-shadow: none !important;
        padding: 1.25rem 1.3rem 0.35rem !important; margin: 0 !important;
        height: auto !important; text-align: left !important;
        display: block !important;
        animation: authEnter 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.06s both;
    }
    html.light-theme .login-container .login-header { background: none !important; }
    .login-container .login-header h1 {
        margin: 0 0 0.15rem !important; font-size: 1.3rem !important; font-weight: 800 !important;
        letter-spacing: -0.5px; line-height: 1.25;
        font-family: 'Poppins', 'Hind Siliguri', system-ui, sans-serif;
        background: linear-gradient(135deg, #e2e8f0, #60a5fa);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    html.light-theme .login-container .login-header h1 {
        background: linear-gradient(135deg, #0f172a, #3b82f6);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .login-container .login-header h1::before {
        content: '❯ '; color: #22d3ee; -webkit-text-fill-color: #22d3ee; font-weight: 700;
    }
    .login-container .login-header p {
        margin: 0 !important; font-size: 0.74rem !important; color: #64748b !important;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
    }
    .login-container .header-icon, .login-container .lock-icon, .login-container .verify-icon {
        width: 46px !important; height: 46px !important; margin: 1.1rem auto 0.75rem !important;
        border-radius: 13px !important; color: #e0f2fe !important;
        background: linear-gradient(135deg, #3b82f6, #4f46e5, #7c3aed) !important;
        border: 1px solid rgba(129, 140, 248, 0.45) !important;
        box-shadow: 0 10px 28px rgba(79, 70, 229, 0.32) !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
        position: relative;
    }
    .login-container .header-icon svg, .login-container .lock-icon svg, .login-container .verify-icon svg {
        width: 22px !important; height: 22px !important;
    }
    .login-container .header-text { text-align: left !important; }

    /* ---- body ---- */
    .login-container .login-body {
        padding: 0.6rem 1.3rem 1.35rem !important;
        background: none !important; border: none !important;
        gap: 0.85rem !important;
        animation: authEnter 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.12s both;
    }

    /* ---- fields ---- */
    .login-container .input-group-custom,
    .login-container .input-group-animated { animation: authEnter 0.55s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .login-container .input-group-custom:nth-of-type(1) { animation-delay: 0.16s; }
    .login-container .input-group-custom:nth-of-type(2) { animation-delay: 0.22s; }
    .login-container .input-group-custom:nth-of-type(3) { animation-delay: 0.28s; }
    .login-container .input-label,
    .login-container .login-label,
    .login-container .form-label {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.7rem !important; letter-spacing: 0.2px; color: #818cf8 !important;
    }
    html.light-theme .login-container .input-label,
    html.light-theme .login-container .login-label,
    html.light-theme .login-container .form-label { color: #4f46e5 !important; }
    .login-container .input-label::before { content: '--'; color: #64748b; }
    .login-container .login-input,
    .login-container .form-control {
        background: rgba(2, 8, 23, 0.5) !important;
        border: 1px solid rgba(148, 163, 184, 0.18) !important;
        border-radius: 10px !important;
        color: #e2e8f0 !important;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace !important;
        font-size: 0.84rem !important;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease !important;
    }
    html.light-theme .login-container .login-input,
    html.light-theme .login-container .form-control {
        background: rgba(241, 245, 249, 0.9) !important; color: #0f172a !important;
        border-color: rgba(148, 163, 184, 0.4) !important;
    }
    .login-container .login-input:focus,
    .login-container .form-control:focus {
        border-color: rgba(99, 102, 241, 0.55) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.16) !important;
        outline: none !important;
    }
    .login-container .login-input::placeholder { color: rgba(148, 163, 184, 0.45) !important; }
    .login-container .input-icon { color: #818cf8 !important; }
    .login-container .password-toggle {
        color: #64748b !important; background: rgba(59, 130, 246, 0.06) !important;
        border: 1px solid rgba(59, 130, 246, 0.16) !important; border-radius: 8px !important;
        transition: color 0.3s ease, background 0.3s ease, border-color 0.3s ease !important;
    }
    .login-container .password-toggle:hover { color: #22d3ee !important; border-color: rgba(34, 211, 238, 0.4) !important; }

    /* ---- errors / notices ---- */
    .login-container .error-message,
    .login-container .invalid-feedback {
        display: flex !important; align-items: flex-start; gap: 0.4rem;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace !important;
        font-size: 0.68rem !important; color: #f87171 !important;
    }
    .login-container .error-message::before,
    .login-container .invalid-feedback::before { content: '-'; font-weight: 700; }
    .login-container .alert,
    .login-container .alert-custom,
    .login-container .alert-success,
    .login-container .alert-success-custom {
        background: rgba(52, 211, 153, 0.08) !important; border: 1px solid rgba(52, 211, 153, 0.28) !important;
        color: #34d399 !important; border-radius: 10px !important;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace !important;
        font-size: 0.72rem !important;
    }
    .login-container .alert::before, .login-container .alert-success::before { content: '+ '; font-weight: 700; }

    /* ---- submit ---- */
    .login-container .login-btn {
        position: relative; overflow: hidden;
        display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 0.5rem;
        width: 100%; padding: 0.8rem 1.1rem !important;
        background: linear-gradient(135deg, #1d4ed8, #4f46e5, #7c3aed) !important;
        border: 1px solid rgba(129, 140, 248, 0.45) !important; border-radius: 11px !important;
        color: #fff !important; font-weight: 700 !important; font-size: 0.82rem !important;
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace !important;
        box-shadow: 0 12px 30px rgba(79, 70, 229, 0.3) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease !important;
        animation: authEnter 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
    }
    .login-container .login-btn::before {
        content: '❯'; font-weight: 700; color: #c7d2fe;
    }
    .login-container .login-btn::after {
        content: ''; position: absolute; top: 0; bottom: 0; left: -45%; width: 45%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.26), transparent);
        transform: skewX(-16deg); transition: left 0.6s ease;
    }
    .login-container .login-btn:hover::after { left: 118%; }
    .login-container .login-btn:hover { transform: translateY(-2px) !important; box-shadow: 0 18px 40px rgba(79, 70, 229, 0.42) !important; }
    .login-container .login-btn:active { transform: translateY(0) scale(0.99) !important; }
    .login-container .login-btn:disabled { opacity: 0.85; cursor: progress; }

    /* ---- links / checkboxes / dividers ---- */
    .login-container .checkbox-label,
    .login-container .checkbox-custom,
    .login-container .forgot-link,
    .login-container .login-link,
    .login-container .login-footer {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.7rem;
    }
    .login-container .forgot-link,
    .login-container .login-link { color: #60a5fa !important; text-decoration: none; }
    .login-container .forgot-link:hover,
    .login-container .login-link:hover { color: #c4b5fd !important; }
    .login-container .divider { color: #475569 !important; opacity: 1 !important; }

    /* ---- verify / text blocks ---- */
    .login-container .instructions,
    .login-container .verify-text,
    .login-container .verify-text-small {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace !important;
        font-size: 0.76rem !important; color: #94a3b8 !important; line-height: 1.7 !important;
        animation: authEnter 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
    }
    .login-container .verify-icon-wrapper { animation: authEnter 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both; }

    /* ================= MOBILE ================= */
    @media (max-width: 480px) {
        .login-container .login-header { padding: 1rem 0.95rem 0.3rem !important; }
        .login-container .login-header h1 { font-size: 1.1rem !important; }
        .login-container .login-body { padding: 0.5rem 0.95rem 1.1rem !important; }
        .login-container .header-icon, .login-container .lock-icon, .login-container .verify-icon {
            width: 40px !important; height: 40px !important; margin: 0.85rem auto 0.6rem !important;
        }
        .login-container .login-btn { font-size: 0.78rem !important; padding: 0.7rem 1rem !important; }
        .auth-file { font-size: 0.62rem; }
        .auth-cmd { font-size: 0.62rem; padding: 0.35rem 0.7rem; }
    }
    @media (max-width: 380px) {
        .auth-cmd, .auth-branch { display: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        .login-container .login-card, .login-container .login-header, .login-container .login-body,
        .login-container .input-group-custom, .login-container .login-btn,
        .login-container .instructions, .login-container .verify-icon-wrapper { animation: none; }
        .login-container .login-card::before, .auth-caret { animation: none; }
        .login-container .login-btn:hover { transform: none !important; }
    }

    /* ===== ONE TYPEFACE EVERYWHERE (same English font as the hero tagline) =====
       Every terminal-style monospace declaration above is intentionally
       overridden here; Bengali still falls back to Hind Siliguri, and icon
       fonts keep their own vendor !important rules. */
    html body,
    html body *:not(.bi):not([class*="bi-"]):not([class^="bi-"]):not([class*="fa-"]):not([class^="fa-"]) {
        font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif !important;
    }
</style>

<!-- make sure the shared typeface is available even if the page forgot it -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script>
(function () {
    var card = document.querySelector('.login-card');
    if (!card) return;

    // figure out which auth screen this is, straight from the URL
    var path = window.location.pathname;
    var routes = [
        [/\/login/i,    'login',   'auth:login'],
        [/\/register/i, 'register', 'auth:register'],
        [/\/verify/i,   'verify',  'auth:verify'],
        [/\/password\/reset/i,   'reset',   'auth:reset'],
        [/\/password\/confirm/i, 'confirm', 'auth:confirm'],
        [/\/password|forgot/i,   'forgot',  'auth:forgot']
    ];
    for (var i = 0; i < routes.length; i++) {
        if (routes[i][0].test(path)) { name = routes[i][1]; cmd = routes[i][2]; break; }
    }
    var name = name || 'auth';
    var cmd = cmd || 'php artisan auth';

    // window bar + typed command line, on top of whatever the page rendered
    var chrome = document.createElement('div');
    chrome.className = 'auth-chrome';
    chrome.setAttribute('aria-hidden', 'true');
    chrome.innerHTML = '<span class="auth-dot red"></span><span class="auth-dot yellow"></span>' +
        '<span class="auth-dot green"></span>' +
        '<span class="auth-file">~/portfolio/auth/' + name + '.php</span>' +
        '<span class="auth-branch">main</span>';

    var line = document.createElement('div');
    line.className = 'auth-cmd';
    line.setAttribute('aria-hidden', 'true');
    line.innerHTML = '<span class="auth-prompt">&#10095;</span>' +
        '<span class="auth-cmd-text"></span><span class="auth-caret"></span>';

    card.insertBefore(line, card.firstChild);
    card.insertBefore(chrome, line);

    // the command types itself in, once
    var el = line.querySelector('.auth-cmd-text');
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!el) return;
    if (reduce) { el.textContent = cmd; return; }

    var i = 0;
    (function type() {
        el.textContent = cmd.slice(0, ++i);
        if (i < cmd.length) setTimeout(type, 55 + Math.random() * 40);
    })();
})();
</script>
