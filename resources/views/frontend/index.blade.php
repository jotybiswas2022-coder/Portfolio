@extends('frontend.app')

@section('content')
<style>
    /* ===== INDEX PAGE - DARK PORTFOLIO THEME ===== */
    :root {
        --bg-primary: #0a0f1e;
        --bg-secondary: #0f172a;
        --bg-card: rgba(17, 28, 46, 0.8);
        --bg-nav: rgba(10, 15, 30, 0.88);
        --accent: #3b82f6;
        --accent-light: #60a5fa;
        --accent-dark: #2563eb;
        --accent-gradient: linear-gradient(135deg, #3b82f6, #8b5cf6);
        --accent-gradient-2: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: rgba(59, 130, 246, 0.12);
        --border-hover: rgba(59, 130, 246, 0.3);
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.5);
        --shadow-accent: 0 10px 40px rgba(59, 130, 246, 0.3);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        --font: 'Poppins', 'Hind Siliguri', sans-serif;
    }

    /* Light Theme � full override with higher specificity than :root */
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
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
    html.light-theme body { background: #f8fafc; }

    /* Hero Light Theme */
    html.light-theme .hero {
        background: linear-gradient(180deg, #eef4ff 0%, #f8fafc 100%);
    }
    html.light-theme .hero::before {
        background: radial-gradient(circle, rgba(59, 130, 246, 0.07), transparent 70%);
    }
    html.light-theme .float-chip {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(59, 130, 246, 0.25);
        color: #475569;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }
    html.light-theme .float-chip i {
        color: #3b82f6;
    }
    html.light-theme .code-fragment { color: rgba(99, 102, 241, 0.35); }
    html.light-theme .code-fragment b { color: rgba(234, 120, 70, 0.55); }
    html.light-theme .code-fragment em { color: rgba(22, 160, 90, 0.5); }
    html.light-theme .hero-aurora { opacity: 0.5; }
    html.light-theme #hero-canvas { opacity: 0.65; }
    html.light-theme .hero-scan {
        background: linear-gradient(180deg, transparent, rgba(30,41,59,0.05) 35%, rgba(30,41,59,0.12) 50%, rgba(30,41,59,0.05) 65%, transparent);
    }
    html.light-theme .project-card {
        background: linear-gradient(145deg, #ffffff, #f8fafc) !important;
    }
    html.light-theme .timeline-card,
    html.light-theme .contact-form,
    html.light-theme .contact-item,
    html.light-theme .testimonial-card,
    html.light-theme .faq-item {
        background: rgba(255, 255, 255, 0.85) !important;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: auto; }
    body {
        width: 100%;
        font-family: var(--font);
        background: var(--bg-primary);
        color: var(--text-primary);
        overflow-x: hidden;
        line-height: 1.6;
    }
    ::selection { background: rgba(59, 130, 246, 0.3); color: #fff; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg-primary); }
    ::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.5); }

    /* Particles */
    #particles-canvas {
        position: fixed; top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0; pointer-events: none;
    }

    /* ===== Hero Decorative Effects ===== */

    /* Code Grid Background */
    .code-grid-bg {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none; z-index: 0; overflow: hidden;
        background-image:
            linear-gradient(rgba(59,130,246,0.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59,130,246,0.07) 1px, transparent 1px);
        background-size: 48px 48px;
        -webkit-mask-image: radial-gradient(circle at center, #000 0%, transparent 72%);
        mask-image: radial-gradient(circle at center, #000 0%, transparent 72%);
    }

    /* Scan beam sweep */
    .hero-scan {
        position: absolute; left: 0; right: 0; top: -20%;
        height: 130px; z-index: 0; pointer-events: none;
        background: linear-gradient(180deg, transparent, rgba(59,130,246,0.05) 35%, rgba(59,130,246,0.16) 50%, rgba(59,130,246,0.05) 65%, transparent);
        animation: scanMove 7s linear infinite;
    }
    @keyframes scanMove { 0% { top: -20%; } 100% { top: 115%; } }

    /* Text glow for readability over the animated background */
    .hero h1 { text-shadow: 0 2px 26px rgba(2, 6, 18, 0.85), 0 0 3px rgba(2, 6, 18, 0.6); }
    .hero p  { text-shadow: 0 2px 18px rgba(2, 6, 18, 0.9), 0 0 2px rgba(2, 6, 18, 0.7); }
    .hero-badge { text-shadow: 0 1px 12px rgba(2, 6, 18, 0.8); }
    html.light-theme .hero h1 { text-shadow: 0 2px 22px rgba(255, 255, 255, 0.8); }
    html.light-theme .hero p  { text-shadow: 0 2px 16px rgba(255, 255, 255, 0.8); }
    html.light-theme .hero-badge { text-shadow: 0 1px 10px rgba(255, 255, 255, 0.7); }
    html.light-theme .hero h1 .gradient-text {
        background-image: linear-gradient(120deg,
            #2563eb, #7c3aed, #db2777, #fb923c,
            #0891b2, #4f46e5, #2563eb);
        background-size: 400% 400%;
        filter: drop-shadow(0 0 14px rgba(37, 99, 235, 0.18));
    }

    /* Aurora color glows (full-page coverage) */
    .hero-aurora {
        position: absolute; top: -20%; left: -10%; right: -10%; bottom: -20%;
        z-index: 0; pointer-events: none;
        background:
            radial-gradient(38% 48% at 12% 16%, rgba(59,130,246,0.34), transparent 50%),
            radial-gradient(40% 50% at 88% 18%, rgba(99,102,241,0.34), transparent 50%),
            radial-gradient(48% 56% at 18% 80%, rgba(16,185,129,0.24), transparent 72%),
            radial-gradient(50% 58% at 82% 76%, rgba(192,38,211,0.22), transparent 72%),
            radial-gradient(44% 46% at 50% 50%, rgba(56,132,255,0.14), transparent 78%),
            radial-gradient(30% 38% at 50% 2%, rgba(129,140,248,0.18), transparent 70%);
        animation: auroraDrift 26s ease-in-out infinite;
    }
    @keyframes auroraDrift {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        33% { transform: translate3d(-2.5%, 2.5%, 0) scale(1.06); }
        66% { transform: translate3d(2%, -2%, 0) scale(0.97); }
    }

    /* Hero canvas (starfield + orbit ring + horizon grid) */
    #hero-canvas {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        width: 100%; height: 100%;
        z-index: 0; pointer-events: none;
    }

    /* Floating Code Fragments */
    .code-fragment {
        position: absolute; z-index: 0; pointer-events: none;
        font-family: 'Consolas', 'Fira Code', 'Cascadia Code', monospace;
        font-size: 0.9rem; font-weight: 500; letter-spacing: 0.5px;
        color: rgba(99,102,241,0.4);
        white-space: nowrap; opacity: 0;
        animation: fragmentFade 14s ease-in-out infinite;
    }
    .code-fragment b { color: rgba(255,170,90,0.5); font-weight: 700; }
    .code-fragment em { color: rgba(52,211,153,0.45); font-style: normal; }
    .code-fragment.f1 { top: 16%; left: 7%; animation-delay: 0s; }
    .code-fragment.f2 { top: 28%; right: 14%; animation-delay: 1.6s; }
    .code-fragment.f3 { top: 56%; left: 4%; animation-delay: 3.2s; }
    .code-fragment.f4 { bottom: 20%; right: 6%; animation-delay: 4.8s; }
    .code-fragment.f5 { top: 10%; right: 30%; animation-delay: 6.4s; }
    .code-fragment.f6 { bottom: 10%; left: 16%; animation-delay: 8s; }
    @keyframes fragmentFade {
        0%, 6% { opacity: 0; transform: translateY(14px); }
        12%, 78% { opacity: 1; transform: translateY(0); }
        92%, 100% { opacity: 0; transform: translateY(-14px); }
    }

    /* Floating Chips */
    .float-chip { position: absolute; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(15,23,42,0.7); backdrop-filter: blur(10px); border: 1px solid rgba(59,130,246,0.2); border-radius: 50px; font-size: 0.75rem; color: var(--accent-light); pointer-events: none; z-index: 1; white-space: nowrap; }
    .float-chip i { font-size: 0.8rem; }
    .float-chip.c1 { top: 14%; left: 4%; animation: floatChip 5s ease-in-out infinite; }
    .float-chip.c2 { display: none; }
    .float-chip.c3 { top: 42%; left: 5%; animation: floatChip 4.5s ease-in-out infinite 0.5s; }
    .float-chip.c4 { top: 22%; right: 4%; animation: floatChip 5.5s ease-in-out infinite 1s; }
    .float-chip.c5 { top: 60%; right: 4%; animation: floatChip 4.8s ease-in-out infinite 1.5s; }
    @keyframes floatChip { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }

    /* Shimmer Text */
    .shimmer-text { background: linear-gradient(90deg, var(--accent-light) 0%, #60a5fa 25%, #a78bfa 50%, #60a5fa 75%, var(--accent-light) 100%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; animation: shimmerMove 3s linear infinite; display: inline; }
    @keyframes shimmerMove { 0% { background-position: 0% center; } 100% { background-position: 200% center; } }

    /* Custom Cursor */
    .cursor-glow {
        width: 36px; height: 36px;
        border-radius: 50%; position: fixed;
        pointer-events: none; z-index: 99999;
        transform: translate(-50%, -50%);
        border: 2px solid rgba(59,130,246,0.5);
        background: rgba(59,130,246,0.06);
        box-shadow: 0 0 30px rgba(59,130,246,0.1), inset 0 0 20px rgba(59,130,246,0.04);
        will-change: transform;
        transition: width 0.2s ease, height 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }
    .cursor-glow.active {
        width: 48px; height: 48px;
        border-color: var(--accent);
        background: rgba(59,130,246,0.1);
        box-shadow: 0 0 40px rgba(59,130,246,0.2), inset 0 0 30px rgba(59,130,246,0.06);
    }
    html.light-theme .cursor-glow {
        border-color: rgba(59,130,246,0.35);
        background: rgba(59,130,246,0.03);
    }
    html.light-theme .cursor-glow.active {
        border-color: var(--accent);
        background: rgba(59,130,246,0.08);
    }
    @media (max-width: 968px) { .cursor-glow { display: none; } }

    /* Hero */
    .hero {
        min-height: 100vh; display: flex; align-items: center;
        justify-content: center; text-align: center;
        position: relative; z-index: 1; padding: 6rem 2rem 2rem;
    }
    .hero-content { max-width: 850px; position: relative; z-index: 2; }
    .hero::before {
        content: ''; position: absolute;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.12), transparent 70%);
        border-radius: 50%; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        animation: pulseOrb 5s ease-in-out infinite;
    }
    @keyframes pulseOrb {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.15); opacity: 0.8; }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.4rem 1.2rem;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 50px; font-size: 0.82rem;
        color: var(--accent-light); margin-bottom: 1.5rem;
        opacity: 0; transform: translateY(-20px);
        animation: fadeInDown 0.8s ease forwards;
    }
    .hero h1 {
        font-size: clamp(2.8rem, 7vw, 5.5rem); font-weight: 900;
        line-height: 1.05; margin-bottom: 1rem;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.2s; letter-spacing: -1.5px;
    }
    .hero h1 .gradient-text {
        background: linear-gradient(120deg,
            #93c5fd, #a5f3fc, #c4b5fd, #e9d5ff,
            #a7f3d0, #bfdbfe, #93c5fd);
        background-size: 400% 400%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        text-shadow: none;
        animation: gradientFlow 6s linear infinite;
        filter: drop-shadow(0 0 22px rgba(129, 140, 248, 0.35));
    }
    @keyframes gradientFlow {
        0%   { background-position: 0% 30%; }
        25%  { background-position: 40% 70%; }
        50%  { background-position: 100% 50%; }
        75%  { background-position: 60% 10%; }
        100% { background-position: 0% 30%; }
    }

    .hero p {
        font-size: 1.15rem; color: var(--text-secondary);
        max-width: 640px; margin: 0 auto 2.5rem;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.4s; line-height: 1.8;
    }
    .hero-buttons {
        display: flex; gap: 1rem; justify-content: center;
        flex-wrap: wrap;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards; animation-delay: 0.6s;
    }
    .btn-primary-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem;
        background: var(--accent-gradient); color: #fff;
        border: none; border-radius: var(--radius-md);
        font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .btn-primary-custom::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }
    .btn-primary-custom:hover::before { left: 100%; }
    .btn-primary-custom:hover {
        transform: translateY(-3px); box-shadow: var(--shadow-accent);
    }
    .btn-outline-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem; background: transparent;
        color: var(--accent-light); border: 2px solid rgba(59, 130, 246, 0.35);
        border-radius: var(--radius-md); font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
    }
    .btn-outline-custom:hover {
        background: rgba(59, 130, 246, 0.08);
        border-color: var(--accent); transform: translateY(-3px);
    }
    .scroll-indicator {
        position: absolute; bottom: 2rem; left: 50%;
        transform: translateX(-50%); animation: bounce 2s ease infinite;
    }
    .scroll-indicator .mouse {
        width: 24px; height: 38px;
        border: 2px solid rgba(59, 130, 246, 0.4);
        border-radius: 12px; display: flex;
        justify-content: center; padding-top: 7px;
    }
    .scroll-indicator .wheel {
        width: 3px; height: 9px; background: var(--accent);
        border-radius: 3px; animation: scrollWheel 1.5s ease infinite;
    }
    @keyframes scrollWheel {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(12px); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }

    /* Sections */
    section { position: relative; z-index: 1; }
    .section-padding { padding: 7rem 2rem; }
    .container { max-width: 1200px; margin: 0 auto; padding-left: 1rem; padding-right: 1rem; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .reveal { transform: translateY(60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* ===== ABOUT - GIT LOG PROFILE (coding design) ===== */
    .about-section {
        background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
        position: relative;
        overflow: hidden;
    }
    .about-section::before {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse at 40% 45%, #000 0%, transparent 70%);
        mask-image: radial-gradient(ellipse at 40% 45%, #000 0%, transparent 70%);
        pointer-events: none;
    }
    html.light-theme .about-section { background: linear-gradient(180deg, #eef3fb 0%, #f8fafc 100%); }
    .about-shell { position: relative; max-width: 1040px; width: 100%; margin: 0 auto; }

    /* Traffic-light dots (shared with the services + pricing cards) */
    .ab-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; }
    .ab-dot.red { background: #ff5f57; }
    .ab-dot.yellow { background: #febc2e; }
    .ab-dot.green { background: #28c840; }
    .ab-dot2 {
        width: 7px; height: 7px; border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.9);
        animation: abPulse 1.6s ease-in-out infinite;
    }
    @keyframes abPulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.45; } }

    /* Floating tech chips */
    .ab-chip {
        position: absolute; z-index: 4; pointer-events: none;
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.72rem; font-weight: 700;
        color: rgba(147, 197, 253, 0.85);
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(59, 130, 246, 0.28);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        padding: 0.45rem 0.85rem; border-radius: 50px;
        box-shadow: 0 8px 30px rgba(2, 8, 23, 0.35);
        white-space: nowrap;
        animation: abFloat 6s ease-in-out infinite;
    }
    .ab-chip i { color: var(--accent-light); }
    html.light-theme .ab-chip {
        background: rgba(255, 255, 255, 0.85);
        color: #3b82f6;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.16);
    }
    .ab-chip.c1 { top: -1.1rem; left: -1.3rem; }
    .ab-chip.c2 { top: 10rem; left: -1.1rem; animation-delay: 1s; }
    .ab-chip.c3 { top: -1.1rem; right: -1.3rem; animation-delay: 2s; }
    .ab-chip.c4 { top: 9rem; right: -1.1rem; animation-delay: 3s; }
    @keyframes abFloat { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

    /* ==== GIT WINDOW ==== */
    .gl-wb {
        position: relative; z-index: 1;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.6) 0%, rgba(8, 15, 32, 0.45) 100%);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(147, 197, 253, 0.22);
        border-radius: 20px;
        overflow: hidden;
        box-shadow:
            0 40px 110px rgba(2, 8, 23, 0.7),
            0 0 0 1px rgba(255, 255, 255, 0.06) inset,
            0 0 70px rgba(59, 130, 246, 0.09);
        transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }
    html.light-theme .gl-wb {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.74) 0%, rgba(230, 240, 252, 0.6) 100%);
        border-color: rgba(59, 130, 246, 0.28);
        box-shadow: 0 40px 90px rgba(59, 130, 246, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.7) inset;
    }
    .gl-wb::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #3b82f6, #22d3ee, #8b5cf6, transparent);
        background-size: 200% 100%;
        animation: atSweep 6s linear infinite;
        z-index: 3;
    }
    @keyframes atSweep { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

    /* Title bar */
    .gl-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.62rem 0.95rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }
    html.light-theme .gl-bar {
        background: rgba(15, 23, 42, 0.035);
        border-bottom-color: rgba(15, 23, 42, 0.08);
    }
    .gl-repo {
        display: inline-flex; align-items: center; gap: 0.4rem;
        margin-left: 0.35rem; font-size: 0.74rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .gl-repo i { color: #f97316; }
    html.light-theme .gl-repo { color: #334155; }
    .gl-branch {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.64rem; font-weight: 700; color: #93c5fd;
        background: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.25);
        padding: 0.2rem 0.6rem; border-radius: 50px;
        white-space: nowrap;
    }
    html.light-theme .gl-branch { color: #2563eb; background: rgba(59, 130, 246, 0.1); }
    .gl-avail {
        margin-left: auto; flex-shrink: 0;
        display: inline-flex; align-items: center; gap: 0.45rem;
        font-size: 0.68rem; color: #34d399;
        background: rgba(52, 211, 153, 0.08);
        border: 1px solid rgba(52, 211, 153, 0.28);
        padding: 0.26rem 0.7rem; border-radius: 50px;
        white-space: nowrap;
    }

    /* Command line */
    .gl-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 2.5rem;
        padding: 0.55rem 0.95rem;
        font-size: 0.78rem;
        background: rgba(2, 8, 23, 0.45);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        overflow: hidden;
    }
    html.light-theme .gl-cmd {
        background: rgba(15, 23, 42, 0.05);
        border-bottom-color: rgba(15, 23, 42, 0.08);
    }
    .gl-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .gl-cmd-text {
        color: #e2e8f0;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    html.light-theme .gl-cmd-text { color: #1e293b; }
    .gl-caret {
        display: inline-block; width: 8px; height: 1em; flex-shrink: 0;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: glBlink 1s step-end infinite;
    }
    @keyframes glBlink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }

    /* Commit log */
    .gl-body { padding: 1.35rem 1.4rem 1.5rem; }
    .gl-commits { position: relative; display: flex; flex-direction: column; gap: 1.15rem; }
    .gl-commits::before {
        content: '';
        position: absolute; left: 0.72rem; top: 1.1rem; bottom: 0.5rem; width: 2px;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6 55%, #22d3ee);
        border-radius: 2px;
        transform: scaleY(1); transform-origin: top;
        transition: transform 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s;
    }
    .gl-wb.gl-armed .gl-commits::before { transform: scaleY(0); }

    .gl-commit {
        position: relative;
        padding-left: 2.5rem;
        transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        transition-delay: calc(var(--i, 0) * 140ms + 120ms);
    }
    .gl-wb.gl-armed .gl-commit { opacity: 0; transform: translateX(-16px); }
    .gl-wb.gl-ready .gl-commit { opacity: 1; transform: translateX(0); }

    .gl-node {
        position: absolute; left: 0.3rem; top: 1.05rem;
        width: 0.86rem; height: 0.86rem; border-radius: 50%;
        background: #0b1424; border: 2px solid #3b82f6;
        transition: opacity 0.4s ease, transform 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.5);
        transition-delay: calc(var(--i, 0) * 140ms + 200ms);
    }
    html.light-theme .gl-node { background: #fff; }
    .gl-node::after {
        content: ''; position: absolute; inset: 2px; border-radius: 50%;
        background: #60a5fa;
    }
    .gl-node::before {
        content: ''; position: absolute; inset: -6px; border-radius: 50%;
        border: 1px solid rgba(96, 165, 250, 0.45);
        opacity: 0;
    }
    .gl-wb.gl-armed .gl-node { opacity: 0; transform: scale(0.3); }
    .gl-wb.gl-ready .gl-node { opacity: 1; transform: scale(1); }
    .gl-wb.gl-ready .gl-node::before { animation: glRing 2.8s ease-out infinite; animation-delay: calc(var(--i, 0) * 0.4s); }
    @keyframes glRing {
        0% { opacity: 0.7; transform: scale(0.6); }
        70%, 100% { opacity: 0; transform: scale(1.6); }
    }

    .gl-card {
        position: relative;
        background: rgba(255, 255, 255, 0.028);
        border: 1px solid rgba(148, 163, 184, 0.16);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.35s ease, transform 0.35s ease, box-shadow 0.35s ease;
    }
    html.light-theme .gl-card { background: rgba(255, 255, 255, 0.62); border-color: rgba(15, 23, 42, 0.08); }
    .gl-commit:hover .gl-card {
        border-color: var(--border-hover);
        transform: translateX(4px);
        box-shadow: var(--shadow-sm);
    }
    .gl-card::before {
        content: '';
        position: absolute; top: 0; bottom: 0; left: 0; width: 2px;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        opacity: 0; transition: opacity 0.35s ease;
    }
    .gl-commit:hover .gl-card::before { opacity: 1; }

    .gl-head {
        display: flex; align-items: center; flex-wrap: wrap; gap: 0.5rem;
        padding: 0.55rem 0.85rem;
        font-size: 0.71rem;
        background: rgba(2, 8, 23, 0.28);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
    }
    html.light-theme .gl-head { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.07); }
    .gl-hash { min-width: 7ch; color: #fbbf24; letter-spacing: 0.4px; }
    .gl-ref {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.3px;
        color: #93c5fd; background: rgba(59, 130, 246, 0.14);
        border: 1px solid rgba(59, 130, 246, 0.3);
        padding: 0.14rem 0.45rem; border-radius: 5px;
        white-space: nowrap;
    }
    .gl-msg { color: #cbd5e1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    html.light-theme .gl-msg { color: #334155; }
    .gl-ty { font-weight: 700; }
    .gl-ty.feat { color: #4ade80; }
    .gl-ty.docs { color: #60a5fa; }
    .gl-ty.chore { color: #c084fc; }
    .gl-ty.build { color: #fbbf24; }
    .gl-stat { margin-left: auto; display: inline-flex; gap: 0.35rem; font-size: 0.67rem; font-weight: 700; flex-shrink: 0; }
    .gl-stat b { color: #34d399; }
    .gl-stat i { color: #f87171; font-style: normal; }

    .gl-diff { padding: 0.85rem 0.95rem 1rem; display: flex; flex-direction: column; gap: 0.75rem; }
    .gl-diff > * {
        transition: opacity 0.55s ease, transform 0.55s ease;
        transition-delay: calc(var(--i, 0) * 140ms + 320ms);
    }
    .gl-wb.gl-armed .gl-diff > * { opacity: 0; transform: translateY(8px); }
    .gl-wb.gl-ready .gl-diff > * { opacity: 1; transform: translateY(0); }
    .gl-hunk {
        font-size: 0.67rem; color: #7c8aa5;
        background: rgba(59, 130, 246, 0.07);
        border-left: 2px solid rgba(59, 130, 246, 0.45);
        border-radius: 0 6px 6px 0;
        padding: 0.3rem 0.6rem;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    html.light-theme .gl-hunk { color: #64748b; background: rgba(59, 130, 246, 0.06); }

    /* identity block */
    .gl-user { display: flex; align-items: center; gap: 1rem; min-width: 0; }
    .gl-avatar {
        position: relative; flex-shrink: 0;
        width: 74px; height: 74px; border-radius: 20px; padding: 2px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6, #22d3ee);
        background-size: 200% 200%;
        animation: glGrad 6s ease infinite;
        box-shadow: 0 10px 28px rgba(59, 130, 246, 0.3);
    }
    @keyframes glGrad { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
    .gl-avatar img {
        width: 100%; height: 100%;
        border-radius: 18px; object-fit: cover; display: block;
        background: #0b1424;
    }
    .gl-initial {
        width: 100%; height: 100%; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        background: #0b1424; color: #60a5fa;
        font-size: 1.85rem; font-weight: 800;
    }
    html.light-theme .gl-initial { background: #eef2f7; color: #2563eb; }
    .gl-id { min-width: 0; }
    .gl-name-line { display: flex; align-items: center; gap: 0.4rem; }
    .gl-name {
        margin: 0;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 1.32rem; font-weight: 800; line-height: 1.2;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .gl-verify { color: #3b82f6; font-size: 0.95rem; flex-shrink: 0; }
    .gl-role {
        display: block; margin: 0.15rem 0 0.35rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.8rem; color: var(--text-secondary);
    }
    .gl-at {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.7rem; color: #34d399;
        min-width: 0; max-width: 100%;
    }
    .gl-at i { flex-shrink: 0; }
    .gl-mail { color: inherit; text-decoration: none; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .gl-mail:hover { color: var(--accent-light); }

    /* tags */
    .gl-tags { display: flex; flex-wrap: wrap; gap: 0.4rem; }
    .gl-tag {
        display: inline-flex; align-items: center;
        font-size: 0.66rem; font-weight: 600;
        color: var(--accent-light);
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.26rem 0.62rem; border-radius: 50px;
        transition: all 0.3s ease;
    }
    .gl-tag:hover {
        background: var(--accent-gradient); color: #fff; border-color: transparent;
        transform: translateY(-2px);
    }

    /* bio */
    .gl-bio { padding-left: 0.9rem; border-left: 2px solid rgba(59, 130, 246, 0.35); }
    .gl-bio p {
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.9rem; line-height: 1.8; color: var(--text-secondary);
        margin: 0 0 0.5rem;
    }
    .gl-bio p:last-child { margin-bottom: 0; }
    .gl-bio .gl-desc-short { display: none; }

    /* metrics */
    .gl-metrics { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.6rem; }
    .gl-metric {
        display: grid; justify-items: center; row-gap: 0.4rem;
        padding: 0.8rem 0.5rem 0.7rem;
        text-align: center;
        background: rgba(59, 130, 246, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .gl-metric:hover { transform: translateY(-3px); border-color: var(--border-hover); box-shadow: var(--shadow-sm); }
    .gl-metric .metric-ico {
        width: 30px; height: 30px; border-radius: 9px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.85rem; color: var(--accent-light);
        background: rgba(59, 130, 246, 0.1);
    }
    .gl-metric .number {
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 1.28rem; font-weight: 800; line-height: 1;
        color: #60a5fa;
    }
    .gl-metric .metric-key {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase;
        color: var(--text-muted);
    }
    .gl-metric .metric-bar {
        width: 100%; height: 4px; border-radius: 50px;
        background: rgba(59, 130, 246, 0.12); overflow: hidden;
    }
    .gl-metric .metric-fill {
        display: block; height: 100%; width: 0;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #22d3ee);
        background-size: 200% 100%;
        animation: glGrad 3s ease infinite;
        border-radius: 50px;
        transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.4s;
    }
    .gl-wb.gl-ready .metric-fill { width: var(--w); }

    /* resume button */
    .gl-cv {
        position: relative; overflow: hidden;
        display: inline-flex; align-items: center; gap: 0.55rem;
        align-self: flex-start;
        font-size: 0.8rem; font-weight: 700; color: #d1fae5;
        background: linear-gradient(135deg, #065f46, #047857, #059669);
        border: 1px solid rgba(52, 211, 153, 0.4);
        border-radius: 12px; padding: 0.72rem 1rem;
        text-decoration: none !important;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.24);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    }
    .gl-cv::before {
        content: '';
        position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.18), transparent);
        transition: left 0.6s ease;
    }
    .gl-cv:hover::before { left: 100%; }
    .gl-cv:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 14px 38px rgba(16, 185, 129, 0.38); color: #fff; }
    .gl-cv-prompt { color: #6ee7b7; }
    .gl-cv-badge {
        margin-left: auto;
        font-size: 0.58rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;
        background: rgba(255, 255, 255, 0.18);
        border-radius: 6px; padding: 0.2rem 0.5rem;
    }

    /* socials */
    .gl-socials { display: flex; flex-direction: column; gap: 0.45rem; }
    .gl-socials-label {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.64rem; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase;
        color: var(--text-muted);
    }
    .gl-socials-label i { color: var(--accent-light); }
    .gl-socials-row { display: flex; flex-wrap: wrap; gap: 0.45rem; }
    .gl-social-link {
        width: 38px; height: 38px; border-radius: 11px;
        background: rgba(59, 130, 246, 0.06);
        border: 1px solid rgba(59, 130, 246, 0.14);
        display: inline-flex; align-items: center; justify-content: center;
        color: var(--text-muted); font-size: 1rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .gl-social-link:hover {
        background: var(--accent-gradient); border-color: transparent;
        color: #fff; transform: translateY(-4px) scale(1.08);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    }

    /* hire */
    .gl-hire { display: flex; flex-direction: column; gap: 0.5rem; }
    .gl-hire-head { display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; flex-wrap: wrap; }
    .gl-hire-label {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.82rem; font-weight: 700; color: var(--text-primary);
    }
    .gl-hire-label i { color: var(--accent); }
    .gl-hire-tag {
        font-size: 0.62rem; color: #1DBF73; font-weight: 600; letter-spacing: 0.3px;
        background: rgba(29, 191, 115, 0.1);
        border: 1px solid rgba(29, 191, 115, 0.22);
        padding: 0.24rem 0.65rem; border-radius: 20px;
        white-space: nowrap;
        animation: abPulse 2s ease-in-out infinite;
    }
    .gl-hire-row { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .gl-freelance {
        flex: 1 1 120px;
        display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;
        padding: 0.55rem 0.6rem; border-radius: 11px;
        font-size: 0.74rem; font-weight: 600; color: var(--text-primary);
        background: rgba(59, 130, 246, 0.05);
        border: 1.5px solid var(--border-color);
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .gl-freelance:hover { transform: translateY(-3px); border-color: transparent; box-shadow: var(--shadow-sm); color: #fff; }
    .gl-freelance.fiverr { color: #1DBF73; border-color: rgba(29, 191, 115, 0.25); }
    .gl-freelance.fiverr:hover { background: linear-gradient(135deg, #1DBF73, #17a864); color: #fff; }
    .gl-freelance.upwork { color: #6FDA44; border-color: rgba(106, 218, 68, 0.25); }
    .gl-freelance.upwork:hover { background: linear-gradient(135deg, #6FDA44, #5ac43a); color: #fff; }
    .gl-freelance.freelancer { color: #29B2FE; border-color: rgba(41, 178, 254, 0.25); }
    .gl-freelance.freelancer:hover { background: linear-gradient(135deg, #29B2FE, #1a9ee8); color: #fff; }

    /* footer bar */
    .gl-foot {
        display: flex; align-items: center; gap: 1rem;
        padding: 0.5rem 0.95rem;
        font-size: 0.63rem; color: #64748b;
        background: rgba(2, 8, 23, 0.42);
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        white-space: nowrap; overflow-x: auto;
        scrollbar-width: none;
    }
    .gl-foot::-webkit-scrollbar { display: none; }
    html.light-theme .gl-foot { background: rgba(15, 23, 42, 0.05); color: #94a3b8; }
    .gl-foot span { display: inline-flex; align-items: center; gap: 0.35rem; flex-shrink: 0; }
    .gl-foot-ok { color: #34d399; }
    .gl-foot-right { margin-left: auto; }

    /* ===== About responsive ===== */
    @media (max-width: 900px) {
        .ab-chip { display: none; }
    }
    @media (max-width: 768px) {
        .gl-bar { gap: 0.45rem; }
        .gl-repo { max-width: 11ch; }
        .gl-cmd { font-size: 0.72rem; }
        .gl-body { padding: 1.1rem 1rem 1.25rem; }
        .gl-commits { gap: 1rem; }
        .gl-commit { padding-left: 1.85rem; }
        .gl-commits::before { left: 0.5rem; }
        .gl-node { left: 0.1rem; top: 0.95rem; width: 0.78rem; height: 0.78rem; }
        .gl-diff { padding: 0.75rem 0.8rem 0.85rem; gap: 0.65rem; }
        .gl-role { font-size: 0.76rem; }
        .gl-bio .gl-desc { display: none; }
        .gl-bio .gl-desc-short { display: block; }
    }
    @media (max-width: 480px) {
        .gl-avail { display: none; }
        .gl-name { font-size: 1.1rem; }
        .gl-user { gap: 0.8rem; }
        .gl-avatar { width: 62px; height: 62px; }
        .gl-initial { font-size: 1.55rem; }
        .gl-metrics { gap: 0.45rem; }
        .gl-metric { padding: 0.6rem 0.3rem 0.55rem; }
        .gl-metric .number { font-size: 1.05rem; }
        .gl-metric .metric-key { font-size: 0.5rem; letter-spacing: 0.2px; }
        .gl-metric .metric-ico { width: 24px; height: 24px; font-size: 0.72rem; }
        .gl-msg { flex-basis: 100%; }
        .gl-stat { margin-left: 0; }
        .gl-hire-row { flex-wrap: nowrap; }
        .gl-freelance { flex: 1 1 0; font-size: 0.6rem; padding: 0.5rem 0.2rem; gap: 0.25rem; }
    }

    /* ===== Reduced motion - never hide the git log ===== */
    @media (prefers-reduced-motion: reduce) {
        .gl-wb.gl-armed .gl-commit,
        .gl-wb.gl-armed .gl-diff > *,
        .gl-wb.gl-armed .gl-node { opacity: 1; transform: none; }
        .gl-wb.gl-armed .gl-commits::before { transform: scaleY(1); }
        .gl-wb::before,
        .ab-chip,
        .gl-avatar,
        .gl-node::before,
        .gl-hire-tag { animation: none; }
        .gl-metric .metric-fill { width: var(--w); }
    }

    /* ===== SERVICES � PURE WATER WAVE EFFECT (no boxes, no grid) ===== */
    .services-section {
        background: linear-gradient(180deg, var(--bg-primary) 0%, #0a1628 50%, var(--bg-primary) 100%);
        position: relative;
        overflow: hidden;
    }
    html.light-theme .services-section {
        background: linear-gradient(180deg, #f1f5f9 0%, #eef3fb 50%, #f8fafc 100%);
    }

    /* Subtle code-grid overlay */
    .services-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* Code-style section divider (About -> Services transition) */
    .code-divider {
        display: flex; align-items: center; gap: 0.9rem;
        max-width: 760px; margin: 0 auto 2.6rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
    }
    .code-divider .cd-line { flex: 1; height: 1px; position: relative; }
    .code-divider .cd-line::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.35));
    }
    .code-divider .cd-line:last-child::before {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.35), transparent);
    }
    .code-divider .cd-tag {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.78rem; color: var(--accent-light);
        background: rgba(59, 130, 246, 0.07);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.4rem 0.95rem; border-radius: 8px;
        white-space: nowrap;
    }
    .code-divider .cd-tag i { font-size: 0.85rem; }
    .code-divider .cd-arrow { color: var(--text-muted); }
    .code-divider .cd-cursor {
        width: 7px; height: 14px;
        background: var(--accent-light);
        border-radius: 1px;
        animation: cdBlink 1s step-end infinite;
    }
    html.light-theme .code-divider .cd-tag { background: rgba(59, 130, 246, 0.06); }
    @keyframes cdBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
    @media (max-width: 768px) {
        .code-divider { gap: 0.5rem; margin: 0 auto 2rem; }
        .code-divider .cd-tag { font-size: 0.66rem; padding: 0.32rem 0.6rem; gap: 0.35rem; }
        .code-divider .cd-cursor { width: 6px; height: 12px; }
    }

        /* ===== SERVICES - API ENDPOINT CARDS ===== */
    .svc-grid {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        justify-content: center;
        gap: 1.5rem;
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    .svc-card {
        position: relative;
        flex: 0 0 calc((100% - 1.5rem) / 2);
        max-width: calc((100% - 1.5rem) / 2);
        min-width: 300px;
        display: flex;
        flex-direction: column;
        background: rgba(13, 23, 43, 0.6);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 14px;
        overflow: hidden;
        transition: var(--transition);
    }
    html.light-theme .svc-card {
        background: rgba(255, 255, 255, 0.88);
        border-color: rgba(139, 92, 246, 0.22);
    }
    /* cursor-follow shine */
    .svc-card::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(139, 92, 246, 0.4) 0%, rgba(139, 92, 246, 0.15) 28%, transparent 55%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease;
        z-index: 1; border-radius: inherit;
    }
    .svc-card:hover::after { opacity: 1; }
    /* accent rail that fills on hover */
    .svc-card::before {
        content: ''; position: absolute;
        top: 0; left: 0; width: 3px; height: 0;
        background: linear-gradient(180deg, #a78bfa, #22d3ee);
        border-radius: 0 0 3px 0;
        transition: height 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 3;
    }
    .svc-card:hover::before { height: 100%; }
    .svc-card:hover {
        border-color: rgba(139, 92, 246, 0.5);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    /* ---- request title bar ---- */
    .svc-card-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.85rem;
        background: rgba(139, 92, 246, 0.06);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        position: relative; z-index: 2;
    }
    html.light-theme .svc-card-bar {
        background: rgba(139, 92, 246, 0.045);
        border-bottom-color: rgba(15, 23, 42, 0.08);
    }
    .svc-card-bar .ab-dot { width: 10px; height: 10px; }
    .svc-filename {
        font-size: 0.72rem; color: var(--text-muted);
        margin-left: 0.3rem;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .svc-method {
        margin-left: auto; flex-shrink: 0;
        font-size: 0.58rem; font-weight: 800; letter-spacing: 0.8px;
        color: #c4b5fd;
        background: rgba(139, 92, 246, 0.14);
        border: 1px solid rgba(139, 92, 246, 0.35);
        padding: 0.14rem 0.5rem; border-radius: 5px;
        transition: var(--transition);
    }
    html.light-theme .svc-method { color: #6d28d9; background: rgba(139, 92, 246, 0.1); }
    .svc-card:hover .svc-method {
        color: #fff;
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        border-color: transparent;
        box-shadow: 0 0 18px rgba(139, 92, 246, 0.45);
    }

    /* ---- body ---- */
    .svc-card-body {
        position: relative; z-index: 2;
        flex: 1 1 auto;
        display: flex; flex-direction: column; gap: 0.9rem;
        padding: 1.05rem 1.15rem 1.1rem;
        overflow: hidden;
    }
    /* request sweep travelling across the card */
    .svc-sweep {
        position: absolute; top: 0; bottom: 0; left: -30%;
        width: 30%; pointer-events: none; z-index: 1;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.14), transparent);
        animation: svcSweep 6s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    }
    html.light-theme .svc-sweep {
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
    }
    @keyframes svcSweep {
        0%   { left: -30%; opacity: 0; }
        12%  { opacity: 1; }
        60%  { left: 100%; opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }

    /* route line */
    .svc-route {
        position: relative; z-index: 2;
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.7rem;
        background: rgba(2, 6, 18, 0.4);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 9px;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.72rem;
        white-space: nowrap; overflow: hidden;
    }
    html.light-theme .svc-route { background: rgba(15, 23, 42, 0.04); }
    .svc-method-chip {
        flex-shrink: 0;
        font-size: 0.58rem; font-weight: 800; letter-spacing: 0.8px;
        color: #0b1220;
        background: linear-gradient(135deg, #c4b5fd, #a78bfa);
        padding: 0.12rem 0.42rem; border-radius: 4px;
    }
    .svc-path { flex: 0 1 auto; min-width: 0; color: #c4b5fd; overflow: hidden; text-overflow: ellipsis; }
    html.light-theme .svc-path { color: #6d28d9; }
    .svc-cursor {
        display: inline-block; flex-shrink: 0;
        width: 7px; height: 0.95em;
        background: #a78bfa; border-radius: 1px;
        box-shadow: 0 0 10px rgba(167, 139, 250, 0.7);
        animation: svcBlink 1s step-end infinite;
    }
    @keyframes svcBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

    /* icon + copy */
    .svc-main {
        position: relative; z-index: 2;
        display: flex; align-items: flex-start; gap: 0.9rem;
    }
    .svc-card-icon {
        flex-shrink: 0;
        width: 52px; height: 52px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        color: var(--accent-light);
        background: rgba(139, 92, 246, 0.09);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 14px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    html.light-theme .svc-card-icon {
        background: rgba(139, 92, 246, 0.07);
        color: #6d28d9;
    }
    .svc-card:hover .svc-card-icon {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        border-color: transparent;
        color: #fff;
        transform: translateY(-3px) rotate(-5deg) scale(1.06);
        box-shadow: 0 10px 26px rgba(139, 92, 246, 0.38);
    }
    .svc-copy { min-width: 0; }
    .svc-card-title {
        font-size: 1.05rem; font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.3rem; line-height: 1.4;
    }
    html.light-theme .svc-card-title { color: #0f172a; }
    .svc-card-desc {
        font-size: 0.86rem; color: var(--text-secondary);
        line-height: 1.6; margin: 0;
    }
    html.light-theme .svc-card-desc { color: #475569; }

    /* ---- response status bar ---- */
    .svc-card-foot {
        display: flex; justify-content: space-between; align-items: center; gap: 0.6rem;
        margin-top: auto;
        padding: 0.55rem 0.9rem;
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        background: rgba(255, 255, 255, 0.02);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.66rem; color: var(--text-muted);
        position: relative; z-index: 2;
    }
    html.light-theme .svc-card-foot { background: rgba(15, 23, 42, 0.03); border-top-color: rgba(15, 23, 42, 0.08); }
    .svc-resp { display: inline-flex; align-items: center; gap: 0.45rem; min-width: 0; overflow: hidden; }
    .svc-resp-code { flex-shrink: 0; font-weight: 800; letter-spacing: 0.3px; color: #34d399; }
    .svc-resp-meta { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; opacity: 0.75; }
    .svc-foot-status { flex-shrink: 0; }
    .sv-status-ok { display: inline-flex; align-items: center; gap: 0.4rem; color: #34d399; }
    .sv-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 8px rgba(52, 211, 153, 0.6);
    }
    .svc-card:hover .sv-dot { animation: svcPulse 1.2s ease infinite; }
    @keyframes svcPulse {
        0%, 100% { box-shadow: 0 0 8px rgba(52, 211, 153, 0.6); }
        50% { box-shadow: 0 0 16px rgba(52, 211, 153, 1); }
    }

    /* ---- sequenced reveal ---- */
    .svc-route, .svc-main, .svc-card-foot { opacity: 0; }
    .svc-card.visible .svc-route { animation: svcIn 0.45s ease forwards; }
    .svc-card.visible .svc-main { animation: svcIn 0.45s ease forwards; animation-delay: 0.12s; }
    .svc-card.visible .svc-card-foot { animation: svcIn 0.45s ease forwards; animation-delay: 0.24s; }
    .svc-card.visible .svc-resp-code { animation: svcPop 0.35s 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) backwards; }
    @keyframes svcIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes svcPop { from { opacity: 0; transform: scale(0.7); } to { opacity: 1; transform: scale(1); } }

    @media (prefers-reduced-motion: reduce) {
        .svc-sweep, .svc-cursor, .sv-dot { animation: none; }
        .svc-route, .svc-main, .svc-card-foot { opacity: 1; transform: none; animation: none; }
    }

    @media (max-width: 860px) {
        .svc-grid { max-width: 560px; }
        .svc-card { flex: 0 0 100%; max-width: 100%; min-width: 0; }
    }
    @media (max-width: 480px) {
        .svc-card-body { padding: 0.9rem 0.85rem 0.95rem; gap: 0.7rem; }
        .svc-card-icon { width: 44px; height: 44px; font-size: 1.25rem; border-radius: 12px; }
        .svc-card-title { font-size: 0.95rem; }
        .svc-card-desc { font-size: 0.8rem; }
        .svc-route { font-size: 0.66rem; }
        .svc-card-foot { padding: 0.5rem 0.7rem; }
    }
/* ===== Glass Card Shine Effect ===== */
    .project-card::after,
    .pkg-card::after,
    .testimonial-card::after,
    .faq-item::after,
    .contact-info-card::after,
    .contact-item::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59,130,246,0.45) 0%, rgba(59,130,246,0.18) 30%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease; z-index: 1; border-radius: inherit;
    }
    html.light-theme .project-card::after,
    html.light-theme .pkg-card::after,
    html.light-theme .testimonial-card::after,
    html.light-theme .faq-item::after,
    html.light-theme .contact-info-card::after,
    html.light-theme .contact-item::after {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59,130,246,0.35) 0%, rgba(59,130,246,0.12) 30%, transparent 60%);
    }
    .project-card:hover::after,
    .pkg-card:hover::after,
    .testimonial-card:hover::after,
    .faq-item:hover::after,
    .contact-info-card:hover::after,
    .contact-item:hover::after { opacity: 1; }
    /* Ensure content stays above shine */
    .project-card .pj-artifact,
    .pkg-card .pkg-card-bar,
    .pkg-card .term-body,
    .pkg-card .pkg-action,
    .pkg-card .pkg-foot,
    .project-card .card-body,
    .testimonial-card .testimonial-stars,
    .testimonial-card .testimonial-text,
    .testimonial-card .testimonial-author,
    .testimonial-card .tst-bar,
    .testimonial-card .tst-head,
    .testimonial-card .tst-review,
    .testimonial-card .tst-foot,
    .faq-item button,
    .faq-item .faq-answer,
    .contact-info-card h3,
    .contact-info-card p,
    .contact-info-card .contact-item,
    .contact-item .icon-box,
    .contact-item .info { position: relative; z-index: 2; }


/* ===== CODING SHOWCASE SECTION ===== */
    .coding-showcase-section {
        background: linear-gradient(180deg, var(--bg-primary) 0%, #0a1628 50%, var(--bg-primary) 100%);
        position: relative; overflow: hidden;
    }
    html.light-theme .coding-showcase-section {
        background: linear-gradient(180deg, #f1f5f9 0%, #eef3fb 50%, #f8fafc 100%);
    }
    .coding-showcase-section::before {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .coding-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.75rem;
        max-width: 1200px;
        margin: 0 auto;
        position: relative; z-index: 1;
    }

    .coding-card {
        position: relative;
        background: rgba(13, 23, 43, 0.58);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 16px;
        overflow: hidden;
        transition: var(--transition);
        display: flex; flex-direction: column;
    }
    html.light-theme .coding-card {
        background: rgba(255, 255, 255, 0.85);
        border-color: rgba(59, 130, 246, 0.18);
    }
    .coding-card::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59, 130, 246, 0.4) 0%, rgba(59, 130, 246, 0.15) 28%, transparent 55%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease;
        z-index: 1; border-radius: inherit;
    }
    .coding-card:hover::after { opacity: 1; }
    .coding-card::before {
        content: ''; position: absolute;
        top: 0; left: 0; width: 3px; height: 0;
        background: var(--accent-gradient);
        border-radius: 0 0 3px 0;
        transition: height 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 2;
    }
    .coding-card:hover::before { height: 100%; }
    .coding-card:hover {
        border-color: var(--border-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }
    .coding-card > * { position: relative; z-index: 2; }

    .coding-header {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.85rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
    }
    html.light-theme .coding-header {
        background: rgba(15, 23, 42, 0.035);
        border-bottom-color: rgba(15, 23, 42, 0.08);
    }
    .coding-dots { display: flex; gap: 0.35rem; }
    .dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .dot.red { background: #ff5f57; }
    .dot.yellow { background: #febc2e; }
    .dot.green { background: #28c840; }
    .coding-title {
        font-size: 0.72rem; color: var(--text-muted);
        margin-left: 0.3rem;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .coding-tabs { display: flex; gap: 0.2rem; margin-left: auto; }
    .tab {
        font-size: 0.65rem; color: #64748b;
        padding: 0.2rem 0.55rem; border-radius: 6px;
        background: transparent; border: 1px solid transparent;
        cursor: default; white-space: nowrap;
        transition: all 0.3s ease;
    }
    .tab.active {
        color: var(--accent-light);
        background: rgba(59, 130, 246, 0.12);
        border-color: rgba(59, 130, 246, 0.25);
    }
    .coding-actions { display: flex; gap: 0.3rem; margin-left: auto; }
    .coding-btn {
        width: 28px; height: 28px; border-radius: 8px;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: var(--accent-light); cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem; transition: all 0.3s ease;
    }
    .coding-btn:hover {
        background: var(--accent-gradient); border-color: transparent; color: #fff;
    }
    .branch-badge {
        font-size: 0.6rem; font-weight: 700; text-transform: uppercase;
        background: var(--accent-gradient); color: #fff;
        padding: 0.15rem 0.5rem; border-radius: 4px;
        margin-left: auto;
    }

    /* ===== CASE STUDY CARDS (coding-styled) ===== */
    .cs-grid { align-items: stretch; }

    .casestudy-card {
        text-decoration: none;
        color: inherit;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        background: rgba(13, 23, 43, 0.62);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        backdrop-filter: blur(18px) saturate(160%);
    }
    html.light-theme .casestudy-card { background: rgba(255, 255, 255, 0.88); }

    .cs-body {
        position: relative; flex: 1;
        display: flex; flex-direction: column; gap: 0.7rem;
        padding: 1.1rem 1.15rem 1.25rem;
        overflow: hidden;
    }

    /* Compile scan beam sweeping each card body */
    .cs-scan {
        position: absolute; left: 0; right: 0; top: -45%;
        height: 45%; pointer-events: none; z-index: 1;
        background: linear-gradient(180deg, transparent, rgba(59, 130, 246, 0.12) 45%, rgba(96, 165, 250, 0.2) 50%, rgba(59, 130, 246, 0.12) 55%, transparent);
        animation: csScan 4.5s cubic-bezier(0.6, 0, 0.4, 1) infinite;
    }
    html.light-theme .cs-scan {
        background: linear-gradient(180deg, transparent, rgba(59, 130, 246, 0.08) 45%, rgba(59, 130, 246, 0.14) 50%, rgba(59, 130, 246, 0.08) 55%, transparent);
    }
    @keyframes csScan {
        0%   { top: -45%; opacity: 0; }
        15%  { opacity: 1; }
        70%  { top: 105%; opacity: 1; }
        100% { top: 105%; opacity: 0; }
    }

    .cs-cmd-line {
        position: relative; z-index: 2;
        display: flex; align-items: center; gap: 0.45rem;
        font-size: 0.72rem; color: #94a3b8; min-height: 1.1rem;
    }
    html.light-theme .cs-cmd-line { color: #64748b; }
    .cs-prompt { color: #34d399; font-weight: 700; }
    .cs-cmd { color: #7dd3fc; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    html.light-theme .cs-cmd { color: #0369a1; }
    .cs-caret {
        display: inline-block; width: 7px; height: 0.95em; margin-left: 1px;
        background: #34d399; vertical-align: text-bottom; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: csCaret 1s step-end infinite;
    }
    @keyframes csCaret { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }

    .cs-thumb {
        position: relative; z-index: 2;
        border-radius: 10px; overflow: hidden;
        border: 1px solid rgba(59, 130, 246, 0.2);
        aspect-ratio: 16 / 9; background: rgba(2, 6, 18, 0.4);
    }
    .cs-thumb img {
        width: 100%; height: 100%; object-fit: cover; display: block;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .casestudy-card:hover .cs-thumb img { transform: scale(1.06); }

    .cs-title {
        position: relative; z-index: 2; margin: 0;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 1.05rem; font-weight: 700; line-height: 1.35;
        color: var(--text-primary);
    }
    .cs-client {
        position: relative; z-index: 2;
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; color: var(--accent-light);
    }
    .cs-client i { color: var(--accent); }

    .cs-lines { position: relative; z-index: 2; display: flex; flex-direction: column; gap: 0.5rem; }
    .cs-line { border-left: 2px solid rgba(59, 130, 246, 0.3); padding-left: 0.7rem; }
    .cs-line-ok { border-left-color: rgba(52, 211, 153, 0.55); }
    .cs-line p {
        margin: 0;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.78rem; line-height: 1.6; color: var(--text-secondary);
    }
    .cs-key {
        display: block; margin-bottom: 0.1rem;
        font-size: 0.64rem; font-weight: 700; letter-spacing: 0.3px;
        color: #5b6b84;
    }
    html.light-theme .cs-key { color: #94a3b8; }
    .cs-line-ok .cs-key { color: #10b981; }

    .cs-tech {
        position: relative; z-index: 2;
        display: flex; flex-wrap: wrap; gap: 0.35rem;
        margin-top: auto; padding-top: 0.2rem;
    }
    .cs-tag {
        font-size: 0.62rem; font-weight: 600; color: var(--accent-light);
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.2rem 0.55rem; border-radius: 6px;
        transition: all 0.3s ease;
    }
    .casestudy-card:hover .cs-tag { background: var(--accent-gradient); color: #fff; border-color: transparent; }

    .cs-foot {
        display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;
        padding: 0.6rem 1.15rem;
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        background: rgba(2, 6, 18, 0.28);
        font-size: 0.68rem; color: var(--text-muted);
    }
    html.light-theme .cs-foot { background: rgba(15, 23, 42, 0.03); border-top-color: rgba(15, 23, 42, 0.08); }
    .cs-status { display: inline-flex; align-items: center; gap: 0.4rem; color: #34d399; }
    .cs-open {
        display: inline-flex; align-items: center; gap: 0.35rem;
        color: var(--accent-light); font-weight: 600;
    }
    .cs-open i { transition: transform 0.3s ease; }
    .casestudy-card:hover .cs-open { color: #fff; }
    .casestudy-card:hover .cs-open i { transform: translateX(4px); }

    /* Compile-in reveal of card content (JS adds .cs-compiled) */
    .cs-body .cs-cmd-line,
    .cs-body .cs-thumb,
    .cs-body .cs-title,
    .cs-body .cs-client,
    .cs-body .cs-line,
    .cs-body .cs-tech {
        opacity: 0; transform: translateY(10px);
        transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .casestudy-card.cs-compiled .cs-body .cs-cmd-line,
    .casestudy-card.cs-compiled .cs-body .cs-thumb,
    .casestudy-card.cs-compiled .cs-body .cs-title,
    .casestudy-card.cs-compiled .cs-body .cs-client,
    .casestudy-card.cs-compiled .cs-body .cs-line,
    .casestudy-card.cs-compiled .cs-body .cs-tech {
        opacity: 1; transform: translateY(0);
    }
    .casestudy-card.cs-compiled .cs-body .cs-cmd-line { transition-delay: 0.05s; }
    .casestudy-card.cs-compiled .cs-body .cs-thumb { transition-delay: 0.15s; }
    .casestudy-card.cs-compiled .cs-body .cs-title { transition-delay: 0.25s; }
    .casestudy-card.cs-compiled .cs-body .cs-client { transition-delay: 0.33s; }
    .casestudy-card.cs-compiled .cs-body .cs-lines .cs-line:nth-child(1) { transition-delay: 0.41s; }
    .casestudy-card.cs-compiled .cs-body .cs-lines .cs-line:nth-child(2) { transition-delay: 0.49s; }
    .casestudy-card.cs-compiled .cs-body .cs-lines .cs-line:nth-child(3) { transition-delay: 0.57s; }
    .casestudy-card.cs-compiled .cs-body .cs-tech { transition-delay: 0.65s; }

    @media (prefers-reduced-motion: reduce) {
        .cs-scan, .cs-caret { animation: none; }
        .cs-body .cs-cmd-line, .cs-body .cs-thumb, .cs-body .cs-title,
        .cs-body .cs-client, .cs-body .cs-line, .cs-body .cs-tech {
            opacity: 1 !important; transform: none !important;
        }
    }

    /* ==== CASE STUDIES HEADER + CTA (test-suite terminal) ==== */
    .csh {
        position: relative;
        max-width: 880px;
        margin: 0 auto 2.75rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.6) 0%, rgba(8, 15, 32, 0.45) 100%);
        -webkit-backdrop-filter: blur(16px) saturate(160%);
        backdrop-filter: blur(16px) saturate(160%);
        border: 1px solid rgba(147, 197, 253, 0.22);
        border-radius: 18px;
        overflow: hidden;
        box-shadow:
            0 30px 90px rgba(2, 8, 23, 0.6),
            0 0 0 1px rgba(255, 255, 255, 0.05) inset,
            0 0 60px rgba(59, 130, 246, 0.08);
        transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.4s ease;
    }
    html.light-theme .csh {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.78) 0%, rgba(232, 240, 252, 0.62) 100%);
        border-color: rgba(59, 130, 246, 0.26);
        box-shadow: 0 30px 70px rgba(59, 130, 246, 0.18), 0 0 0 1px rgba(255, 255, 255, 0.7) inset;
    }
    .csh:hover {
        border-color: var(--border-hover);
        transform: translateY(-4px);
    }
    .csh::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #3b82f6, #8b5cf6, #22d3ee, transparent);
        background-size: 200% 100%;
        animation: atSweep 6s linear infinite;
    }
    .csh-cta { margin: 3.25rem auto 0; }

    .csh-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }
    html.light-theme .csh-bar { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .csh-file {
        display: inline-flex; align-items: center; gap: 0.4rem;
        margin-left: 0.35rem; font-size: 0.73rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .csh-file i { color: #38bdf8; }
    html.light-theme .csh-file { color: #334155; }
    .csh-tag {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase;
        color: #c4b5fd; background: rgba(139, 92, 246, 0.14);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 0.18rem 0.5rem; border-radius: 50px;
        white-space: nowrap;
    }
    .csh-right {
        margin-left: auto; flex-shrink: 0;
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.64rem; color: #34d399;
        background: rgba(52, 211, 153, 0.08);
        border: 1px solid rgba(52, 211, 153, 0.26);
        padding: 0.22rem 0.65rem; border-radius: 50px;
        white-space: nowrap;
    }

    .csh-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 2.4rem;
        padding: 0.5rem 0.95rem;
        font-size: 0.78rem;
        background: rgba(2, 8, 23, 0.45);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        overflow: hidden;
    }
    html.light-theme .csh-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .csh-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .csh-cmd-text {
        color: #e2e8f0;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    html.light-theme .csh-cmd-text { color: #1e293b; }
    .csh-caret {
        display: inline-block; width: 8px; height: 1em; flex-shrink: 0;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: glBlink 1s step-end infinite;
    }

    .csh-body { padding: 1.5rem 1.5rem 1.6rem; }

    .csh-suite { display: flex; align-items: center; flex-wrap: wrap; gap: 0.7rem; }
    .csh-pass {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.64rem; font-weight: 800; letter-spacing: 0.8px;
        color: #052e16;
        background: linear-gradient(135deg, #4ade80, #22c55e);
        padding: 0.24rem 0.6rem; border-radius: 6px;
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.35);
    }
    .csh-title {
        margin: 0;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 2rem; font-weight: 800; line-height: 1.2;
        color: var(--text-primary);
    }
    .csh-time { margin-left: auto; font-size: 0.66rem; color: #64748b; flex-shrink: 0; }

    .csh-tests { list-style: none; margin: 0.9rem 0 0; padding: 0; }
    .csh-test {
        display: flex; align-items: flex-start; gap: 0.6rem;
        font-size: 0.86rem; line-height: 1.7; color: var(--text-secondary);
    }
    .csh-check {
        flex-shrink: 0; margin-top: 0.22rem;
        width: 18px; height: 18px; border-radius: 5px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.6rem; color: #052e16;
        background: rgba(74, 222, 128, 0.92);
        box-shadow: 0 0 0 1px rgba(74, 222, 128, 0.4), 0 0 14px rgba(74, 222, 128, 0.3);
    }
    .csh-check i { line-height: 1; }

    .csh-summary {
        display: flex; align-items: center; gap: 1.1rem; flex-wrap: wrap;
        font-size: 0.66rem; color: #64748b;
        margin-top: 1.2rem; padding-top: 1rem;
        border-top: 1px dashed rgba(148, 163, 184, 0.2);
    }
    .csh-summary b { color: #4ade80; }
    .csh-summary i { color: var(--accent-light); }
    .csh-sum-right { margin-left: auto; }

    .csh-cta-text {
        margin: 0 0 1.35rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 1.02rem; line-height: 1.75; color: var(--text-secondary);
        max-width: 640px;
    }
    .csh-actions { display: flex; gap: 0.9rem; flex-wrap: wrap; }

    /* Staggered reveal (armed by JS, so content is never hidden without it) */
    .csh-anim { transition: opacity 0.55s cubic-bezier(0.16, 1, 0.3, 1), transform 0.55s cubic-bezier(0.16, 1, 0.3, 1); transition-delay: calc(var(--d, 0) * 90ms); }
    .csh-armed .csh-anim { opacity: 0; transform: translateY(12px); }
    .csh-ready .csh-anim { opacity: 1; transform: translateY(0); }
    .csh-pass { transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.4); transition-delay: 120ms; }
    .csh-armed .csh-pass { opacity: 0; transform: scale(0.7); }
    .csh-ready .csh-pass { opacity: 1; transform: scale(1); }
    .csh-check { transition: opacity 0.4s ease, transform 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.5); transition-delay: calc(var(--d, 0) * 90ms + 60ms); }
    .csh-armed .csh-check { opacity: 0; transform: scale(0.3); }
    .csh-ready .csh-check { opacity: 1; transform: scale(1); }
    .csh-ready .csh-pass { animation: cshGlow 3s ease-in-out 1.2s infinite; }
    @keyframes cshGlow {
        0%, 100% { box-shadow: 0 6px 20px rgba(34, 197, 94, 0.35); }
        50% { box-shadow: 0 6px 32px rgba(34, 197, 94, 0.65); }
    }

    @media (max-width: 768px) {
        .csh { margin-bottom: 2.25rem; }
        .csh-cta { margin-top: 2.5rem; }
        .csh-body { padding: 1.25rem 1.15rem 1.35rem; }
        .csh-title { font-size: 1.55rem; }
        .csh-cmd { font-size: 0.72rem; }
    }
    @media (max-width: 480px) {
        .csh-tag, .csh-time { display: none; }
        .csh-title { font-size: 1.35rem; }
        .csh-actions .btn-primary-custom,
        .csh-actions .btn-outline-custom { flex: 1 1 100%; justify-content: center; }
    }
    @media (prefers-reduced-motion: reduce) {
        .csh-armed .csh-anim,
        .csh-armed .csh-check,
        .csh-armed .csh-pass { opacity: 1; transform: none; }
        .csh::before,
        .csh-caret,
        .csh-ready .csh-pass { animation: none; }
    }

    @media (max-width: 1024px) {
        .coding-grid { grid-template-columns: 1fr; max-width: 500px; }
    }
    @media (max-width: 768px) {
        .coding-grid { gap: 1.25rem; }
        .cs-body { padding: 1rem 0.95rem 1.1rem; }
        .cs-title { font-size: 0.98rem; }
    }
    @media (max-width: 480px) {
        .coding-title { display: none; }
        .coding-header { padding: 0.45rem 0.7rem; }
        .cs-foot { padding: 0.55rem 0.95rem; font-size: 0.62rem; }
    }


        /* ===== EXPERIENCE — DEBUG PROFILER DESIGN ===== */
    .timeline-section {
        background: linear-gradient(180deg, var(--bg-primary) 0%, #0a1628 50%, var(--bg-primary) 100%);
        position: relative; overflow: hidden;
    }
    html.light-theme .timeline-section { background: linear-gradient(180deg, #f8fafc 0%, #eef3fb 50%, #f8fafc 100%); }
    .timeline-section::before {
        content: ""; position: absolute; inset: 0;
        background-image: linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }
    .timeline-section .container { position: relative; z-index: 1; }

    /* Profiler container */
    .profiler { max-width: 900px; margin: 0 auto; }
    .profiler-header {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.65rem 1rem; margin-bottom: 0;
        background: rgba(255,255,255,0.03); border: 1px solid rgba(148,163,184,0.12);
        border-radius: 12px 12px 0 0; border-bottom: none;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.68rem; color: #64748b;
    }
    .profiler-header i { color: #818cf8; }
    .profiler-header .prof-title { color: #93c5fd; font-weight: 600; margin-left: 0.3rem; }
    .profiler-header .prof-count {
        margin-left: auto; color: #34d399;
        background: rgba(52,211,153,0.08); border: 1px solid rgba(52,211,153,0.28);
        padding: 0.15rem 0.5rem; border-radius: 50px; white-space: nowrap;
    }
    html.light-theme .profiler-header { background: rgba(15,23,42,0.03); border-color: rgba(15,23,42,0.08); }

    /* Column headers */
    .prof-col-head {
        display: grid; grid-template-columns: 2.2rem 1fr auto;
        gap: 0.5rem; align-items: center;
        padding: 0.45rem 0.85rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.6rem; font-weight: 700; color: var(--text-muted);
        text-transform: uppercase; letter-spacing: 0.5px;
        border-bottom: 1px solid rgba(148,163,184,0.12);
    }
    .prof-col-head span:nth-child(2) { padding-left: 0.3rem; }

    /* Experience row */
    .prof-row {
        display: grid; grid-template-columns: 2.2rem 1fr auto;
        gap: 0.5rem; align-items: start;
        padding: 0; border-bottom: 1px solid rgba(148,163,184,0.06);
        transition: background 0.3s ease;
        position: relative; overflow: hidden;
    }
    .prof-row:last-child { border-bottom: none; }
    .prof-row:hover { background: rgba(59,130,246,0.03); }
    html.light-theme .prof-row:hover { background: rgba(59,130,246,0.04); }

    /* Line number */
    .prof-ln {
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem; color: #475569; text-align: right; padding-top: 1rem;
        user-select: none; padding-right: 0.2rem;
    }
    html.light-theme .prof-ln { color: #94a3b8; }

    /* Card content */
    .prof-card {
        padding: 0.95rem 1rem; margin: 0.35rem 0;
        background: linear-gradient(180deg, rgba(15,25,45,0.78) 0%, rgba(10,18,35,0.6) 100%);
        border: 1px solid rgba(129,140,248,0.18); border-radius: 12px;
        position: relative; overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
    }
    .prof-card::before {
        content: ""; position: absolute; top: 0; left: 0; bottom: 0; width: 3px;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        opacity: 0.5; transition: opacity 0.3s ease;
    }
    .prof-row:hover .prof-card {
        border-color: rgba(129,140,248,0.4);
        box-shadow: 0 8px 30px rgba(2,8,23,0.5), 0 0 40px rgba(59,130,246,0.06);
        transform: translateX(4px);
    }
    .prof-row:hover .prof-card::before { opacity: 1; }
    html.light-theme .prof-card {
        background: linear-gradient(180deg, rgba(255,255,255,0.88) 0%, rgba(238,242,255,0.72) 100%);
        border-color: rgba(99,102,241,0.2);
    }
    html.light-theme .prof-row:hover .prof-card { box-shadow: 0 8px 30px rgba(59,130,246,0.1); }

    /* Card header row */
    .prof-card-head {
        display: flex; align-items: center; flex-wrap: wrap; gap: 0.45rem;
        margin-bottom: 0.5rem;
    }
    .prof-role {
        font-family: var(--font); font-size: 1rem; font-weight: 700;
        color: var(--text-primary); line-height: 1.3;
    }
    .prof-status {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.55rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;
        padding: 0.15rem 0.5rem; border-radius: 50px;
    }
    .prof-status.running {
        color: #052e16; background: linear-gradient(135deg, #4ade80, #22c55e);
        box-shadow: 0 0 16px rgba(34,197,94,0.35);
        animation: abPulse 2.4s ease-in-out infinite;
    }
    .prof-status.done {
        color: #93c5fd; background: rgba(59,130,246,0.12);
        border: 1px solid rgba(59,130,246,0.28);
    }
    .prof-company-row {
        display: flex; align-items: center; flex-wrap: wrap; gap: 0.4rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.72rem; color: var(--text-secondary); margin-bottom: 0.6rem;
    }
    .prof-company-row i { color: var(--accent-light); font-size: 0.78rem; }
    .prof-sep { color: #475569; }
    .prof-location { color: var(--text-muted); }

    /* Timing bar */
    .prof-timing {
        display: flex; align-items: center; gap: 0.6rem;
        margin-bottom: 0.6rem;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem;
    }
    .prof-timing-label { color: #64748b; }
    .prof-timing-bar {
        flex: 1; height: 4px; border-radius: 50px;
        background: rgba(59,130,246,0.1); overflow: hidden;
    }
    .prof-timing-fill {
        height: 100%; border-radius: 50px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #22d3ee);
        background-size: 200% 100%;
        width: 0; transition: width 1.2s cubic-bezier(0.16,1,0.3,1) 0.3s;
    }
    .prof-row.visible .prof-timing-fill { width: var(--bar-w, 100%); }
    .prof-timing-val { color: #818cf8; font-weight: 700; white-space: nowrap; }

    /* Description */
    .prof-desc {
        padding: 0.7rem 0.85rem; margin-top: 0.15rem;
        background: rgba(2,8,23,0.3); border-left: 2px solid rgba(59,130,246,0.35);
        border-radius: 0 8px 8px 0;
        font-size: 0.78rem; line-height: 1.75; color: var(--text-secondary);
    }
    html.light-theme .prof-desc { background: rgba(15,23,42,0.04); }
    .prof-desc-gutter { color: #6366f1; font-weight: 700; margin-right: 0.4rem; }

    /* Duration badge on the right */
    .prof-duration {
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem; color: var(--accent-light);
        display: flex; align-items: center; gap: 0.3rem;
        white-space: nowrap; padding-top: 1rem;
    }
    .prof-duration i { font-size: 0.7rem; }

    /* Profiler footer */
    .prof-footer {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.85rem; margin-top: 0;
        background: rgba(255,255,255,0.02); border: 1px solid rgba(148,163,184,0.1);
        border-radius: 0 0 12px 12px; border-top: none;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.62rem; color: #64748b;
    }
    .prof-footer i { color: #34d399; }
    .prof-footer-right { margin-left: auto; color: #818cf8; }
    html.light-theme .prof-footer { background: rgba(15,23,42,0.02); border-color: rgba(15,23,42,0.08); }

    /* Responsive */
    @media (max-width: 768px) {
        .prof-col-head { display: none; }
        .prof-row { grid-template-columns: 1.6rem 1fr; }
        .prof-duration { display: none; }
        .prof-card { padding: 0.8rem; }
        .prof-role { font-size: 0.92rem; }
        .prof-card-head { gap: 0.35rem; }
        .prof-timing { font-size: 0.58rem; }
        .prof-desc { font-size: 0.74rem; padding: 0.6rem 0.75rem; }
    }
    @media (max-width: 480px) {
        .prof-row { grid-template-columns: 1fr; }
        .prof-ln { display: none; }
        .prof-card { padding: 0.7rem; }
        .prof-role { font-size: 0.85rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        .prof-timing-fill { transition: none; }
        .prof-row.visible .prof-timing-fill { width: var(--bar-w, 100%); }
    }

/* ===== SKILLS - LIVE PROCESS MONITOR (coding design) ===== */
    .skills-section { background: linear-gradient(180deg, #080d1a 0%, var(--bg-secondary) 100%); }
    html.light-theme .skills-section { background: linear-gradient(180deg, #f1f5f9 0%, #eef2f7 100%); }

    .sk-panel {
        position: relative;
        max-width: 880px;
        margin: 0 auto;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.6) 0%, rgba(8, 15, 32, 0.45) 100%);
        -webkit-backdrop-filter: blur(16px) saturate(160%);
        backdrop-filter: blur(16px) saturate(160%);
        border: 1px solid rgba(147, 197, 253, 0.22);
        border-radius: 18px;
        overflow: hidden;
        box-shadow:
            0 30px 90px rgba(2, 8, 23, 0.6),
            0 0 0 1px rgba(255, 255, 255, 0.05) inset,
            0 0 60px rgba(34, 211, 238, 0.07);
    }
    html.light-theme .sk-panel {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.78) 0%, rgba(232, 240, 252, 0.62) 100%);
        border-color: rgba(59, 130, 246, 0.26);
        box-shadow: 0 30px 70px rgba(59, 130, 246, 0.18), 0 0 0 1px rgba(255, 255, 255, 0.7) inset;
    }
    .sk-panel::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, transparent);
        background-size: 200% 100%;
        animation: atSweep 5s linear infinite;
    }

    .sk-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }
    html.light-theme .sk-bar { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .sk-file {
        display: inline-flex; align-items: center; gap: 0.4rem;
        margin-left: 0.35rem; font-size: 0.73rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .sk-file i { color: #22d3ee; }
    html.light-theme .sk-file { color: #334155; }
    .sk-badge {
        margin-left: auto;
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase;
        color: #93c5fd; background: rgba(59, 130, 246, 0.14);
        border: 1px solid rgba(59, 130, 246, 0.3);
        padding: 0.16rem 0.5rem; border-radius: 50px;
        white-space: nowrap;
    }
    .sk-live {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.4px;
        color: #34d399; white-space: nowrap;
    }
    .sk-live-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.9);
        animation: abPulse 1.4s ease-in-out infinite;
    }

    .sk-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 2.3rem;
        padding: 0.45rem 0.95rem;
        font-size: 0.76rem;
        background: rgba(2, 8, 23, 0.45);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        overflow: hidden;
    }
    html.light-theme .sk-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .sk-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .sk-cmd-text { color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    html.light-theme .sk-cmd-text { color: #1e293b; }
    .sk-caret {
        display: inline-block; width: 8px; height: 1em; flex-shrink: 0;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: glBlink 1s step-end infinite;
    }

    .sk-head, .sk-row {
        display: grid;
        grid-template-columns: 2.6rem minmax(0, 1fr) minmax(0, 1.1fr) 3.2rem 4.2rem;
        gap: 0.75rem;
        align-items: center;
    }
    .sk-head {
        padding: 0.4rem 0.95rem;
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.7px; text-transform: uppercase;
        color: #64748b;
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
    }
    .sk-rows { padding: 0.4rem 0.55rem 0.55rem; }
    .sk-row {
        padding: 0.3rem 0.4rem;
        border-radius: 7px;
        font-size: 0.7rem;
        color: #cbd5e1;
        transition: opacity 0.45s ease, transform 0.45s ease, background 0.25s ease, box-shadow 0.25s ease;
    }
    html.light-theme .sk-row { color: #334155; }
    .sk-row.is-active { background: rgba(34, 211, 238, 0.08); box-shadow: inset 2px 0 0 #22d3ee; }
    .sk-row.is-active .sk-pid,
    .sk-row.is-active .sk-state { color: #22d3ee; }
    .sk-pid { color: #64748b; font-size: 0.66rem; }
    .sk-name {
        display: inline-flex; align-items: center; gap: 0.45rem;
        min-width: 0; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
        font-weight: 600; color: var(--text-primary);
    }
    .sk-name i { font-size: 0.82rem; flex-shrink: 0; color: var(--accent-light); }
    .sk-pct { font-size: 0.68rem; font-weight: 700; color: var(--accent-light); }
    .sk-state {
        font-size: 0.6rem; letter-spacing: 0.3px; text-transform: uppercase;
        color: #64748b; text-align: right;
    }

    /* meter: marching stripes + a sweeping light keep it visibly alive */
    .sk-meter {
        position: relative;
        height: 9px; border-radius: 50px;
        background: rgba(99, 102, 241, 0.16);
        overflow: hidden;
    }
    .sk-meter-fill {
        display: block; height: 100%; width: var(--w, 0%);
        border-radius: 50px;
        background-image:
            repeating-linear-gradient(115deg, rgba(255, 255, 255, 0.22) 0 5px, transparent 5px 11px),
            linear-gradient(90deg, #3b82f6, #22d3ee);
        background-size: 22px 100%, 100% 100%;
        animation: skMarch 1.15s linear infinite;
        transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.25s;
    }
    @keyframes skMarch {
        from { background-position: 0 0, 0 0; }
        to { background-position: 22px 0, 0 0; }
    }
    .sk-meter-sweep {
        position: absolute; top: 0; bottom: 0; left: -30%; width: 30%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        animation: skSweep 2.8s ease-in-out infinite;
        animation-delay: calc(var(--i, 0) * 0.17s);
        pointer-events: none;
    }
    @keyframes skSweep {
        0% { left: -30%; opacity: 0; }
        15% { opacity: 1; }
        85% { opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }

    .sk-foot {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.95rem;
        font-size: 0.64rem; color: #64748b;
        background: rgba(2, 8, 23, 0.42);
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    html.light-theme .sk-foot { background: rgba(15, 23, 42, 0.05); color: #94a3b8; }
    .sk-foot i { color: var(--accent-light); }
    .sk-foot b { color: #22d3ee; }
    .sk-foot-right { margin-left: auto; }

    /* reveal (armed by JS, so nothing hides without it) */
    .sk-panel.sk-armed .sk-row { opacity: 0; transform: translateY(8px); }
    .sk-panel.sk-armed .sk-meter-fill { width: 0; }
    .sk-panel.sk-ready .sk-row {
        opacity: 1; transform: translateY(0);
        transition:
            opacity 0.45s ease calc(var(--i, 0) * 60ms + 0.1s),
            transform 0.45s ease calc(var(--i, 0) * 60ms + 0.1s),
            background 0.25s ease 0s,
            box-shadow 0.25s ease 0s;
    }
    .sk-panel.sk-ready .sk-meter-fill { width: var(--w, 0%); }

    @media (max-width: 720px) {
        .sk-head, .sk-row { grid-template-columns: 2.2rem minmax(0, 1fr) minmax(0, 0.9fr) 3rem; gap: 0.55rem; }
        .sk-state { display: none; }
        .sk-row { font-size: 0.66rem; }
        .sk-name i { font-size: 0.75rem; }
    }
    @media (max-width: 480px) {
        .sk-head, .sk-row { grid-template-columns: minmax(0, 1fr) minmax(0, 0.8fr) 2.7rem; gap: 0.45rem; }
        .sk-pid { display: none; }
        .sk-file { max-width: 11ch; }
        .sk-badge, .sk-foot-right { display: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        .sk-panel.sk-armed .sk-row { opacity: 1; transform: none; }
        .sk-panel.sk-armed .sk-meter-fill { width: var(--w, 0%); }
        .sk-panel::before,
        .sk-live-dot,
        .sk-caret,
        .sk-meter-fill { animation: none; }
        .sk-meter-sweep { display: none; }
    }

    /* Filter Tabs */
    .filter-tabs {
        display: flex; flex-wrap: wrap; gap: 0.6rem;
        justify-content: center; margin-bottom: 2.5rem;
    }
    .filter-btn {
        padding: 0.5rem 1.2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        color: var(--text-secondary);
        font-size: 0.82rem; font-weight: 500;
        cursor: pointer; transition: var(--transition);
        font-family: var(--font);
    }
    .filter-btn:hover {
        border-color: var(--accent);
        color: var(--accent-light);
    }
    .filter-btn.active {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .filter-btn.active:hover {
        color: #fff;
    }

    /* ===== PROJECTS - BUILD PIPELINE CARDS (coding design) ===== */
    .projects-section { background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%); }
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.75rem; }

    .project-card {
        position: relative; display: flex; flex-direction: column;
        background: linear-gradient(180deg, rgba(15, 25, 45, 0.78) 0%, rgba(10, 18, 35, 0.62) 100%);
        border: 1px solid rgba(129, 140, 248, 0.24); border-radius: 16px;
        overflow: hidden; text-decoration: none;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        box-shadow: 0 22px 55px rgba(2, 8, 23, 0.45);
        transition: box-shadow 0.4s ease, border-color 0.4s ease;
        will-change: transform;
    }
    html.light-theme .project-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.88) 0%, rgba(238, 242, 255, 0.72) 100%);
        border-color: rgba(99, 102, 241, 0.26);
        box-shadow: 0 22px 55px rgba(99, 102, 241, 0.16);
    }
    .project-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; z-index: 3;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
        background-size: 200% 100%;
        animation: atSweep 5s linear infinite;
    }
    .project-card:hover { border-color: rgba(129, 140, 248, 0.5); box-shadow: 0 30px 75px rgba(99, 102, 241, 0.26); }

    .pj-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(148, 163, 184, 0.14);
    }
    html.light-theme .pj-bar { background: rgba(15, 23, 42, 0.04); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .pj-file {
        display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 0.3rem;
        font-size: 0.72rem; color: #cbd5e1;
        min-width: 0; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
    }
    .pj-file i { color: #818cf8; }
    html.light-theme .pj-file { color: #334155; }
    .pj-status {
        margin-left: auto; white-space: nowrap;
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase;
        color: #34d399; background: rgba(52, 211, 153, 0.12);
        border: 1px solid rgba(52, 211, 153, 0.32);
        padding: 0.16rem 0.5rem; border-radius: 50px;
    }
    html.light-theme .pj-status { color: #047857; }

    .pj-run {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 2.1rem; padding: 0.5rem 0.9rem 0.3rem;
        font-size: 0.7rem; color: #cbd5e1;
    }
    html.light-theme .pj-run { color: #1e293b; }
    .pj-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .pj-cmd { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .pj-caret {
        flex-shrink: 0; width: 7px; height: 0.95em;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 8px rgba(52, 211, 153, 0.7);
        animation: glBlink 1s step-end infinite;
    }

    .pj-steps {
        display: flex; flex-wrap: wrap; gap: 0.3rem 0.65rem;
        padding: 0 0.9rem 0.6rem;
        font-size: 0.6rem; color: #64748b;
    }
    .pj-step {
        display: inline-flex; align-items: center; gap: 0.28rem;
        opacity: 0; transform: translateY(4px);
        transition: opacity 0.35s ease, transform 0.35s ease;
    }
    .pj-step i { color: #34d399; font-size: 0.7rem; }
    .project-card.pj-on .pj-step {
        opacity: 1; transform: translateY(0);
        transition-delay: calc(var(--s, 0) * 90ms);
    }

    .pj-artifact {
        position: relative; margin: 0 0.9rem;
        height: 168px; border-radius: 10px; overflow: hidden;
        border: 1px solid rgba(148, 163, 184, 0.18);
        display: flex; align-items: center; justify-content: center;
    }
    .pj-artifact::after {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(180deg, transparent 45%, rgba(8, 13, 26, 0.75) 100%);
    }
    html.light-theme .pj-artifact::after { background: linear-gradient(180deg, transparent 55%, rgba(241, 245, 249, 0.7) 100%); }
    .pj-artifact img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .project-card:hover .pj-artifact img { transform: scale(1.06); }
    .project-card .project-icon {
        position: relative; z-index: 1;
        font-size: 3rem; color: #c7d2fe; opacity: 0.6;
        transition: transform 0.5s ease, opacity 0.5s ease;
    }
    .project-card:hover .project-icon { transform: scale(1.15) rotate(-4deg); opacity: 1; }
    .pj-cat {
        position: absolute; right: 0.55rem; bottom: 0.55rem; z-index: 2;
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.3px; text-transform: uppercase;
        color: #e0e7ff; background: rgba(15, 23, 42, 0.62);
        border: 1px solid rgba(199, 210, 254, 0.3);
        padding: 0.18rem 0.5rem; border-radius: 50px;
        -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px);
    }
    html.light-theme .pj-cat { color: #312e81; background: rgba(255, 255, 255, 0.8); border-color: rgba(99, 102, 241, 0.3); }

    .pj-body { display: flex; flex-direction: column; gap: 0.55rem; flex: 1; padding: 0.9rem 0.9rem 1rem; }
    .project-card .card-body h3 { margin: 0; font-size: 1.05rem; font-weight: 700; letter-spacing: -0.2px; color: #f8fafc; }
    html.light-theme .project-card .card-body h3 { color: #0f172a; }
    .pj-techs { display: flex; flex-wrap: wrap; gap: 0.35rem; }
    .pj-tech {
        font-size: 0.58rem; padding: 0.16rem 0.5rem; border-radius: 50px;
        color: #a5b4fc; background: rgba(99, 102, 241, 0.12);
        border: 1px solid rgba(99, 102, 241, 0.26);
    }
    html.light-theme .pj-tech { color: #4338ca; background: rgba(99, 102, 241, 0.1); }

    .pj-foot {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.9rem;
        border-top: 1px solid rgba(148, 163, 184, 0.14);
        font-size: 0.64rem; color: #64748b;
    }
    html.light-theme .pj-foot { border-top-color: rgba(15, 23, 42, 0.08); }
    .pj-exit { display: inline-flex; align-items: center; gap: 0.32rem; color: #34d399; }
    .project-card .view-details-btn {
        margin-left: auto;
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.68rem; font-weight: 700; color: #c7d2fe;
        transition: gap 0.25s ease, color 0.25s ease;
    }
    html.light-theme .project-card .view-details-btn { color: #4338ca; }
    .project-card:hover .view-details-btn { gap: 0.7rem; color: #fff; }
    html.light-theme .project-card:hover .view-details-btn { color: #312e81; }
    @media (prefers-reduced-motion: reduce) {
        .project-card::before, .pj-caret { animation: none; }
        .pj-step { opacity: 1; transform: none; }
    }

/* ===== GIGS � TERMINAL INSTALL CARDS ===== */
    .gigs-section {
        background: linear-gradient(180deg, #080d1a 0%, #0a1628 50%, #080d1a 100%);
        position: relative;
        overflow: hidden;
    }
    html.light-theme .gigs-section {
        background: linear-gradient(180deg, #f8fafc 0%, #eef3fb 50%, #f8fafc 100%);
    }
    .gigs-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        mask-image: radial-gradient(ellipse at 50% 45%, #000 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }
    .pkg-grid {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        justify-content: center;
        gap: 1.75rem;
        position: relative;
        z-index: 1;
    }
    .pkg-card {
        position: relative;
        flex: 0 0 calc((100% - 3.5rem) / 3);
        max-width: calc((100% - 3.5rem) / 3);
        min-width: 260px;
        display: flex;
        flex-direction: column;
        background: rgba(6, 12, 24, 0.72);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(52, 211, 153, 0.18);
        border-radius: 14px;
        overflow: hidden;
        transition: var(--transition);
    }
    html.light-theme .pkg-card { background: rgba(248, 250, 252, 0.92); border-color: rgba(16, 185, 129, 0.22); }
    .pkg-card:hover {
        border-color: rgba(52, 211, 153, 0.5);
        box-shadow: 0 18px 50px rgba(2, 8, 23, 0.55), 0 0 40px rgba(16, 185, 129, 0.14);
        transform: translateY(-6px);
    }
    html.light-theme .pkg-card:hover { box-shadow: 0 18px 44px rgba(16, 185, 129, 0.18), var(--shadow-md); }
    .pkg-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 3px; height: 40%;
        background: linear-gradient(180deg, #34d399, #22d3ee);
        border-radius: 0 3px 3px 0;
        transition: height 0.5s ease;
        z-index: 3;
    }
    .pkg-card:hover::before { height: 100%; }

    /* ---- Terminal title bar ---- */
    .pkg-card-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.9rem;
        background: rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.72rem; color: var(--text-muted);
        position: relative; z-index: 2;
    }
    html.light-theme .pkg-card-bar { background: rgba(15, 23, 42, 0.035); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .pkg-card-bar .ab-dot { width: 10px; height: 10px; }
    .pkg-filename { margin-left: auto; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .pkg-ver {
        flex-shrink: 0;
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.4px;
        color: #6ee7b7;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.28);
        padding: 0.12rem 0.45rem; border-radius: 50px;
    }
    html.light-theme .pkg-ver { color: #047857; background: rgba(16, 185, 129, 0.1); }

    /* ---- Terminal session body ---- */
    .term-body {
        position: relative; z-index: 2;
        flex: 1 1 auto;
        display: flex; flex-direction: column; gap: 0.6rem;
        padding: 1rem 1rem 1.15rem;
        background: rgba(0, 0, 0, 0.3);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.76rem; line-height: 1.55;
        color: #cbd5e1;
        overflow: hidden;
    }
    html.light-theme .term-body { background: rgba(15, 23, 42, 0.04); color: #334155; }

    /* scanline sweep */
    .term-scan {
        position: absolute; left: 0; right: 0; top: -45%;
        height: 45%; pointer-events: none; z-index: 1;
        background: linear-gradient(180deg, transparent, rgba(52, 211, 153, 0.1) 45%, rgba(34, 211, 238, 0.16) 50%, rgba(52, 211, 153, 0.1) 55%, transparent);
        animation: termScan 5.5s cubic-bezier(0.6, 0, 0.4, 1) infinite;
    }
    html.light-theme .term-scan {
        background: linear-gradient(180deg, transparent, rgba(16, 185, 129, 0.07) 45%, rgba(14, 165, 233, 0.12) 50%, rgba(16, 185, 129, 0.07) 55%, transparent);
    }
    @keyframes termScan {
        0%   { top: -45%; opacity: 0; }
        15%  { opacity: 1; }
        70%  { top: 105%; opacity: 1; }
        100% { top: 105%; opacity: 0; }
    }

    .term-line { position: relative; z-index: 2; display: block; }
    .term-line[data-term] { opacity: 0; transform: translateY(8px); }
    .pkg-card.visible .term-line[data-term] {
        animation: termIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes termIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

    /* typed command */
    .term-cmd { display: flex; align-items: center; gap: 0.45rem; color: #e2e8f0; white-space: nowrap; overflow: hidden; }
    html.light-theme .term-cmd { color: #1e293b; }
    .term-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .term-type { overflow: hidden; text-overflow: ellipsis; }
    .term-caret {
        display: inline-block; flex-shrink: 0;
        width: 7px; height: 0.95em;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: termBlink 1s step-end infinite;
    }
    @keyframes termBlink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }

    /* dependency progress row */
    .term-prog { display: flex; align-items: center; gap: 0.5rem; font-size: 0.68rem; color: #94a3b8; }
    html.light-theme .term-prog { color: #64748b; }
    .term-bar {
        flex: 1 1 auto; min-width: 40px; height: 6px;
        border-radius: 50px;
        background: rgba(148, 163, 184, 0.18);
        overflow: hidden;
    }
    .term-bar-fill {
        display: block; height: 100%; width: 0;
        border-radius: 50px;
        background: linear-gradient(90deg, #10b981, #34d399, #22d3ee);
        background-size: 200% 100%;
        animation: termGrad 2.5s linear infinite;
    }
    @keyframes termGrad { 0% { background-position: 0% 0; } 100% { background-position: 200% 0; } }
    .term-prog-ok { color: #34d399; opacity: 0; transform: scale(0.6); transition: opacity 0.3s ease, transform 0.3s ease; }

    /* output rows with dotted leaders */
    .term-out { display: flex; align-items: baseline; gap: 0.45rem; }
    .term-key { color: #94a3b8; flex-shrink: 0; }
    html.light-theme .term-key { color: #64748b; }
    .term-dots { flex: 1 1 auto; min-width: 12px; border-bottom: 1px dotted rgba(148, 163, 184, 0.35); }
    .term-val {
        min-width: 0; text-align: right;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.86rem; font-weight: 600; color: #e2e8f0;
    }
    html.light-theme .term-val { color: #0f172a; }
    .term-price {
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 1.6rem; font-weight: 800; letter-spacing: -0.6px;
        color: #fbbf24;
    }
    html.light-theme .term-price { color: #b45309; }
    /* Gradient text is an enhancement only - the solid colour above is the fallback */
    @supports ((-webkit-background-clip: text) or (background-clip: text)) {
        .term-price {
            background: linear-gradient(135deg, #fbbf24, #f97316);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        html.light-theme .term-price {
            background: linear-gradient(135deg, #d97706, #ea580c);
            -webkit-background-clip: text; background-clip: text;
        }
    }
    .term-price em {
        font-style: normal; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.5px;
        margin-left: 0.25rem;
        color: var(--text-muted);
        -webkit-text-fill-color: var(--text-muted);
    }

    /* includes checklist */
    .term-includes { display: flex; flex-direction: column; gap: 0.15rem; }
    .term-items { list-style: none; margin: 0.3rem 0 0; padding: 0; display: flex; flex-direction: column; gap: 0.3rem; }
    .term-items li {
        display: flex; align-items: flex-start; gap: 0.45rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        font-size: 0.78rem; line-height: 1.5; color: var(--text-secondary);
    }
    .term-items li i { flex-shrink: 0; margin-top: 0.2rem; color: #34d399; font-size: 0.7rem; }

    /* install success */
    .term-exit { display: flex; align-items: center; gap: 0.45rem; font-size: 0.68rem; color: #34d399; }

    /* ---- Action ---- */
    .pkg-action {
        display: flex; align-items: center; justify-content: space-between;
        margin: 0.85rem 1.15rem 1.05rem;
        padding: 0.72rem 1rem;
        background: linear-gradient(135deg, #059669, #10b981);
        border-radius: 11px;
        font-family: var(--font); font-weight: 600; font-size: 0.9rem;
        color: #fff; text-decoration: none;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.28);
        position: relative; z-index: 2;
        transition: var(--transition);
    }
    .pkg-run-label { display: inline-flex; align-items: center; gap: 0.5rem; }
    .pkg-card:hover .pkg-action { box-shadow: 0 12px 32px rgba(16, 185, 129, 0.42); transform: translateY(-2px); }
    .pkg-arrow { transition: transform 0.3s ease; }
    .pkg-card:hover .pkg-arrow { transform: translateX(4px); }

    /* ---- Terminal status bar ---- */
    .pkg-foot {
        display: flex; justify-content: space-between; align-items: center;
        margin-top: auto;
        padding: 0.5rem 0.9rem;
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        background: rgba(255, 255, 255, 0.02);
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        font-size: 0.64rem; color: var(--text-muted);
        position: relative; z-index: 2;
    }
    html.light-theme .pkg-foot { background: rgba(15, 23, 42, 0.03); border-top-color: rgba(15, 23, 42, 0.08); }
    .pkg-status { display: inline-flex; align-items: center; gap: 0.4rem; color: #34d399; flex-shrink: 0; }
    .pkg-lang { display: inline-flex; align-items: center; gap: 0.35rem; }

    /* ---- Install session timing (per-line delays are set by JS) ---- */
    .pkg-card.visible .term-bar-fill {
        animation: termFill 1.1s 0.75s cubic-bezier(0.16, 1, 0.3, 1) forwards, termGrad 2.5s linear infinite;
    }
    @keyframes termFill { to { width: 100%; } }
    .pkg-card.visible .term-prog-ok { opacity: 1; transform: scale(1); transition-delay: 1.7s; }
    .pkg-action { opacity: 0; }
    .pkg-card.visible .pkg-action {
        animation: termIn 0.45s 1.85s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @media (prefers-reduced-motion: reduce) {
        .term-scan, .term-caret, .term-bar-fill { animation: none; }
        .term-line[data-term] { opacity: 1; transform: none; }
        .term-prog-ok { opacity: 1; transform: none; }
        .term-bar-fill { width: 100%; }
        .pkg-action { opacity: 1; animation: none; }
    }

    /* Testimonials */
    .testimonials-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%); }
    html.light-theme .testimonials-section { background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); }
    /* ===== TESTIMONIALS - PULL-REQUEST REVIEW CARDS (coding design) ===== */
    .testimonial-carousel { max-width: 900px; margin: 0 auto; position: relative; overflow: hidden; }
    .testimonial-track { display: flex; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }

    .testimonial-card {
        flex: 0 0 100%; width: 100%; padding: 0; box-sizing: border-box;
        display: flex; flex-direction: column; text-align: left;
        background: linear-gradient(180deg, rgba(15, 25, 45, 0.78) 0%, rgba(10, 18, 35, 0.6) 100%);
        border: 1px solid rgba(129, 140, 248, 0.24); border-radius: 16px;
        overflow: hidden; position: relative;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        box-shadow: 0 22px 55px rgba(2, 8, 23, 0.45);
        transition: var(--transition);
    }
    html.light-theme .testimonial-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.88) 0%, rgba(238, 242, 255, 0.72) 100%);
        border-color: rgba(99, 102, 241, 0.26);
        box-shadow: 0 22px 55px rgba(99, 102, 241, 0.16);
    }
    .testimonial-card:hover { border-color: rgba(129, 140, 248, 0.5); box-shadow: 0 30px 75px rgba(99, 102, 241, 0.26); }

    .tst-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255, 255, 255, 0.035);
        border-bottom: 1px solid rgba(148, 163, 184, 0.14);
    }
    html.light-theme .tst-bar { background: rgba(15, 23, 42, 0.04); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .tst-file { display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 0.3rem; font-size: 0.72rem; color: #cbd5e1; }
    .tst-file i { color: #818cf8; }
    html.light-theme .tst-file { color: #334155; }
    .tst-hash { font-size: 0.66rem; color: #64748b; }
    .tst-badge {
        margin-left: auto; white-space: nowrap;
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase;
        color: #34d399; background: rgba(52, 211, 153, 0.12);
        border: 1px solid rgba(52, 211, 153, 0.32);
        padding: 0.16rem 0.5rem; border-radius: 50px;
    }
    html.light-theme .tst-badge { color: #047857; }

    .tst-head { display: flex; align-items: center; gap: 0.7rem; padding: 0.95rem 0.95rem 0.45rem; }
    .testimonial-author { display: flex; align-items: center; gap: 0.7rem; min-width: 0; }
    .author-avatar img, .avatar-fallback {
        width: 44px; height: 44px; border-radius: 50%; object-fit: cover;
        border: 2px solid rgba(99, 102, 241, 0.35); display: block;
    }
    .avatar-fallback {
        display: flex; align-items: center; justify-content: center;
        background: var(--accent-gradient); font-family: var(--font);
        font-weight: 700; font-size: 1.05rem; color: #fff;
    }
    .author-name { font-family: var(--font); font-weight: 700; color: var(--text-primary); font-size: 0.95rem; line-height: 1.25; }
    .author-designation { font-family: var(--font); font-size: 0.75rem; color: var(--text-muted); margin-top: 2px; }
    .testimonial-stars { margin-left: auto; display: flex; gap: 2px; font-size: 0.82rem; color: #f59e0b; flex-shrink: 0; }
    .testimonial-stars .bi-star { opacity: 0.25; }

    .tst-review {
        display: flex; gap: 0.75rem;
        margin: 0.4rem 0.95rem 0.95rem;
        padding: 0.85rem 1rem 0.85rem 0.9rem;
        background: rgba(2, 8, 23, 0.4);
        border-left: 2px solid rgba(99, 102, 241, 0.55);
        border-radius: 0 10px 10px 0;
    }
    html.light-theme .tst-review { background: rgba(15, 23, 42, 0.045); }
    .tst-gutter { flex-shrink: 0; padding-top: 0.14rem; color: #6366f1; font-size: 0.78rem; font-weight: 700; }
    .testimonial-text { margin: 0; color: #cbd5e1; font-size: 0.92rem; line-height: 1.75; }
    html.light-theme .testimonial-text { color: #334155 !important; }

    .tst-foot {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.5rem 0.95rem;
        border-top: 1px solid rgba(148, 163, 184, 0.14);
        font-size: 0.64rem; color: #64748b;
    }
    html.light-theme .tst-foot { border-top-color: rgba(15, 23, 42, 0.08); }
    .tst-ok { display: inline-flex; align-items: center; gap: 0.32rem; color: #34d399; }
    .tst-merge { margin-left: auto; }

    /* review lines write in whenever a slide becomes active (JS adds .tst-in) */
    .testimonial-card.tst-in > * { animation: tstIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .testimonial-card.tst-in > *:nth-child(2) { animation-delay: 80ms; }
    .testimonial-card.tst-in > *:nth-child(3) { animation-delay: 160ms; }
    .testimonial-card.tst-in > *:nth-child(4) { animation-delay: 240ms; }
    @keyframes tstIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (prefers-reduced-motion: reduce) {
        .testimonial-card.tst-in > * { animation: none; }
    }
    .carousel-controls { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-top: 2rem; }
    .carousel-btn {
        width: 44px; height: 44px; border-radius: 50%;
        border: 1px solid rgba(59, 130, 246, 0.25);
        background: rgba(30, 41, 59, 0.4); color: var(--text-secondary);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: var(--transition); font-size: 1.1rem;
    }
    html.light-theme .carousel-btn { background: rgba(255, 255, 255, 0.85) !important; color: #475569 !important; }
    .carousel-btn:hover { background: var(--accent); border-color: var(--accent); color: #fff; transform: scale(1.05); }
    .carousel-dots { display: flex; gap: 8px; }
    .carousel-dots .dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(59, 130, 246, 0.2); cursor: pointer; transition: var(--transition); }
    .carousel-dots .dot.active { background: var(--accent); width: 28px; border-radius: 5px; }

        /* ===== CONTACT — CODING TERMINAL DESIGN ===== */
    .contact-section {
        background: linear-gradient(180deg, #060b18 0%, #0a1628 40%, #0d1f36 70%, #080d1a 100%);
        position: relative; overflow: hidden;
    }
    html.light-theme .contact-section { background: linear-gradient(180deg, #e8f0fe 0%, #dce8f8 40%, #d0e0f5 70%, #eef2f7 100%); }
    .contact-section::before {
        content: ""; position: absolute; top: -20%; left: -10%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.08), transparent 70%);
        border-radius: 50%; pointer-events: none; animation: contactOrbFloat 8s ease-in-out infinite; z-index: 0;
    }
    .contact-section::after {
        content: ""; position: absolute; bottom: -10%; right: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.06), transparent 70%);
        border-radius: 50%; pointer-events: none; animation: contactOrbFloat2 10s ease-in-out infinite; z-index: 0;
    }
    @keyframes contactOrbFloat { 0%, 100% { transform: translate(0, 0) scale(1); } 33% { transform: translate(30px, -30px) scale(1.1); } 66% { transform: translate(-20px, 20px) scale(0.95); } }
    @keyframes contactOrbFloat2 { 0%, 100% { transform: translate(0, 0) scale(1); } 33% { transform: translate(-30px, 20px) scale(1.05); } 66% { transform: translate(20px, -30px) scale(0.9); } }
    .contact-section .contact-bg-grid {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background-image: linear-gradient(rgba(59,130,246,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.03) 1px, transparent 1px);
        background-size: 60px 60px; pointer-events: none; z-index: 0;
    }
    html.light-theme .contact-section .contact-bg-grid {
        background-image: linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px);
    }
    .contact-section .container { position: relative; z-index: 1; }
    .contact-grid {
        display: grid; grid-template-columns: 1fr 1.3fr;
        gap: 3rem; align-items: start;
    }

    /* ===== TERMINAL WINDOW — CONTACT INFO ===== */
    .ct-terminal {
        position: relative; font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.6) 0%, rgba(8, 15, 32, 0.45) 100%);
        -webkit-backdrop-filter: blur(18px) saturate(160%); backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(147, 197, 253, 0.22); border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 40px 110px rgba(2, 8, 23, 0.7), 0 0 0 1px rgba(255,255,255,0.06) inset, 0 0 70px rgba(59, 130, 246, 0.09);
        transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.4s ease;
    }
    .ct-terminal:hover { border-color: rgba(147, 197, 253, 0.4); box-shadow: 0 40px 110px rgba(2,8,23,0.7), 0 0 0 1px rgba(255,255,255,0.06) inset, 0 0 90px rgba(59,130,246,0.15); transform: translateY(-4px); }
    .ct-terminal::before {
        content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #3b82f6, #22d3ee, #8b5cf6, transparent);
        background-size: 200% 100%; animation: atSweep 6s linear infinite; z-index: 3;
    }
    html.light-theme .ct-terminal {
        background: linear-gradient(180deg, rgba(255,255,255,0.74) 0%, rgba(230,240,252,0.6) 100%);
        border-color: rgba(59,130,246,0.28);
        box-shadow: 0 40px 90px rgba(59,130,246,0.2), 0 0 0 1px rgba(255,255,255,0.7) inset;
    }
    .ct-term-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255,255,255,0.035);
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .ct-term-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .ct-term-dots { display: flex; gap: 6px; }
    .ct-term-dots i { width: 11px; height: 11px; border-radius: 50%; }
    .ct-term-dots i:nth-child(1) { background: #ff5f57; }
    .ct-term-dots i:nth-child(2) { background: #febc2e; }
    .ct-term-dots i:nth-child(3) { background: #28c840; }
    .ct-term-title { margin-left: 0.3rem; font-size: 0.7rem; color: #94a3b8; white-space: nowrap; }
    html.light-theme .ct-term-title { color: #64748b; }
    .ct-term-status {
        margin-left: auto; display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.62rem; color: #34d399;
        background: rgba(52,211,153,0.08); border: 1px solid rgba(52,211,153,0.28);
        padding: 0.2rem 0.6rem; border-radius: 50px; white-space: nowrap;
    }
    .ct-term-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.9rem; font-size: 0.75rem;
        background: rgba(2,8,23,0.45); border-bottom: 1px solid rgba(148,163,184,0.12);
    }
    html.light-theme .ct-term-cmd { background: rgba(15,23,42,0.05); border-bottom-color: rgba(15,23,42,0.08); }
    .ct-term-prompt { color: #34d399; font-weight: 700; }
    .ct-term-cmd-text { color: #e2e8f0; }
    html.light-theme .ct-term-cmd-text { color: #1e293b; }
    .ct-term-caret {
        display: inline-block; width: 7px; height: 1em; background: #34d399;
        border-radius: 1px; box-shadow: 0 0 10px rgba(52,211,153,0.7);
        animation: glBlink 1s step-end infinite;
    }
    .ct-term-body { padding: 1.2rem 1rem 1.3rem; }
    .ct-term-heading {
        font-family: var(--font); font-size: 1.2rem; font-weight: 800;
        margin-bottom: 0.5rem; color: var(--text-primary);
    }
    .ct-term-desc { font-family: var(--font); font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.2rem; }

    /* Contact items as config lines */
    .ct-config-list { display: flex; flex-direction: column; gap: 0.6rem; }
    .ct-config-line {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.7rem 0.85rem; border-radius: 10px;
        background: rgba(59,130,246,0.04); border: 1px solid rgba(59,130,246,0.08);
        transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
        position: relative; overflow: hidden;
    }
    .ct-config-line::before {
        content: ""; position: absolute; top: 0; left: 0; bottom: 0; width: 3px;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        border-radius: 0 3px 3px 0;
        transform: scaleY(0); transform-origin: top;
        transition: transform 0.4s cubic-bezier(0.16,1,0.3,1);
    }
    .ct-config-line:hover::before { transform: scaleY(1); }
    .ct-config-line:hover {
        border-color: rgba(59,130,246,0.25); transform: translateX(6px);
        background: rgba(59,130,246,0.07);
        box-shadow: 0 6px 24px rgba(59,130,246,0.08);
    }
    html.light-theme .ct-config-line { background: rgba(255,255,255,0.5); border-color: rgba(59,130,246,0.12); }
    html.light-theme .ct-config-line:hover { background: rgba(255,255,255,0.8); box-shadow: 0 6px 24px rgba(59,130,246,0.12); }
    .ct-config-icon {
        width: 36px; height: 36px; min-width: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem; color: var(--accent-light);
        background: linear-gradient(135deg, rgba(59,130,246,0.12), rgba(139,92,246,0.08));
        transition: all 0.4s ease;
    }
    .ct-config-line:hover .ct-config-icon {
        background: var(--accent-gradient); color: #fff;
        transform: scale(1.1) rotate(-5deg); box-shadow: 0 6px 20px rgba(59,130,246,0.3);
    }
    .ct-config-key {
        font-size: 0.62rem; color: #818cf8; text-transform: uppercase;
        letter-spacing: 0.5px; font-weight: 700; margin-bottom: 1px;
    }
    .ct-config-val { font-size: 0.88rem; font-weight: 700; color: var(--text-primary); transition: color 0.3s; }
    .ct-config-line:hover .ct-config-val { color: var(--accent-light); }
    html.light-theme .ct-config-key { color: #6366f1; }

    /* Social row */
    .ct-socials { margin-top: 1.2rem; padding-top: 1rem; border-top: 1px solid rgba(59,130,246,0.08); }
    .ct-socials-label {
        font-size: 0.64rem; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase;
        color: var(--text-muted); margin-bottom: 0.6rem;
        display: flex; align-items: center; gap: 0.4rem;
    }
    .ct-socials-label i { color: var(--accent-light); }
    .ct-socials-row { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .ct-social-link {
        width: 38px; height: 38px; border-radius: 10px;
        background: rgba(59,130,246,0.06); border: 1px solid rgba(59,130,246,0.14);
        display: inline-flex; align-items: center; justify-content: center;
        color: var(--text-muted); font-size: 1rem; text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    }
    .ct-social-link:hover {
        background: var(--accent-gradient); border-color: transparent;
        color: #fff; transform: translateY(-4px) scale(1.08);
        box-shadow: 0 8px 24px rgba(59,130,246,0.3);
    }

    /* ===== CODE EDITOR — CONTACT FORM ===== */
    .ct-editor {
        position: relative; font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13,23,43,0.6) 0%, rgba(8,15,32,0.45) 100%);
        -webkit-backdrop-filter: blur(18px) saturate(160%); backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(147,197,253,0.22); border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 40px 110px rgba(2,8,23,0.7), 0 0 0 1px rgba(255,255,255,0.06) inset, 0 0 70px rgba(59,130,246,0.09);
        transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.4s ease;
    }
    .ct-editor:hover { border-color: rgba(147,197,253,0.4); box-shadow: 0 40px 110px rgba(2,8,23,0.7), 0 0 90px rgba(59,130,246,0.15); transform: translateY(-4px); }
    .ct-editor::before {
        content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: atSweep 6s linear infinite; z-index: 3;
    }
    html.light-theme .ct-editor {
        background: linear-gradient(180deg, rgba(255,255,255,0.74) 0%, rgba(230,240,252,0.6) 100%);
        border-color: rgba(59,130,246,0.28);
        box-shadow: 0 40px 90px rgba(59,130,246,0.2), 0 0 0 1px rgba(255,255,255,0.7) inset;
    }
    .ct-editor-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255,255,255,0.035);
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .ct-editor-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .ct-editor-tab {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.7rem; color: #93c5fd;
        background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);
        padding: 0.22rem 0.65rem; border-radius: 6px 6px 0 0; white-space: nowrap;
        border-bottom: none; position: relative; top: 1px;
    }
    .ct-editor-tab i { font-size: 0.8rem; color: #fbbf24; }
    html.light-theme .ct-editor-tab { color: #2563eb; background: rgba(59,130,246,0.1); }
    .ct-editor-lang {
        margin-left: auto; font-size: 0.6rem; color: #64748b; font-weight: 600;
        letter-spacing: 0.3px; text-transform: uppercase;
    }
    .ct-editor-body { padding: 1.2rem 1rem 1.3rem; }
    .ct-editor-heading {
        font-family: var(--font); font-size: 1.1rem; font-weight: 700;
        color: var(--text-primary); margin-bottom: 0.3rem;
    }
    .ct-editor-desc { font-family: var(--font); font-size: 0.82rem; color: var(--text-secondary); margin-bottom: 1.2rem; }

    /* Form fields as code lines */
    .ct-code-group { margin-bottom: 1.2rem; position: relative; }
    .ct-code-label {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.66rem; font-weight: 700; margin-bottom: 0.35rem;
        color: #818cf8; letter-spacing: 0.3px;
    }
    html.light-theme .ct-code-label { color: #6366f1; }
    .ct-code-label i { font-size: 0.75rem; color: #fbbf24; }
    .ct-code-input-wrap { position: relative; }
    .ct-code-line {
        display: flex; align-items: center; gap: 0.5rem;
        background: rgba(2,8,23,0.4); border: 1px solid rgba(148,163,184,0.12);
        border-radius: 10px; padding: 0 0.85rem;
        transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
    }
    html.light-theme .ct-code-line { background: rgba(15,23,42,0.05); border-color: rgba(15,23,42,0.08); }
    .ct-code-line:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.08), 0 4px 20px rgba(59,130,246,0.05);
        background: rgba(2,8,23,0.6);
    }
    html.light-theme .ct-code-line:focus-within { background: #fff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }
    .ct-code-ln {
        font-size: 0.6rem; color: #475569; min-width: 1.5rem;
        text-align: right; user-select: none; padding-right: 0.3rem;
    }
    .ct-code-input {
        flex: 1; padding: 0.7rem 0; background: transparent; border: none;
        color: var(--text-primary) !important; font-family: inherit; font-size: 0.85rem;
        outline: none;
    }
    html.light-theme .ct-code-input { color: #0f172a !important; }
    .ct-code-input::placeholder { color: rgba(148,163,184,0.35); }
    html.light-theme .ct-code-input::placeholder { color: rgba(100,116,139,0.4); }
    .ct-code-textarea {
        flex: 1; padding: 0.7rem 0; background: transparent; border: none;
        color: var(--text-primary) !important; font-family: inherit; font-size: 0.85rem;
        outline: none; resize: vertical; min-height: 100px; line-height: 1.6;
    }
    html.light-theme .ct-code-textarea { color: #0f172a !important; }
    .ct-code-textarea::placeholder { color: rgba(148,163,184,0.35); }
    html.light-theme .ct-code-textarea::placeholder { color: rgba(100,116,139,0.4); }
    .ct-code-end { font-size: 0.7rem; color: #64748b; user-select: none; }

    /* Submit as git push button */
    .ct-push-btn {
        width: 100%; padding: 0.85rem 1.2rem; margin-top: 0.5rem;
        background: linear-gradient(135deg, #065f46, #047857, #059669);
        color: #d1fae5; border: 1px solid rgba(52,211,153,0.4); border-radius: 12px;
        font-family: inherit; font-size: 0.82rem; font-weight: 700;
        cursor: pointer; position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; gap: 0.55rem;
        box-shadow: 0 10px 30px rgba(16,185,129,0.24);
        transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
    }
    .ct-push-btn::before {
        content: ""; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
        transition: left 0.6s ease;
    }
    .ct-push-btn:hover::before { left: 100%; }
    .ct-push-btn:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 14px 38px rgba(16,185,129,0.38); color: #fff; }
    .ct-push-btn .push-icon { transition: transform 0.4s ease; }
    .ct-push-btn:hover .push-icon { transform: translateX(4px); }
    .ct-push-prompt { color: #6ee7b7; }
    .ct-push-badge {
        margin-left: auto; font-size: 0.55rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;
        background: rgba(255,255,255,0.18); border-radius: 6px; padding: 0.15rem 0.45rem;
    }
    .ct-push-shimmer {
        position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }
    .ct-push-btn:hover .ct-push-shimmer { left: 100%; }

    
    /* ===== FAQ — CODING COLLAPSIBLE BLOCKS ===== */
    .faq-section {
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%);
    }
    html.light-theme .faq-section { background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); }
    .faq-list { max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 0.75rem; }
    .faq-item {
        font-family: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
        background: linear-gradient(180deg, rgba(13, 23, 43, 0.6) 0%, rgba(8, 15, 32, 0.45) 100%);
        -webkit-backdrop-filter: blur(18px) saturate(160%); backdrop-filter: blur(18px) saturate(160%);
        border: 1px solid rgba(147, 197, 253, 0.18); border-radius: 14px;
        overflow: hidden; position: relative;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .faq-item::before {
        content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        opacity: 0.4; transition: opacity 0.4s ease;
    }
    .faq-item:hover {
        border-color: rgba(147, 197, 253, 0.35);
        box-shadow: 0 8px 30px rgba(2, 8, 23, 0.5), 0 0 40px rgba(59, 130, 246, 0.06);
        transform: translateX(4px);
    }
    .faq-item:hover::before { opacity: 1; }
    .faq-item.faq-open {
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 12px 40px rgba(2, 8, 23, 0.6), 0 0 60px rgba(59, 130, 246, 0.08);
    }
    .faq-item.faq-open::before { opacity: 1; }
    html.light-theme .faq-item {
        background: linear-gradient(180deg, rgba(255,255,255,0.74) 0%, rgba(230,240,252,0.6) 100%);
        border-color: rgba(59,130,246,0.22);
    }
    html.light-theme .faq-item:hover { box-shadow: 0 8px 30px rgba(59,130,246,0.12); }
    html.light-theme .faq-item.faq-open { border-color: rgba(59,130,246,0.35); box-shadow: 0 12px 40px rgba(59,130,246,0.15); }

    /* Question row */
    .faq-q-row {
        display: flex; align-items: center; gap: 0.65rem;
        width: 100%; padding: 1rem 1.2rem; background: none; border: none;
        color: var(--text-primary); font-family: inherit; font-size: 0.88rem;
        font-weight: 600; text-align: left; cursor: pointer;
        transition: all 0.3s ease; position: relative;
    }
    .faq-q-row:hover { background: rgba(59, 130, 246, 0.04); }
    .faq-q-icon {
        width: 28px; height: 28px; min-width: 28px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem; color: #818cf8;
        background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.18);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .faq-item.faq-open .faq-q-icon {
        background: var(--accent-gradient); color: #fff; border-color: transparent;
        transform: rotate(-5deg) scale(1.1);
    }
    .faq-q-text { flex: 1; color: var(--text-primary); line-height: 1.4; }
    .faq-q-chevron {
        font-size: 0.7rem; color: var(--accent-light); flex-shrink: 0;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .faq-item.faq-open .faq-q-chevron { transform: rotate(180deg); }

    /* Answer block */
    .faq-a-block {
        max-height: 0; overflow: hidden;
        transition: max-height 0.45s cubic-bezier(0.16, 1, 0.3, 1), padding 0.35s ease;
        padding: 0 1.2rem;
    }
    .faq-item.faq-open .faq-a-block {
        max-height: 500px; padding: 0 1.2rem 1.1rem;
    }
    .faq-a-inner {
        padding: 0.85rem 1rem;
        background: rgba(2, 8, 23, 0.35); border-left: 2px solid rgba(59, 130, 246, 0.4);
        border-radius: 0 10px 10px 0;
        font-size: 0.82rem; line-height: 1.8; color: var(--text-secondary);
    }
    html.light-theme .faq-a-inner { background: rgba(15, 23, 42, 0.04); }
    .faq-a-gutter { color: #6366f1; font-weight: 700; margin-right: 0.5rem; }

    /* Responsive */
    @media (max-width: 768px) {
        .faq-q-row { padding: 0.85rem 1rem; font-size: 0.82rem; gap: 0.5rem; }
        .faq-q-icon { width: 24px; height: 24px; min-width: 24px; font-size: 0.65rem; }
        .faq-a-inner { padding: 0.7rem 0.85rem; font-size: 0.78rem; }
    }
    @media (max-width: 480px) {
        .faq-q-row { padding: 0.75rem 0.85rem; font-size: 0.78rem; }
    }

/* Map */
    .map-wrapper { margin-top: 3rem; }
    .map-container {
        max-width: 900px; margin: 0 auto; border-radius: 16px;
        overflow: hidden; border: 1px solid rgba(59,130,246,0.12);
        box-shadow: 0 10px 40px rgba(0,0,0,0.3); transition: all 0.4s ease; position: relative;
    }
    .map-container:hover { border-color: rgba(59,130,246,0.25); box-shadow: 0 20px 60px rgba(0,0,0,0.4); transform: translateY(-3px); }
    .map-container iframe { display: block; filter: invert(0.9) hue-rotate(180deg) saturate(0.5); transition: filter 0.5s; }
    .map-container:hover iframe { filter: invert(0.85) hue-rotate(180deg) saturate(0.6); }
    html.light-theme .map-container iframe { filter: none !important; }
    html.light-theme .map-container { box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
    html.light-theme .map-container:hover { box-shadow: 0 20px 60px rgba(0,0,0,0.12); }
    /* Footer */
    .footer {
        background: #080b14; position: relative; z-index: 1;
        padding: 3.5rem 2rem 2.5rem; text-align: center;
        border-top: none; overflow: hidden;
    }
    .footer::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #3b82f6, #8b5cf6, #3b82f6, transparent);
        background-size: 200% 100%; animation: footerLine 3s linear infinite;
    }
    @keyframes footerLine {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .footer::after {
        content: ''; position: absolute; top: -50%; left: 50%; translate: -50% 0;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
        pointer-events: none;
    }
    html.light-theme .footer { background: linear-gradient(180deg, #f1f5f9, #e2e8f0) !important; }
    html.light-theme .footer::after {
        background: radial-gradient(circle, rgba(59,130,246,0.04) 0%, transparent 70%);
    }
    .footer-inner { position: relative; z-index: 2; max-width: 900px; margin: 0 auto; }
    .footer-brand { margin-bottom: 1.5rem; }
    .footer-brand h4 {
        font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px;
        background: linear-gradient(135deg, var(--accent-light), #a78bfa);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .footer-brand p { color: #64748b; font-size: 0.82rem; margin: 0.3rem 0 0; }
    .footer-divider {
        width: 80px; height: 2px; margin: 0 auto 1.5rem;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        border-radius: 2px;
    }
    .footer-links {
        display: flex; justify-content: center; gap: 1.8rem; margin-bottom: 1.5rem; flex-wrap: wrap;
    }
    .footer-links a {
        color: #64748b; transition: all 0.3s ease; font-size: 0.85rem;
        font-weight: 500; text-decoration: none; position: relative;
        padding: 0.2rem 0;
    }
    .footer-links a::after {
        content: ''; position: absolute; bottom: 0; left: 50%; right: 50%;
        height: 1px; background: var(--accent);
        transition: all 0.3s ease;
    }
    .footer-links a:hover { color: var(--accent); }
    .footer-links a:hover::after { left: 0; right: 0; }
    .social-icon {
        width: 44px; height: 44px; border-radius: 14px;
        background: rgba(59,130,246,0.06);
        border: 1px solid rgba(59,130,246,0.1);
        display: inline-flex; align-items: center; justify-content: center;
        color: #64748b; font-size: 1.2rem;
        transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
        text-decoration: none; position: relative; overflow: hidden;
    }
    .social-icon::before {
        content: ''; position: absolute; inset: 0; border-radius: inherit;
        background: linear-gradient(135deg, rgba(59,130,246,0.12), rgba(139,92,246,0.08));
        opacity: 0; transition: opacity 0.35s ease;
    }
    .social-icon i { position: relative; z-index: 1; }
    .social-icon:hover::before { opacity: 1; }
    .social-icon:hover {
        border-color: rgba(59,130,246,0.35); color: var(--accent-light);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(59,130,246,0.2);
    }
    html.light-theme .social-icon {
        background: rgba(255,255,255,0.5); border-color: rgba(59,130,246,0.12);
    }
    html.light-theme .social-icon:hover {
        background: rgba(255,255,255,0.8); border-color: var(--accent); color: var(--accent);
    }
    .footer-bottom {
        padding-top: 1.2rem; border-top: 1px solid rgba(59,130,246,0.06);
        display: flex; justify-content: center; align-items: center; gap: 1rem; flex-wrap: wrap;
    }
    .footer-bottom p { color: #475569; font-size: 0.82rem; margin: 0; }
    .footer-bottom .heart { color: #ef4444; display: inline-block; animation: heartBeat 1.4s ease infinite; }
    @keyframes heartBeat { 0%,100% { transform: scale(1); } 50% { transform: scale(1.2); } }
    .back-top {
        display: inline-flex; align-items: center; gap: 0.4rem;
        color: var(--accent); font-size: 0.8rem; font-weight: 600;
        text-decoration: none; transition: all 0.3s ease;
    }
    .back-top:hover { gap: 0.7rem; color: var(--accent-light); }
    html.light-theme .footer-links a { color: #64748b; }
    html.light-theme .footer-bottom p { color: #64748b; }

    /* WhatsApp */
    .whatsapp-float {
        position: fixed; bottom: 2rem; left: 2rem;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, #25D366, #128C7E);
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; color: #fff; font-size: 1.6rem;
        z-index: 9999; box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35);
        transition: var(--transition); text-decoration: none;
        animation: pulseWhatsApp 2.5s ease-in-out infinite;
    }
    .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 10px 35px rgba(37, 211, 102, 0.5); color: #fff; }
    .whatsapp-tooltip {
        position: absolute; left: 66px; top: 50%; transform: translateY(-50%);
        background: #1e293b; color: var(--text-primary);
        padding: 0.4rem 0.9rem; border-radius: var(--radius-sm);
        font-size: 0.78rem; white-space: nowrap; font-weight: 500;
        opacity: 0; pointer-events: none; transition: var(--transition);
        border: 1px solid var(--border-color);
    }
    html.light-theme .whatsapp-tooltip { background: #f1f5f9 !important; color: #0f172a !important; border-color: rgba(59, 130, 246, 0.15) !important; }
    .whatsapp-float:hover .whatsapp-tooltip { opacity: 1; }
    @keyframes pulseWhatsApp {
        0%, 100% { box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35); }
        50% { box-shadow: 0 6px 40px rgba(37, 211, 102, 0.6); }
    }

    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed; top: 0; left: 0;
        height: 3px; z-index: 10001;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
        background-size: 200% 100%;
        animation: progressGlow 2s ease infinite;
        width: 0%;
        transition: width 0.1s ease-out;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
    }
    @keyframes progressGlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Back to Top */


    /* Floating Admin Button */
    .admin-float-btn {
        position: fixed; bottom: 5rem; right: 2rem;
        width: 48px; height: 48px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; cursor: pointer; z-index: 99;
        opacity: 0; transform: translateY(20px);
        transition: var(--transition); border: none; color: #fff;
        text-decoration: none;
        box-shadow: 0 5px 20px rgba(99,102,241,0.3);
    }
    .admin-float-btn:hover {
        opacity: 1 !important;
        transform: translateY(-5px) !important;
        color: #fff;
        box-shadow: 0 10px 30px rgba(99,102,241,0.45);
    }
    .admin-float-btn.visible { opacity: 1; transform: translateY(0); }

    /* Toast */
    .toast {
        position: fixed; bottom: 2rem; left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: var(--accent-gradient); color: #fff;
        padding: 1rem 2rem; border-radius: var(--radius-md);
        font-weight: 600; z-index: 10000;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: var(--shadow-accent);
        display: flex; align-items: center; gap: 0.5rem;
    }
    .toast.show { transform: translateX(-50%) translateY(0); }

    /* Shared Utilities */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state i { font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem; display: block; }
    .empty-state p { color: var(--text-muted); }
    .magnetic { transition: transform 0.3s ease; }

    /* ===== COMPREHENSIVE RESPONSIVE ===== */
    
    /* Keep the decoration but reduce clutter on smaller desktops */
    @media (max-width: 1200px) {
        .code-fragment.f2 { display: none; }
        .code-fragment.f5 { display: none; }
    }
    
    /* Tablet (max 968px) */
    @media (max-width: 968px) {
        .about-shell, .contact-grid { grid-template-columns: 1fr; gap: 2.5rem; }
        .projects-grid { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
        .hero { padding: 5rem 1.5rem 2rem; }
        .whatsapp-float { width: 48px; height: 48px; font-size: 1.3rem; bottom: 1.5rem; left: 1.5rem; }
        .admin-float-btn { width: 42px; height: 42px; font-size: 1rem; bottom: 4.5rem; right: 1.5rem; }
        .hero-aurora { opacity: 0.7; }
        #hero-canvas { opacity: 0.7; }
        .hero-scan { display: none; }
        .float-chip { display: none; }
        .code-fragment { display: none; }
    }
    
    /* Mobile Large (max 768px) */
    @media (max-width: 768px) {
        .section-padding { padding: 5rem 1.5rem; }
        .hero h1 { font-size: clamp(1.9rem, 7.5vw, 3.2rem); }
        .hero p { font-size: 1rem; line-height: 1.75; max-width: 100%; }
        .hero-badge { font-size: 0.72rem; padding: 0.3rem 1rem; margin-bottom: 1.1rem; }
        .hero::before { width: 400px; height: 400px; }
        .hero-aurora { display: none; }
        #hero-canvas { opacity: 0.35; }
        
        
        
        

        
        

        
        .project-card .card-body { padding: 0.85rem 0.85rem 1rem; }
        .project-card .card-body h3 { font-size: 1rem; }
        .pj-artifact { height: 150px; }
        .project-card .card-body .view-details-btn { font-size: 0.8rem; }
        .pkg-grid { gap: 1.5rem; }
        .pkg-card { flex-basis: calc((100% - 1.5rem) / 2); max-width: calc((100% - 1.5rem) / 2); min-width: 240px; }
        .term-body { font-size: 0.74rem; }
        .term-price { font-size: 1.45rem; }
        .pkg-action { margin-left: 1rem; margin-right: 1rem; font-size: 0.85rem; }
        .filter-tabs { gap: 0.4rem; }
        .filter-btn { font-size: 0.75rem; padding: 0.4rem 1rem; }
        
        .testimonial-text { font-size: 0.9rem; }
        .tst-head { flex-wrap: wrap; }
        .testimonial-stars { margin-left: 0; }
        .contact-info h3 { font-size: 1.4rem; }
        .contact-form { padding: 1.8rem; }
        
        .faq-item .faq-question { padding: 1rem 1.2rem !important; font-size: 0.92rem !important; }
        .faq-answer p { font-size: 0.85rem !important; }
        
        .footer { padding: 2.5rem 1.5rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 1.2rem; }
        .footer-links a { font-size: 0.82rem; }
        .social-icon { width: 38px; height: 38px; font-size: 1rem; }
        .footer-bottom { flex-direction: column; gap: 0.5rem; text-align: center; }
        
        .scroll-indicator { display: none; }
        .toast { padding: 0.8rem 1.5rem; font-size: 0.85rem; max-width: 90%; }
        .empty-state { padding: 3rem 1.2rem; }
        .empty-state i { font-size: 2.2rem; }
        
/* Tablet hero decorative */
        .float-chip.c1 { top: 10%; right: 3%; }
        .float-chip.c2 { display: none; }
        .float-chip.c3 { display: none; }
        .float-chip.c4 { display: none; }
        .float-chip.c5 { display: none; }
        .code-fragment { display: none; }
        .hero-aurora { opacity: 0.4; }
        #hero-canvas { opacity: 0.45; }
        .hero-scan { display: none; }
        .code-grid-bg { background-size: 36px 36px; }
    }
    
    /* Mobile Small (max 480px) */
    @media (max-width: 480px) {
        .section-padding { padding: 3rem 1rem; }
        .hero { padding: 3.5rem 1rem 2rem; min-height: 70vh; }
        .hero h1 { font-size: 1.75rem; letter-spacing: -0.5px; }
        .hero h1 .gradient-text { white-space: normal; }
        .hero p { font-size: 0.92rem; }
        .hero-buttons { flex-direction: column; align-items: center; width: 100%; max-width: 340px; margin: 0 auto; }
        .hero-buttons .btn-primary-custom,
        .hero-buttons .btn-outline-custom { width: 100%; justify-content: center; padding: 0.75rem 1.5rem; font-size: 0.88rem; }
        .hero::before { width: 280px; height: 280px; }
        
        .timeline-card { padding: 0.85rem; }
        .timeline-card h3 { font-size: 0.88rem; }
        .timeline-company { font-size: 0.72rem; margin-bottom: 0.4rem; }
        .timeline-card p { font-size: 0.72rem; line-height: 1.5; }
        .timeline-date { font-size: 0.62rem; padding: 0.15rem 0.6rem; }
        .current-badge { font-size: 0.5rem; padding: 0.15rem 0.5rem; }
        .timeline-location { font-size: 0.68rem; }


        .projects-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .pj-artifact { height: 140px; }
        .project-card .card-body { padding: 0.8rem 0.8rem 0.95rem; }
        .project-card .card-body h3 { font-size: 1rem; }
        .pkg-grid { display: block !important; gap: unset; width: 100% !important; }
        .pkg-card { width: 100% !important; min-width: 0 !important; display: flex; max-width: none !important; }
        .pkg-card + .pkg-card { margin-top: 1rem; }
        .term-body { font-size: 0.72rem; padding: 0.85rem 0.8rem 1rem; }
        .term-price { font-size: 1.35rem; }
        .term-val { font-size: 0.8rem; }
        .pkg-action { margin-left: 0.85rem; margin-right: 0.85rem; padding: 0.65rem 0.85rem; font-size: 0.82rem; }
        .filter-tabs { justify-content: flex-start; overflow-x: auto; flex-wrap: nowrap; padding-bottom: 0.5rem; -webkit-overflow-scrolling: touch; }
        .filter-tabs::-webkit-scrollbar { height: 2px; }
        .filter-tabs::-webkit-scrollbar-thumb { background: rgba(59,130,246,0.3); border-radius: 2px; }
        .filter-btn { flex-shrink: 0; }
        
        .testimonial-text { font-size: 0.84rem; }
        .tst-hash { display: none; }
        .tst-review { padding: 0.7rem 0.8rem; }
        .carousel-btn { width: 38px; height: 38px; font-size: 0.9rem; }
        .carousel-dots .dot { width: 8px; height: 8px; }
        .carousel-dots .dot.active { width: 22px; }
        
        .contact-grid { gap: 2rem; }
        .contact-form { padding: 1.4rem; }
        .contact-info h3 { font-size: 1.2rem; }
        .contact-item { padding: 0.8rem; }
        .contact-item .icon-box { width: 38px; height: 38px; font-size: 1rem; }
        .contact-item .text .value { font-size: 0.82rem; }
        .form-group label { font-size: 0.8rem; }
        .form-group input, .form-group textarea { padding: 0.75rem 1rem; font-size: 0.85rem; }
        .btn-submit { padding: 0.85rem; font-size: 0.88rem; }
        
        .whatsapp-tooltip { display: none; }
        .whatsapp-float { width: 44px; height: 44px; font-size: 1.2rem; bottom: 1rem; left: 1rem; }
        .admin-float-btn { width: 38px; height: 38px; font-size: 0.9rem; bottom: 4rem; right: 1rem; border-radius: 10px; }
        
        .map-container iframe { height: 220px; }
        .map-wrapper { margin-top: 2rem; }
        
        .footer { padding: 2rem 1rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 0.8rem; flex-direction: column; align-items: center; }
        .footer-bottom { flex-direction: column; gap: 0.4rem; text-align: center; }
        .footer p, .footer-bottom p, .footer-bottom span { font-size: 0.78rem; }
        .social-icon { width: 36px; height: 36px; font-size: 0.95rem; }
        .back-top { font-size: 0.75rem; }
        
        .toast { font-size: 0.8rem; padding: 0.7rem 1.2rem; max-width: 85%; bottom: 1.2rem; }
        .empty-state { padding: 2rem 1rem; }
        .empty-state i { font-size: 2rem; }
        .empty-state .fw-semibold.fs-5 { font-size: 1rem !important; }
        
        .scroll-progress { height: 2px; }
        
        /* Disable some heavy animations on mobile */
        #particles-canvas { display: none; }
        .magnetic { transition: none !important; }
        .project-card { transform: none !important; }
        .project-card:hover { transform: translateY(-4px) !important; }
        
        /* Hero decorative responsive */
        .code-grid-bg { display: none; }
        .code-fragment { display: none; }
        .float-chip { display: none; }

        /* Extra size reductions for very small screens */
        .hero-content { max-width: 100%; }
        .hero-badge { font-size: 0.7rem; padding: 0.3rem 0.8rem; }
        .btn-primary-custom, .btn-outline-custom { font-size: 0.82rem; padding: 0.65rem 1.5rem; }
    }
    
    /* Very Small Screens (max 360px) */
    @media (max-width: 360px) {
        html { font-size: 13px; }
        .hero h1 { font-size: 1.5rem; }
        .hero { padding: 2.75rem 0.75rem 1.2rem; min-height: auto; }
        .hero p { font-size: 0.82rem; }
        .hero-badge { font-size: 0.65rem; padding: 0.2rem 0.6rem; }
        .btn-primary-custom, .btn-outline-custom { font-size: 0.78rem; padding: 0.55rem 1.2rem; }
    }

    </style>
    <!-- Custom Cursor -->
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Particles Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Hero Section -->
    <section class="hero" id="hero">
        <!-- Aurora Color Glows -->
        <div class="hero-aurora"></div>

        <!-- Code Grid Background -->
        <div class="code-grid-bg"></div>

        <!-- Scan Beam Sweep -->
        <div class="hero-scan"></div>

        <!-- Holographic Field (falling code glyphs + orbit ring + horizon grid) -->
        <canvas id="hero-canvas"></canvas>

        <!-- Floating Code Fragments -->
        <div class="code-fragment f1">&lt;?php</div>
        <div class="code-fragment f2">const <b>dev</b> = {</div>
        <div class="code-fragment f3">function() =&gt; {</div>
        <div class="code-fragment f4">}</div>
        <div class="code-fragment f5">return <em>true</em>;</div>
        <div class="code-fragment f6">// keep shipping</div>

        <!-- Floating Chips -->
        <div class="float-chip c1"><i class="bi bi-code-slash"></i> Clean &amp; Scalable Code</div>
        <div class="float-chip c2"><i class="bi bi-git"></i> git commit -m "keep shipping"</div>
        <div class="float-chip c3"><i class="bi bi-cpu-fill"></i> PHP &middot; Laravel &middot; MySQL</div>
        <div class="float-chip c4"><i class="bi bi-lightning-fill"></i> REST API &middot; Optimization</div>
        <div class="float-chip c5"><i class="bi bi-shield-lock-fill"></i> Secure &amp; Scalable Apps</div>

        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-code-slash"></i> <span class="shimmer-text">{{ __('messages.hero_badge') }}</span></div>
            <h1>{{ __('messages.hero_greeting') }}<br><span class="gradient-text">{{ optional($account)->name ?? 'Portfolio' }}</span></h1>
            <p>{{ __('messages.hero_tagline') }}</p>
            <div class="hero-buttons">
                <a href="#projects" class="btn-primary-custom magnetic">
                    <i class="bi bi-rocket-fill"></i> {{ __('messages.see_my_work') }}
                </a>
                <a href="#contact" class="btn-outline-custom magnetic">
                    <i class="bi bi-chat-dots-fill"></i> {{ __('messages.contact_me') }}
                </a>
            </div>

        </div>
        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
        </div>
    </section>

<!-- About Section -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-git"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> about.git</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'about.git',
                'hTag' => 'repo',
                'hCmd' => 'git log --oneline -1',
                'hTitle' => __('messages.about_title'),
                'hTime' => '0.18s',
                'hRight' => __('messages.avail_for_work'),
                'hTests' => [__('messages.about_subtitle')],
            ])

            <div class="about-shell reveal reveal-delay-1" id="aboutWorkbench">
                <span class="ab-chip c1"><i class="bi bi-code-slash"></i> Laravel</span>
                <span class="ab-chip c2"><i class="fa-brands fa-php"></i> PHP</span>
                <span class="ab-chip c3"><i class="bi bi-braces"></i> React</span>
                <span class="ab-chip c4"><i class="bi bi-database"></i> MySQL</span>

                <div class="gl-wb">
                    <!-- Title bar -->
                    <div class="gl-bar">
                        <span class="ab-dot red"></span>
                        <span class="ab-dot yellow"></span>
                        <span class="ab-dot green"></span>
                        <span class="gl-repo"><i class="bi bi-git"></i> ~/developer.git</span>
                        <span class="gl-branch"><i class="bi bi-diagram-3"></i> main</span>
                        <span class="gl-avail"><span class="ab-dot2"></span> {{ __('messages.avail_for_work') }}</span>
                    </div>

                    <!-- Command (typed by JS) -->
                    <div class="gl-cmd">
                        <span class="gl-prompt">&#10095;</span>
                        <span class="gl-cmd-text" data-cmd="git log --graph --decorate --stat"></span><span class="gl-caret"></span>
                    </div>

                    <!-- Commit log -->
                    <div class="gl-body">
                        <div class="gl-commits">

                            <!-- commit 1 : identity -->
                            <article class="gl-commit" style="--i: 0">
                                <span class="gl-node" aria-hidden="true"></span>
                                <div class="gl-card">
                                    <div class="gl-head">
                                        <span class="gl-hash" data-hash="a1b2c3d">a1b2c3d</span>
                                        <span class="gl-ref">HEAD &rarr; main</span>
                                        <span class="gl-msg"><span class="gl-ty feat">feat</span>(profile): introduce {{ optional($account)->name ?? 'developer' }}</span>
                                        <span class="gl-stat"><b>+18</b><i>-2</i></span>
                                    </div>
                                    <div class="gl-diff">
                                        <div class="gl-hunk">@@ -1,6 +1,8 @@ developer.json</div>
                                        <div class="gl-user">
                                            <span class="gl-avatar">
                                                @if(optional($account)->image)
                                                    <img src="{{ config('app.storage_url') }}{{ $account->image }}" alt="{{ optional($account)->name ?? 'Portfolio' }}">
                                                @else
                                                    <span class="gl-initial">{{ mb_strtoupper(mb_substr(optional($account)->name ?? 'Portfolio', 0, 1)) }}</span>
                                                @endif
                                            </span>
                                            <div class="gl-id">
                                                <div class="gl-name-line">
                                                    <h3 class="gl-name">{{ optional($account)->name ?? 'Portfolio' }}</h3>
                                                    <i class="bi bi-patch-check-fill gl-verify"></i>
                                                </div>
                                                <span class="gl-role">{{ __('messages.about_heading') }}</span>
                                                <span class="gl-at"><i class="bi bi-envelope-fill"></i>@if(optional($account)->email)<a href="mailto:{{ $account->email }}" class="gl-mail">{{ $account->email }}</a>@else{{ '@' . mb_strtolower(str_replace(' ', '', optional($account)->name ?? 'developer')) }}@endif</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- commit 2 : about + stack -->
                            <article class="gl-commit" style="--i: 1">
                                <span class="gl-node" aria-hidden="true"></span>
                                <div class="gl-card">
                                    <div class="gl-head">
                                        <span class="gl-hash" data-hash="7f4e91a">7f4e91a</span>
                                        <span class="gl-msg"><span class="gl-ty docs">docs</span>(about): describe what I build</span>
                                        <span class="gl-stat"><b>+12</b><i>-0</i></span>
                                    </div>
                                    <div class="gl-diff">
                                        <div class="gl-hunk">@@ -8,4 +8,9 @@ about.md</div>
                                        <div class="gl-tags">
                                            <span class="gl-tag">Laravel</span>
                                            <span class="gl-tag">PHP</span>
                                            <span class="gl-tag">MySQL</span>
                                            <span class="gl-tag">JavaScript</span>
                                            <span class="gl-tag">Git</span>
                                        </div>
                                        <div class="gl-bio">
                                            <p class="gl-desc">{{ __('messages.about_desc_1') }}</p>
                                            <p class="gl-desc">{{ __('messages.about_desc_2') }}</p>
                                            <p class="gl-desc-short">{{ __('messages.about_desc_short') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- commit 3 : impact metrics -->
                            <article class="gl-commit" style="--i: 2">
                                <span class="gl-node" aria-hidden="true"></span>
                                <div class="gl-card">
                                    <div class="gl-head">
                                        <span class="gl-hash" data-hash="3c9d0b5">3c9d0b5</span>
                                        <span class="gl-msg"><span class="gl-ty chore">chore</span>(metrics): update impact numbers</span>
                                        <span class="gl-stat"><b>+6</b><i>-6</i></span>
                                    </div>
                                    <div class="gl-diff">
                                        <div class="gl-hunk">@@ -20,3 +20,6 @@ stats.json</div>
                                        <div class="gl-metrics">
                                            <div class="gl-metric">
                                                <span class="metric-ico"><i class="bi bi-folder2-open"></i></span>
                                                <span class="number" data-count="50">0</span>
                                                <span class="metric-key">{{ __('messages.stat_projects') }}</span>
                                                <span class="metric-bar"><span class="metric-fill" style="--w: 92%"></span></span>
                                            </div>
                                            <div class="gl-metric">
                                                <span class="metric-ico"><i class="bi bi-people"></i></span>
                                                <span class="number" data-count="30">0</span>
                                                <span class="metric-key">{{ __('messages.stat_clients') }}</span>
                                                <span class="metric-bar"><span class="metric-fill" style="--w: 85%"></span></span>
                                            </div>
                                            <div class="gl-metric">
                                                <span class="metric-ico"><i class="bi bi-award"></i></span>
                                                <span class="number" data-count="5">0</span>
                                                <span class="metric-key">{{ __('messages.stat_years') }}</span>
                                                <span class="metric-bar"><span class="metric-fill" style="--w: 80%"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- commit 4 : resume, socials & availability -->
                            <article class="gl-commit" style="--i: 3">
                                <span class="gl-node" aria-hidden="true"></span>
                                <div class="gl-card">
                                    <div class="gl-head">
                                        <span class="gl-hash" data-hash="e5a0721">e5a0721</span>
                                        <span class="gl-msg"><span class="gl-ty build">build</span>(contact): ship resume &amp; channels</span>
                                        <span class="gl-stat"><b>+9</b><i>-1</i></span>
                                    </div>
                                    <div class="gl-diff">
                                        <div class="gl-hunk">@@ -30,3 +30,9 @@ contact.yml</div>

                                        @if(isset($account) && $account->cv)
                                            <a href="{{ config('app.storage_url') }}{{ $account->cv }}" download class="gl-cv magnetic">
                                                <span class="gl-cv-prompt">$</span>
                                                <span>{{ __('messages.download_cv') }}</span>
                                                <span class="gl-cv-badge"><i class="bi bi-filetype-pdf"></i> PDF</span>
                                            </a>
                                        @endif

                                        @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
                                            <div class="gl-socials">
                                                <span class="gl-socials-label"><i class="bi bi-link-45deg"></i> // {{ __('messages.connect') }}</span>
                                                <div class="gl-socials-row">
                                                    @if(isset($account) && $account->github)
                                                        <a href="{{ $account->github }}" target="_blank" class="gl-social-link" aria-label="GitHub"><i class="bi bi-github"></i></a>
                                                    @endif
                                                    @if(isset($account) && $account->linkedin)
                                                        <a href="{{ $account->linkedin }}" target="_blank" class="gl-social-link" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                                    @endif
                                                    @if(isset($account) && $account->facebook)
                                                        <a href="{{ $account->facebook }}" target="_blank" class="gl-social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                                    @endif
                                                    @if(isset($account) && $account->instagram)
                                                        <a href="{{ $account->instagram }}" target="_blank" class="gl-social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                                    @endif
                                                    @if(isset($account) && $account->twitter)
                                                        <a href="{{ $account->twitter }}" target="_blank" class="gl-social-link" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                                    @endif
                                                    @if(isset($account) && $account->youtube)
                                                        <a href="{{ $account->youtube }}" target="_blank" class="gl-social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($account) && ($account->fiverr || $account->upwork || $account->freelancer))
                                            <div class="gl-hire">
                                                <div class="gl-hire-head">
                                                    <span class="gl-hire-label"><i class="bi bi-briefcase-fill"></i> {{ __('messages.hire_me') }}</span>
                                                    <span class="gl-hire-tag"><i class="bi bi-lightning-fill"></i> {{ __('messages.avail_for_work') }}</span>
                                                </div>
                                                <div class="gl-hire-row">
                                                    @if(isset($account) && $account->fiverr)
                                                        <a href="{{ $account->fiverr }}" target="_blank" class="gl-freelance fiverr" aria-label="Fiverr">
                                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg>
                                                            Fiverr
                                                        </a>
                                                    @endif
                                                    @if(isset($account) && $account->upwork)
                                                        <a href="{{ $account->upwork }}" target="_blank" class="gl-freelance upwork" aria-label="Upwork"><i class="fab fa-upwork"></i> Upwork</a>
                                                    @endif
                                                    @if(isset($account) && $account->freelancer)
                                                        <a href="{{ $account->freelancer }}" target="_blank" class="gl-freelance freelancer" aria-label="Freelancer"><i class="fas fa-user-tie"></i> Freelancer</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>

                    <!-- Status bar -->
                    <div class="gl-foot">
                        <span><i class="bi bi-git"></i> git status -sb</span>
                        <span class="gl-foot-ok"><i class="bi bi-check2-circle"></i> working tree clean</span>
                        <span class="gl-foot-right">4 commits &middot; 1 branch &middot; main</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Services Section -->
    <section class="services-section section-padding" id="services">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> services.php</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'services.php',
                'hTag' => 'api',
                'hCmd' => 'php artisan route:list',
                'hTitle' => __('messages.services_title'),
                'hTime' => '0.24s',
                'hRight' => $services->count() . ' ' . __('messages.services_title'),
                'hTests' => [__('messages.services_subtitle')],
            ])

            @if($services->isNotEmpty())
                <div class="svc-grid">
                    @foreach($services as $index => $service)
                        @php
                            $delay = ($index % 2) + 1;
                            $routeSlug = \Illuminate\Support\Str::slug($service->title ?: 'service');
                            $routeSlug = $routeSlug !== '' ? $routeSlug : 'service';
                            $routePath = '/api/services/' . $routeSlug;
                            $compileMs = rand(8, 25);
                        @endphp
                        <div class="svc-card reveal reveal-delay-{{ $delay }}">
                            <div class="svc-card-bar">
                                <span class="ab-dot red"></span>
                                <span class="ab-dot yellow"></span>
                                <span class="ab-dot green"></span>
                                <span class="svc-filename">service-{{ $index + 1 }}.http</span>
                                <span class="svc-method">POST</span>
                            </div>

                            <div class="svc-card-body">
                                <span class="svc-sweep" aria-hidden="true"></span>

                                <div class="svc-route">
                                    <span class="svc-method-chip">POST</span>
                                    <span class="svc-path" data-path="{{ $routePath }}">{{ $routePath }}</span><span class="svc-cursor"></span>
                                </div>

                                <div class="svc-main">
                                    <div class="svc-card-icon">
                                        <i class="bi {{ $service->icon ?: 'bi-star' }}"></i>
                                    </div>
                                    <div class="svc-copy">
                                        <h3 class="svc-card-title">{{ $service->title }}</h3>
                                        @if($service->short_description)
                                            <p class="svc-card-desc">{{ $service->short_description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="svc-card-foot">
                                <span class="svc-resp">
                                    <span class="svc-resp-code">200 OK</span>
                                    <span class="svc-resp-meta">application/json &middot; {{ $compileMs }}ms</span>
                                </span>
                                <span class="svc-foot-status"><span class="sv-status-ok"><span class="sv-dot"></span> ready to help</span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-gear"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_services') }}</p>
                    <p>{{ __('messages.no_services_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Gigs Section -->
    @if($gigs->isNotEmpty())
    <section class="gigs-section section-padding" id="gigs">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> pricing.sh</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'pricing.sh',
                'hTag' => 'sh',
                'hCmd' => './install --list-plans',
                'hTitle' => __('messages.gigs_title'),
                'hTime' => '0.31s',
                'hRight' => $gigs->count() . ' ' . __('messages.gigs_title'),
                'hTests' => [__('messages.gigs_subtitle')],
            ])
            <div class="pkg-grid">
                @foreach($gigs as $index => $gig)
                    @php
                        $delay = ($index % 3) + 1;
                        $pkgName = \Illuminate\Support\Str::slug($gig->title ?: 'plan');
                        $pkgName = $pkgName !== '' ? $pkgName : 'plan';
                        $priceVal = (float) $gig->basic_price;
                        $priceLabel = rtrim(rtrim(number_format($priceVal, 2, '.', ''), '0'), '.');
                        $isWhole = ($priceVal == floor($priceVal));
                        $items = [];
                        if ($gig->short_description) {
                            $chunks = preg_split('/[,;]+|\r\n|\r|\n/', $gig->short_description);
                            $items = array_slice(array_values(array_filter(array_map('trim', $chunks))), 0, 4);
                        }
                        $runtime = number_format(0.8 + ($index * 0.4), 1);
                    @endphp
                    <div class="pkg-card reveal reveal-delay-{{ $delay }}">
                        <div class="pkg-card-bar">
                            <span class="ab-dot red"></span>
                            <span class="ab-dot yellow"></span>
                            <span class="ab-dot green"></span>
                            <span class="pkg-filename">{{ $pkgName }}.sh</span>
                            <span class="pkg-ver">v1.0.{{ $index }}</span>
                        </div>

                        <div class="term-body">
                            <div class="term-line term-cmd" data-term>
                                <span class="term-prompt">$</span>
                                <span class="term-type" data-cmd="npm install {{ $pkgName }}"></span><span class="term-caret"></span>
                            </div>

                            <div class="term-line term-prog" data-term>
                                <span>resolving deps</span>
                                <span class="term-bar"><span class="term-bar-fill"></span></span>
                                <span class="term-prog-ok"><i class="bi bi-check-lg"></i></span>
                            </div>

                            <div class="term-line term-out" data-term>
                                <span class="term-key">plan</span>
                                <span class="term-dots"></span>
                                <span class="term-val">{{ $gig->title }}</span>
                            </div>

                            <div class="term-line term-out" data-term>
                                <span class="term-key">price</span>
                                <span class="term-dots"></span>
                                <span class="term-val term-price"@if($isWhole) data-price="{{ (int) $priceVal }}"@endif><span class="term-amount">${{ $priceLabel }}</span><em>USD</em></span>
                            </div>

                            @if(count($items))
                                <div class="term-line term-includes" data-term>
                                    <span class="term-key">includes</span>
                                    <ul class="term-items">
                                        @foreach($items as $item)
                                            <li><i class="bi bi-check-circle-fill"></i><span>{{ $item }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="term-line term-exit" data-term>
                                <i class="bi bi-check-lg"></i>
                                <span>{{ $pkgName }}@1.0.{{ $index }} installed in {{ $runtime }}s</span>
                            </div>

                            <span class="term-scan" aria-hidden="true"></span>
                        </div>

                        <a href="{{ route('gig.detail', $gig->id) }}" class="pkg-action">
                            <span class="pkg-run-label"><i class="bi bi-terminal-fill"></i> {{ __('messages.pkg_choose') }}</span>
                            <span class="pkg-arrow"><i class="bi bi-arrow-right"></i></span>
                        </a>

                        <div class="pkg-foot">
                            <span class="pkg-status"><span class="sv-dot"></span> available</span>
                            <span class="pkg-lang">exit code 0</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Coding Showcase Section -->
    <section class="coding-showcase-section section-padding" id="case-studies">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> case-studies.ts</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'case-studies.spec.ts',
                'hTag' => 'suite',
                'hCmd' => 'npm test -- case-studies.spec.ts',
                'hTitle' => __('messages.casestudy_title'),
                'hTime' => '0.42s',
                'hRight' => $caseStudies->count() . ' ' . __('messages.casestudy_title'),
                'hTests' => [__('messages.casestudy_subtitle')],
                'hSumRight' => 'snapshots: 0 failed',
            ])

            @if($caseStudies->isNotEmpty())
                <div class="coding-grid cs-grid">
                    @foreach($caseStudies as $index => $case)
                        @php
                            $fileSlug = \Illuminate\Support\Str::slug($case->title ?: 'case-study');
                            $fileSlug = $fileSlug !== '' ? $fileSlug : 'case-study';
                            $delay = ($index % 3) + 1;
                        @endphp
                        <a href="{{ route('case-study.detail', $case->id) }}"
                           class="coding-card casestudy-card reveal reveal-delay-{{ $delay }}">
                            <div class="coding-header">
                                <div class="coding-dots">
                                    <span class="dot red"></span>
                                    <span class="dot yellow"></span>
                                    <span class="dot green"></span>
                                </div>
                                <div class="coding-title">{{ $fileSlug }}.md</div>
                                <div class="coding-actions">
                                    <span class="branch-badge">{{ $case->category ?: 'main' }}</span>
                                </div>
                            </div>
                            <div class="cs-body">
                                <span class="cs-scan" aria-hidden="true"></span>
                                <div class="cs-cmd-line">
                                    <span class="cs-prompt">&#10095;</span>
                                    <span class="cs-cmd" data-cmd="cat {{ $fileSlug }}.md"></span><span class="cs-caret"></span>
                                </div>

                                @if($case->image)
                                    <div class="cs-thumb">
                                        <img src="{{ config('app.storage_url') }}{{ $case->image }}" alt="{{ $case->title }}" loading="lazy">
                                    </div>
                                @endif

                                <h3 class="cs-title">{{ $case->title }}</h3>

                                @if($case->client)
                                    <div class="cs-client"><i class="bi bi-building"></i> {{ $case->client }}</div>
                                @endif

                                <div class="cs-lines">
                                    @if($case->problem)
                                        <div class="cs-line">
                                            <span class="cs-key">// {{ __('messages.problem') }}</span>
                                            <p>{{ \Illuminate\Support\Str::limit($case->problem, 120) }}</p>
                                        </div>
                                    @endif
                                    @if($case->solution)
                                        <div class="cs-line">
                                            <span class="cs-key">// {{ __('messages.solution') }}</span>
                                            <p>{{ \Illuminate\Support\Str::limit($case->solution, 120) }}</p>
                                        </div>
                                    @endif
                                    @if($case->result)
                                        <div class="cs-line cs-line-ok">
                                            <span class="cs-key">// {{ __('messages.result') }}</span>
                                            <p>{{ \Illuminate\Support\Str::limit($case->result, 120) }}</p>
                                        </div>
                                    @endif
                                </div>

                                @if(!empty($case->tech_list))
                                    <div class="cs-tech">
                                        @foreach($case->tech_list as $tech)
                                            <span class="cs-tag">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="cs-foot">
                                <span class="cs-status"><span class="sv-dot"></span> build passing</span>
                                <span class="cs-open">{{ __('messages.view_project') }} <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-journal-code"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_casestudy') }}</p>
                    <p>{{ __('messages.no_casestudy_desc') }}</p>
                </div>
            @endif
            <div class="csh csh-cta reveal" data-csh>
                <div class="csh-bar">
                    <span class="ab-dot red"></span>
                    <span class="ab-dot yellow"></span>
                    <span class="ab-dot green"></span>
                    <span class="csh-file"><i class="bi bi-terminal"></i> ~/portfolio</span>
                    <span class="csh-tag">sh</span>
                    <span class="csh-right"><span class="ab-dot2"></span> {{ __('messages.avail_for_work') }}</span>
                </div>

                <div class="csh-cmd">
                    <span class="csh-prompt">&#10095;</span>
                    <span class="csh-cmd-text" data-cmd="./next --start-project"></span><span class="csh-caret"></span>
                </div>

                <div class="csh-body">
                    <p class="csh-cta-text csh-anim" style="--d: 0">{{ __('messages.casestudy_cta') }}</p>

                    <div class="csh-actions csh-anim" style="--d: 1">
                        <a href="#contact" class="btn-primary-custom"><i class="bi bi-rocket-takeoff"></i> {{ __('messages.start_project') }}</a>
                        <a href="#projects" class="btn-outline-custom"><i class="bi bi-code-slash"></i> {{ __('messages.projects_title') }}</a>
                    </div>

                    <div class="csh-summary csh-anim" style="--d: 2">
                        <span><i class="bi bi-check2-circle"></i> exit code 0</span>
                        <!-- Experience Section — DEBUG PROFILER DESIGN -->
    <section class="timeline-section section-padding" id="experience">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> experience.ts</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'experience.ts',
                'hTag' => 'module',
                'hCmd' => 'npx ts-node experience.ts',
                'hTitle' => __('messages.experience_title'),
                'hTime' => '0.15s',
                'hRight' => $experiences->count() . ' ' . __('messages.experience_title'),
                'hTests' => [__('messages.experience_subtitle')],
            ])

            @if($experiences->isNotEmpty())
                <div class="profiler reveal">
                    <div class="profiler-header">
                        <i class="bi bi-activity"></i>
                        <span class="prof-title">Performance Profiler</span>
                        <span>{{ $experiences->count() }} tasks traced</span>
                        <span class="prof-count"><i class="bi bi-circle-fill" style="font-size:0.35rem; vertical-align:middle"></i> profiling</span>
                    </div>
                    <div class="prof-col-head">
                        <span>#</span>
                        <span>task</span>
                        <span>duration</span>
                    </div>

                    @foreach($experiences as $index => $exp)
                        @php
                            $expBullets = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|;/', (string) $exp->description)), function ($line) {
                                return $line !== '';
                            }));
                            $expBullets = array_slice($expBullets, 0, 4);
                            $barWidth = max(30, 100 - ($index * 18));
                        @endphp
                        <div class="prof-row" style="--bar-w: {{ $barWidth }}%">
                            <span class="prof-ln">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="prof-card">
                                <div class="prof-card-head">
                                    <span class="prof-role">{{ $exp->position }}</span>
                                    @if($exp->is_current)
                                        <span class="prof-status running"><i class="bi bi-circle-fill" style="font-size:0.4rem"></i> active</span>
                                    @else
                                        <span class="prof-status done">completed</span>
                                    @endif
                                </div>
                                <div class="prof-company-row">
                                    <i class="bi bi-building"></i>
                                    <span>{{ $exp->company }}</span>
                                    @if($exp->location)
                                        <span class="prof-sep">/</span>
                                        <span class="prof-location"><i class="bi bi-geo-alt"></i> {{ $exp->location }}</span>
                                    @endif
                                </div>
                                <div class="prof-timing">
                                    <span class="prof-timing-label">elapsed</span>
                                    <div class="prof-timing-bar"><div class="prof-timing-fill"></div></div>
                                    <span class="prof-timing-val">{{ $exp->duration }}</span>
                                </div>
                                @if($exp->description)
                                    <div class="prof-desc">
                                        @if(count($expBullets) > 1)
                                            @foreach($expBullets as $expBullet)
                                                <span class="prof-desc-gutter">+</span>{{ $expBullet }}<br>
                                            @endforeach
                                        @else
                                            <span class="prof-desc-gutter">//</span>{{ $exp->description }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="prof-duration">
                                <i class="bi bi-clock"></i> {{ $exp->duration }}
                            </div>
                        </div>
                    @endforeach

                    <div class="prof-footer">
                        <span><i class="bi bi-check2-all"></i> all tasks completed</span>
                        <span class="prof-footer-right">total: {{ $experiences->count() }} entries</span>
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-briefcase"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_experience') }}</p>
                    <p>{{ __('messages.no_experience_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Education Qualification Section -->
    <section class="section-padding" id="education"
        style="background: linear-gradient(180deg, var(--bg-secondary) 0%, #080d1a 100%);">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> education.ts</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'education.ts',
                'hTag' => 'module',
                'hCmd' => 'npx ts-node education.ts',
                'hTitle' => __('messages.education_title'),
                'hTime' => '0.12s',
                'hRight' => $educations->count() . ' ' . __('messages.education_title'),
                'hTests' => [__('messages.education_subtitle')],
            ])

            @if($educations->isNotEmpty())
                <div class="edu-grid" id="educationGrid">
                    @foreach($educations as $index => $edu)
                        @php
                            $eduPercent = null;
                            if (preg_match('/(\d+(?:\.\d+)?)\s*(?:\/|out of)\s*(\d+(?:\.\d+)?)/i', (string) $edu->result, $eduMatch) && (float) $eduMatch[2] > 0) {
                                $eduPercent = (int) max(0, min(100, round(((float) $eduMatch[1] / (float) $eduMatch[2]) * 100)));
                            }
                        @endphp
                        <article class="edu-card" style="--i: {{ $index }}">
                            <div class="edu-bar" aria-hidden="true"></div>

                            <div class="edu-head">
                                <span class="edu-dots" aria-hidden="true"><i></i><i></i><i></i></span>
                                <span class="edu-file"><i class="bi bi-filetype-tsx"></i> education-{{ $index + 1 }}.ts</span>
                                <span class="edu-status"><i class="bi bi-check2"></i> published</span>
                            </div>

                            <div class="edu-code">
                                <div class="edu-lines">
                                    <div class="edu-line"><span class="edu-key">degree</span><span class="edu-punc">:</span> <span class="edu-str">"{{ $edu->degree_name }}"</span><span class="edu-punc">,</span></div>
                                    <div class="edu-line"><span class="edu-key">institution</span><span class="edu-punc">:</span> <span class="edu-str">"{{ $edu->institution }}"</span><span class="edu-punc">,</span></div>
                                    @if($edu->board_or_university)
                                        <div class="edu-line"><span class="edu-key">board</span><span class="edu-punc">:</span> <span class="edu-str">"{{ $edu->board_or_university }}"</span><span class="edu-punc">,</span></div>
                                    @endif
                                    <div class="edu-line"><span class="edu-key">duration</span><span class="edu-punc">:</span> <span class="edu-str">"{{ $edu->duration }}"</span><span class="edu-punc">,</span></div>
                                </div>
                            </div>

                            <div class="edu-foot">
                                @if($edu->result)
                                    <span class="edu-result"><i class="bi bi-award"></i> {{ $edu->result }}</span>
                                @else
                                    <span class="edu-done"><i class="bi bi-check2-circle"></i> completed</span>
                                @endif

                                @if($eduPercent !== null)
                                    <span class="edu-gauge">
                                        <span class="edu-gauge-bar"><span class="edu-gauge-fill" style="--w: {{ $eduPercent }}%"></span></span>
                                        <span class="edu-gauge-num">{{ $eduPercent }}%</span>
                                    </span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-mortarboard"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_education') }}</p>
                    <p>{{ __('messages.no_education_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <style>
    /* ===== EDUCATION - COMPILED MODULES (coding design) ===== */
    html.light-theme #education {
        background: linear-gradient(180deg, #eef2f7 0%, #f1f5f9 100%) !important;
    }

    /* Flex + centred so a lone card (or a last odd one) sits in the middle */
    .edu-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.35rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    .edu-card {
        flex: 1 1 400px;
        max-width: 470px;
        background: rgba(255,255,255,0.04) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(99,102,241,0.15) !important;
        border-radius: var(--radius-lg);
        position: relative;
        overflow: hidden;
        font-family: 'Cascadia Code', ui-monospace, Consolas, Menlo, monospace;
        transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.4s ease, box-shadow 0.4s ease;
    }
    html.light-theme .edu-card {
        background: rgba(255,255,255,0.7) !important;
        border-color: rgba(99,102,241,0.2) !important;
    }
    .edu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59,130,246,0.5) 0%, rgba(59,130,246,0.15) 30%, transparent 60%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 1;
        border-radius: inherit;
    }
    html.light-theme .edu-card::before {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(59,130,246,0.35) 0%, rgba(59,130,246,0.1) 30%, transparent 60%);
    }
    .edu-card:hover::before { opacity: 1; }
    .edu-card:hover {
        transform: translateY(-8px);
        border-color: rgba(99,102,241,0.4) !important;
        box-shadow: 0 0 30px rgba(59,130,246,0.25), var(--shadow-md);
    }
    html.light-theme .edu-card:hover {
        box-shadow: 0 0 30px rgba(59,130,246,0.15), var(--shadow-md);
    }
    .edu-card > * { position: relative; z-index: 2; }

    .edu-bar {
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #a78bfa, #6366f1);
        background-size: 200% 100%;
        animation: eduShimmer 3s ease-in-out infinite;
    }
    @keyframes eduShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* title bar */
    .edu-head {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.9rem;
        background: rgba(2, 8, 23, 0.28);
        border-bottom: 1px solid rgba(148, 163, 184, 0.14);
    }
    html.light-theme .edu-head { background: rgba(15, 23, 42, 0.04); border-bottom-color: rgba(15, 23, 42, 0.07); }
    .edu-dots { display: inline-flex; gap: 5px; flex-shrink: 0; }
    .edu-dots i { width: 9px; height: 9px; border-radius: 50%; display: block; }
    .edu-dots i:nth-child(1) { background: #ff5f57; }
    .edu-dots i:nth-child(2) { background: #febc2e; }
    .edu-dots i:nth-child(3) { background: #28c840; }
    .edu-file {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.7rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .edu-file i { color: #38bdf8; }
    html.light-theme .edu-file { color: #334155; }
    .edu-status {
        margin-left: auto; flex-shrink: 0;
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.3px;
        color: #34d399;
        transition: opacity 0.4s ease, transform 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.5);
    }

    /* code pane */
    .edu-code { padding: 0.85rem 0.95rem 0.9rem; background: rgba(2, 8, 23, 0.2); }
    html.light-theme .edu-code { background: rgba(15, 23, 42, 0.02); }
    .edu-lines { counter-reset: edu-line; position: relative; }
    .edu-line {
        position: relative;
        padding-left: 2.4rem;
        font-size: 0.78rem; line-height: 1.95;
        color: #e2e8f0;
        white-space: pre-wrap; word-break: break-word;
        transition: opacity 0.45s ease, transform 0.45s ease;
    }
    html.light-theme .edu-line { color: #1e293b; }
    .edu-line::before {
        counter-increment: edu-line;
        content: counter(edu-line);
        position: absolute; left: 0; top: 0; bottom: 0;
        width: 1.7rem;
        padding-right: 0.45rem;
        text-align: right;
        font-size: 0.7rem; color: #334155;
        border-right: 1px solid rgba(148, 163, 184, 0.16);
        user-select: none;
    }
    html.light-theme .edu-line::before { color: #cbd5e1; }
    .edu-key { color: #93c5fd; }
    html.light-theme .edu-key { color: #2563eb; }
    .edu-str { color: #86efac; }
    html.light-theme .edu-str { color: #047857; }
    .edu-punc { color: #94a3b8; }
    html.light-theme .edu-punc { color: #475569; }
    .edu-lines::after {
        content: '';
        display: block;
        width: 8px; height: 1em;
        margin: 0.25rem 0 0.1rem 2.4rem;
        background: #34d399; border-radius: 1px;
        box-shadow: 0 0 10px rgba(52, 211, 153, 0.7);
        animation: glBlink 1s step-end infinite;
    }

    /* status bar */
    .edu-foot {
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        padding: 0.6rem 0.95rem;
        background: rgba(2, 8, 23, 0.28);
        border-top: 1px solid rgba(148, 163, 184, 0.14);
        font-size: 0.68rem;
    }
    html.light-theme .edu-foot { background: rgba(15, 23, 42, 0.04); border-top-color: rgba(15, 23, 42, 0.07); }
    .edu-result {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; color: #f59e0b; font-weight: 700;
        background: rgba(245,158,11,0.1);
        border: 1px solid rgba(245,158,11,0.2);
        padding: 0.2rem 0.7rem; border-radius: 20px;
    }
    .edu-done { display: inline-flex; align-items: center; gap: 0.35rem; color: var(--text-muted); }
    .edu-done i { color: #34d399; }
    .edu-gauge { margin-left: auto; display: inline-flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }
    .edu-gauge-bar {
        width: 90px; height: 5px; border-radius: 50px;
        background: rgba(99, 102, 241, 0.16);
        overflow: hidden;
    }
    .edu-gauge-fill {
        display: block; height: 100%; width: 0;
        background: linear-gradient(90deg, #6366f1, #a78bfa, #22d3ee);
        background-size: 200% 100%;
        animation: eduShimmer 3s ease-in-out infinite;
        border-radius: 50px;
        transition: width 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.4s;
    }
    .edu-gauge-num { color: #a5b4fc; font-weight: 700; }
    html.light-theme .edu-gauge-num { color: #4f46e5; }
    html.light-theme .edu-status { color: #059669; }

    /* reveal (armed by JS so nothing hides without it) */
    .edu-grid.edu-armed .edu-card { opacity: 0; transform: translateY(22px); }
    .edu-grid.edu-armed .edu-line { opacity: 0; transform: translateY(6px); }
    .edu-grid.edu-armed .edu-status { opacity: 0; transform: scale(0.85); }
    .edu-grid.edu-ready .edu-card { opacity: 1; transform: translateY(0); transition-delay: calc(var(--i, 0) * 120ms); }
    .edu-grid.edu-ready .edu-line { opacity: 1; transform: translateY(0); }
    .edu-grid.edu-ready .edu-status { opacity: 1; transform: scale(1); transition-delay: 0.5s; }
    .edu-grid.edu-ready .edu-line:nth-child(1) { transition-delay: calc(var(--i, 0) * 120ms + 0.2s); }
    .edu-grid.edu-ready .edu-line:nth-child(2) { transition-delay: calc(var(--i, 0) * 120ms + 0.28s); }
    .edu-grid.edu-ready .edu-line:nth-child(3) { transition-delay: calc(var(--i, 0) * 120ms + 0.36s); }
    .edu-grid.edu-ready .edu-line:nth-child(4) { transition-delay: calc(var(--i, 0) * 120ms + 0.44s); }
    .edu-grid.edu-ready .edu-gauge-fill { width: var(--w, 0%); }
    /* keep the hover lift instant even during the staggered reveal */
    .edu-grid.edu-ready .edu-card:hover { transition-delay: 0s; }

    @media (max-width: 860px) {
        .edu-grid { max-width: 560px; }
    }
    @media (max-width: 480px) {
        .edu-line { font-size: 0.72rem; }
        .edu-line::before { width: 1.5rem; }
        .edu-line { padding-left: 2.1rem; }
        .edu-lines::after { margin-left: 2.1rem; }
        .edu-gauge-bar { width: 64px; }
        .edu-file { max-width: 12ch; }
    }
    @media (prefers-reduced-motion: reduce) {
        .edu-grid.edu-armed .edu-card,
        .edu-grid.edu-armed .edu-line,
        .edu-grid.edu-armed .edu-status { opacity: 1; transform: none; }
        .edu-bar, .edu-lines::after, .edu-gauge-fill { animation: none; }
        .edu-gauge-fill { width: var(--w, 0%); }
    }
    </style>

    <!-- Skills Section -->
    <section class="skills-section section-padding" id="skills">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> skills.ts</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'skills.ts',
                'hTag' => 'module',
                'hCmd' => 'npm run lint -- skills',
                'hTitle' => __('messages.skills_title'),
                'hTime' => '0.09s',
                'hRight' => $skills->count() . ' ' . __('messages.skills_title'),
                'hTests' => [__('messages.skills_subtitle')],
            ])

            @if($skills->isNotEmpty())
                <div class="sk-panel" data-sk-panel role="group" aria-label="{{ __('messages.skills_title') }}">
                    <div class="sk-bar">
                        <span class="edu-dots" aria-hidden="true"><i></i><i></i><i></i></span>
                        <span class="sk-file"><i class="bi bi-cpu"></i> skills.monitor</span>
                        <span class="sk-badge">{{ $skills->count() }} processes</span>
                        <span class="sk-live"><span class="sk-live-dot"></span> live</span>
                    </div>

                    <div class="sk-cmd">
                        <span class="sk-prompt">&#10095;</span>
                        <span class="sk-cmd-text" data-sk-cmd="top -n 1 -u skills --live"></span>
                        <span class="sk-caret" aria-hidden="true"></span>
                    </div>

                    <div class="sk-head" aria-hidden="true">
                        <span>PID</span>
                        <span>PROCESS</span>
                        <span>CPU</span>
                        <span>LOAD</span>
                        <span>STATE</span>
                    </div>

                    <div class="sk-rows">
                        @foreach($skills as $index => $skill)
                            <div class="sk-row" style="--i: {{ $index }}" data-sk-pct="{{ $skill->percentage }}">
                                <span class="sk-pid">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="sk-name"><i class="bi {{ $skill->icon ?: 'bi-star' }}"></i> {{ $skill->name }}</span>
                                <span class="sk-meter" aria-hidden="true">
                                    <span class="sk-meter-fill" style="--w: {{ $skill->percentage }}%"></span>
                                    <span class="sk-meter-sweep" style="--i: {{ $index }}"></span>
                                </span>
                                <span class="sk-pct">{{ $skill->percentage }}%</span>
                                <span class="sk-state">running</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="sk-foot">
                        <i class="bi bi-activity"></i>
                        <span>tick <b data-sk-tick>0</b></span>
                        <span>&middot; cpu avg <b data-sk-avg>{{ (int) round($skills->avg('percentage')) }}%</b></span>
                        <span class="sk-foot-right"><i class="bi bi-shield-check"></i> all systems nominal</span>
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-lightning-charge"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_skills') }}</p>
                    <p>{{ __('messages.no_skills_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects-section section-padding" id="projects">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> projects.jsx</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'projects.jsx',
                'hTag' => 'ui',
                'hCmd' => 'npm run build -- projects',
                'hTitle' => __('messages.projects_title'),
                'hTime' => '0.27s',
                'hRight' => $projects->count() . ' ' . __('messages.projects_title'),
                'hTests' => [__('messages.projects_subtitle')],
            ])
            <!-- Filter Buttons -->
            <div class="filter-tabs reveal">
                <button class="filter-btn active" data-filter="all">{{ __('messages.all') }}</button>
                @php
                    $allTechs = [];
                    foreach($projects as $p) {
                        foreach($p->getTechStackArray() as $t) {
                            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                            $allTechs[$slug] = $t;
                        }
                    }
                @endphp
                @foreach($allTechs as $slug => $label)
                    <button class="filter-btn" data-filter="{{ $slug }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="projects-grid">
                @forelse($projects as $index => $project)
                    @php
                        $techSlugs = [];
                        $techLabels = [];
                        foreach($project->getTechStackArray() as $t) {
                            $techSlugs[] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                            $techLabels[] = $t;
                        }
                        $gradients = [
                            'linear-gradient(135deg, #1e3a5f, #1a1a3e)',
                            'linear-gradient(135deg, #1e4040, #1a2e3e)',
                            'linear-gradient(135deg, #2e1e5f, #1a1a3e)',
                            'linear-gradient(135deg, #3a1e3e, #1a1a3e)',
                            'linear-gradient(135deg, #1e2a4f, #1a1a3e)',
                            'linear-gradient(135deg, #2e3a1e, #1a2a1e)',
                        ];
                        $icons = [
                            'bi bi-cart-fill',
                            'bi bi-palette-fill',
                            'bi bi-card-checklist',
                            'bi bi-phone-fill',
                            'bi bi-globe',
                            'bi bi-cpu-fill',
                        ];
                        $slug = \Illuminate\Support\Str::slug($project->title) ?: ('project-' . $project->id);
                        $buildCmd = './build ' . $slug . ' --prod';
                        $delay = ($index % 4) + 1;
                    @endphp
                    <a href="{{ route('project.detail', $project->id) }}" class="project-card reveal reveal-delay-{{ $delay }}" data-tech="{{ implode(' ', $techSlugs) }}">
                        <div class="pj-bar">
                            <span class="edu-dots" aria-hidden="true"><i></i><i></i><i></i></span>
                            <span class="pj-file"><i class="bi bi-git"></i> {{ $slug }}.build</span>
                            <span class="pj-status">passed</span>
                        </div>

                        <div class="pj-run">
                            <span class="pj-prompt" aria-hidden="true">&#10095;</span>
                            <span class="pj-cmd" data-pj-cmd="{{ $buildCmd }}">{{ $buildCmd }}</span>
                            <span class="pj-caret" aria-hidden="true"></span>
                        </div>

                        <div class="pj-steps" aria-hidden="true">
                            @foreach(['install', 'build', 'test', 'deploy'] as $s => $step)
                                <span class="pj-step" style="--s: {{ $s }}"><i class="bi bi-check2"></i> {{ $step }}</span>
                            @endforeach
                        </div>

                        <div class="pj-artifact" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($project->image)
                                <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                     alt="{{ $project->title }} screenshot">
                            @else
                                <span class="project-icon"><i class="{{ $icons[$index % count($icons)] }}"></i></span>
                            @endif
                            @if($project->category)<span class="pj-cat">{{ $project->category }}</span>@endif
                        </div>

                        <div class="card-body pj-body">
                            <h3>{{ $project->title }}</h3>
                            @if($techLabels)
                                <div class="pj-techs">
                                    @foreach(array_slice($techLabels, 0, 5) as $t)
                                        <span class="pj-tech">{{ $t }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pj-foot">
                            <span class="pj-exit"><i class="bi bi-check-circle"></i> exit code 0</span>
                            <span class="view-details-btn">{{ __('messages.view_project') }} <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-folder-plus"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_projects') }}</p>
                    <p>{{ __('messages.no_projects_desc') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding" id="testimonials">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> testimonials.ts</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'testimonials.ts',
                'hTag' => 'suite',
                'hCmd' => 'npm test -- testimonials.ts',
                'hTitle' => __('messages.testimonials_title'),
                'hTime' => '0.21s',
                'hRight' => $testimonials->count() . ' ' . __('messages.testimonials_title'),
                'hTests' => [__('messages.testimonials_subtitle')],
            ])

            @if($testimonials->isNotEmpty())
                <div class="testimonial-carousel reveal">
                    <div class="testimonial-track" id="testimonialTrack">
                        @foreach($testimonials as $testimonial)
                            @php
                                $rating = count(array_filter((array) $testimonial->stars));
                                $reviewId = substr(md5($testimonial->name . $testimonial->message), 0, 7);
                            @endphp
                            <div class="testimonial-card{{ $loop->first ? ' tst-in' : '' }}" data-tst>
                                <div class="tst-bar">
                                    <span class="edu-dots" aria-hidden="true"><i></i><i></i><i></i></span>
                                    <span class="tst-file"><i class="bi bi-git-pull-request"></i> review #{{ $reviewId }}</span>
                                    <span class="tst-hash">{{ $loop->iteration }}/{{ $testimonials->count() }}</span>
                                    <span class="tst-badge">approved</span>
                                </div>

                                <div class="tst-head">
                                    <div class="testimonial-author">
                                        <div class="author-avatar">
                                            @if($testimonial->avatar)
                                                <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                                     alt="{{ $testimonial->name }}">
                                            @else
                                                <div class="avatar-fallback">
                                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="author-info">
                                            <div class="author-name">{{ $testimonial->name }}</div>
                                            <div class="author-designation">{{ $testimonial->designation_display }}</div>
                                        </div>
                                    </div>
                                    <div class="testimonial-stars" aria-label="{{ $rating }}/5">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tst-review">
                                    <span class="tst-gutter" aria-hidden="true">//</span>
                                    <p class="testimonial-text">{{ $testimonial->message }}</p>
                                </div>

                                <div class="tst-foot">
                                    <span class="tst-ok"><i class="bi bi-patch-check-fill"></i> verified review</span>
                                    <span class="tst-merge"><i class="bi bi-check2"></i> merged to main</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="carousel-controls">
                        <button class="carousel-btn carousel-prev" id="testPrev" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <div class="carousel-dots" id="testDots"></div>
                        <button class="carousel-btn carousel-next" id="testNext" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-chat-quote"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_testimonials') }}</p>
                    <p>{{ __('messages.no_testimonials_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

            <!-- Contact Section — CODING TERMINAL DESIGN -->
    <section class="contact-section section-padding" id="contact">
        <div class="contact-bg-grid"></div>
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> contact.php</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'contact.php',
                'hTag' => 'api',
                'hCmd' => 'php artisan serve --contact',
                'hTitle' => __('messages.contact_title'),
                'hTime' => '0.08s',
                'hRight' => __('messages.avail_for_work'),
                'hTests' => [__('messages.contact_subtitle')],
            ])

            <div class="contact-grid">
                <!-- Left: Terminal Info Card -->
                <div class="ct-terminal reveal reveal-delay-1">
                    <div class="ct-term-bar">
                        <span class="ct-term-dots"><i></i><i></i><i></i></span>
                        <span class="ct-term-title"><i class="bi bi-folder2-open" style="color:#818cf8"></i> contact-config.env</span>
                        <span class="ct-term-status"><i class="bi bi-circle-fill" style="font-size:0.4rem"></i> online</span>
                    </div>
                    <div class="ct-term-cmd">
                        <span class="ct-term-prompt">$</span>
                        <span class="ct-term-cmd-text">cat .env.local</span>
                        <span class="ct-term-caret"></span>
                    </div>
                    <div class="ct-term-body">
                        <div class="ct-term-heading">{{ __("messages.contact_heading") }}</div>
                        <div class="ct-term-desc">{{ __("messages.contact_desc") }}</div>

                        <div class="ct-config-list">
                            <div class="ct-config-line">
                                <div class="ct-config-icon"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <div class="ct-config-key">MAIL_TO</div>
                                    <div class="ct-config-val">{{ $account->email ?? "joty@example.com" }}</div>
                                </div>
                            </div>
                            <div class="ct-config-line">
                                <div class="ct-config-icon"><i class="bi bi-phone-fill"></i></div>
                                <div>
                                    <div class="ct-config-key">PHONE</div>
                                    <div class="ct-config-val">{{ $account->phone ?? "+880 1XXX-XXXXXX" }}</div>
                                </div>
                            </div>
                            <div class="ct-config-line">
                                <div class="ct-config-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <div>
                                    <div class="ct-config-key">LOCATION</div>
                                    <div class="ct-config-val">Bangladesh</div>
                                </div>
                            </div>
                        </div>

                        @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
                            <div class="ct-socials">
                                <div class="ct-socials-label"><i class="bi bi-share-fill"></i> {{ __("messages.connect") }}</div>
                                <div class="ct-socials-row">
                                    @if(isset($account) && $account->github)
                                        <a href="{{ $account->github }}" target="_blank" class="ct-social-link" aria-label="GitHub"><i class="bi bi-github"></i></a>
                                    @endif
                                    @if(isset($account) && $account->linkedin)
                                        <a href="{{ $account->linkedin }}" target="_blank" class="ct-social-link" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                    @if(isset($account) && $account->facebook)
                                        <a href="{{ $account->facebook }}" target="_blank" class="ct-social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if(isset($account) && $account->instagram)
                                        <a href="{{ $account->instagram }}" target="_blank" class="ct-social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                    @endif
                                    @if(isset($account) && $account->twitter)
                                        <a href="{{ $account->twitter }}" target="_blank" class="ct-social-link" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                    @endif
                                    @if(isset($account) && $account->youtube)
                                        <a href="{{ $account->youtube }}" target="_blank" class="ct-social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Code Editor Form -->
                <div class="ct-editor reveal reveal-delay-2">
                    <div class="ct-editor-bar">
                        <span class="ct-editor-tab"><i class="bi bi-filetype-php"></i> send_message.php</span>
                        <span class="ct-editor-lang">PHP</span>
                    </div>
                    <div class="ct-editor-body">
                        <div class="ct-editor-heading"><i class="bi bi-pencil-square me-1" style="color:#818cf8"></i> {{ __("messages.send_message") }}</div>
                        <div class="ct-editor-desc">{{ __("messages.contact_desc") }}</div>
                        <form action="{{ url("/contactus") }}" method="POST" id="contactForm">
                            @csrf
                            <div class="ct-code-group">
                                <div class="ct-code-label"><i class="bi bi-tag-fill"></i> const name =</div>
                                <div class="ct-code-input-wrap">
                                    <div class="ct-code-line">
                                        <span class="ct-code-ln">1</span>
                                        <input type="text" id="name" name="name" class="ct-code-input" placeholder="{{ __("messages.name_placeholder") }}" required>
                                        <span class="ct-code-end">;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ct-code-group">
                                <div class="ct-code-label"><i class="bi bi-tag-fill"></i> const email =</div>
                                <div class="ct-code-input-wrap">
                                    <div class="ct-code-line">
                                        <span class="ct-code-ln">2</span>
                                        <input type="email" id="email" name="email" class="ct-code-input" placeholder="{{ __("messages.email_placeholder") }}" required>
                                        <span class="ct-code-end">;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ct-code-group">
                                <div class="ct-code-label"><i class="bi bi-tag-fill"></i> const message =</div>
                                <div class="ct-code-input-wrap">
                                    <div class="ct-code-line" style="align-items: flex-start;">
                                        <span class="ct-code-ln">3</span>
                                        <textarea id="message" name="message" class="ct-code-textarea" placeholder="{{ __("messages.message_placeholder") }}" rows="4" required></textarea>
                                        <span class="ct-code-end" style="padding-top:0.7rem">;</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="ct-push-btn">
                                <span class="ct-push-shimmer"></span>
                                <span class="ct-push-prompt">$</span>
                                <i class="bi bi-send-fill push-icon"></i>
                                <span>git push origin main</span>
                                <span class="ct-push-badge">deploy</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="map-wrapper reveal reveal-delay-1">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3749427.7985686358!2d88.0190403004489!3d23.684993584973406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2!2sBangladesh!5e0!3m2!1sen!2sbd!4v1!4m2!3m1!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2"
                        width="100%" height="350" style="border:0; border-radius: 16px;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Location Map">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    </section><!-- FAQ Section -->
        <!-- FAQ Section — CODING COLLAPSIBLE BLOCKS -->
    <section class="faq-section section-padding" id="faq">
        <div class="container">
            <div class="code-divider reveal" aria-hidden="true">
                <span class="cd-line"></span>
                <span class="cd-tag"><i class="bi bi-terminal-fill"></i> ~/portfolio <span class="cd-arrow">&rarr;</span> faq.md</span>
                <span class="cd-cursor"></span>
                <span class="cd-line"></span>
            </div>
            @include('frontend.partials.section-header', [
                'hFile' => 'faq.md',
                'hTag' => 'docs',
                'hCmd' => 'cat faq.md',
                'hTitle' => __('messages.faq_title'),
                'hTime' => '0.06s',
                'hRight' => $faqs->count() . ' ' . __('messages.faq_title'),
                'hTests' => [__('messages.faq_subtitle')],
            ])

            @if($faqs->isNotEmpty())
                <div class="faq-list reveal">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item" data-faq>
                            <button class="faq-q-row" onclick="toggleFaq(this)">
                                <span class="faq-q-icon"><i class="bi bi-question-lg"></i></span>
                                <span class="faq-q-text">{{ $faq->question }}</span>
                                <i class="bi bi-chevron-down faq-q-chevron"></i>
                            </button>
                            <div class="faq-a-block">
                                <div class="faq-a-inner">
                                    <span class="faq-a-gutter">//</span>{{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <script>
                function toggleFaq(btn) {
                    var item = btn.closest('.faq-item');
                    var wasOpen = item.classList.contains('faq-open');

                    // Close all
                    document.querySelectorAll('.faq-item').forEach(function(el) {
                        el.classList.remove('faq-open');
                    });

                    // Toggle clicked
                    if (!wasOpen) {
                        item.classList.add('faq-open');
                    }
                }
                </script>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-question-circle"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_faqs') }}</p>
                    <p>{{ __('messages.no_faqs_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <h4>{{ optional($account)->name ?? 'Portfolio' }}</h4>
                <p>{{ __('messages.copyright') }}</p>
            </div>
            <div class="footer-divider"></div>

            <div class="footer-links">
                <a href="#about">{{ __('messages.about') }}</a>
                <a href="#services">{{ __('messages.services') }}</a>
                <a href="#skills">{{ __('messages.skills') }}</a>
                <a href="#projects">{{ __('messages.projects') }}</a>
                <a href="#faq">FAQ</a>
                <a href="#contact">{{ __('messages.contact') }}</a>
            </div>

            <!-- Social Media Icons -->
            <div class="footer-social d-flex justify-content-center gap-2 flex-wrap" style="margin-bottom: 1.5rem;">
                @if(isset($account) && $account->github)
                    <a href="{{ $account->github }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="GitHub">
                        <i class="bi bi-github"></i>
                    </a>
                @endif
                @if(isset($account) && $account->linkedin)
                    <a href="{{ $account->linkedin }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                @endif
                @if(isset($account) && $account->facebook)
                    <a href="{{ $account->facebook }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                @endif
                @if(isset($account) && $account->instagram)
                    <a href="{{ $account->instagram }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                @if(isset($account) && $account->twitter)
                    <a href="{{ $account->twitter }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                @if(isset($account) && $account->youtube)
                    <a href="{{ $account->youtube }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
                @if(isset($account) && $account->fiverr)
                    <a href="{{ $account->fiverr }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Fiverr">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg>
                    </a>
                @endif
                @if(isset($account) && $account->upwork)
                    <a href="{{ $account->upwork }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Upwork">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#6FDA44"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">U</text></svg>
                    </a>
                @endif
                @if(isset($account) && $account->freelancer)
                    <a href="{{ $account->freelancer }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Freelancer">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#29B2FE"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="13" font-family="Arial,sans-serif">Fc</text></svg>
                    </a>
                @endif
            </div>

            <div class="footer-bottom">
                <p>� {{ date('Y') }} {{ optional($account)->name ?? 'Portfolio' }}. {{ __('messages.copyright') }}</p>
                <span style="color: #475569; font-size: 0.82rem;">{{ __('messages.made_with') }} <span class="heart">&hearts;</span></span>
                <a href="#" class="back-top"><i class="bi bi-arrow-up"></i> {{ __('messages.back_to_top') }}</a>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $account->phone ?? '8801XXXXXXXXX') }}"
       target="_blank" rel="noopener noreferrer"
       class="whatsapp-float" id="whatsappFloat" aria-label="{{ __('messages.chat_whatsapp') }}">
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-tooltip">{{ __('messages.chat_whatsapp') }}</span>
    </a>



    <!-- Floating Admin Button (only for admin users) -->
    @auth
        @if(auth()->user()->is_admin == 1)
            <a href="{{ url('/admin') }}" class="admin-float-btn" aria-label="Admin Panel" title="Go to Admin Panel">
                <i class="bi bi-speedometer2"></i>
            </a>
        @endif
    @endauth

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Toast -->
    <div class="toast" id="toast">
        <i class="bi bi-check-circle-fill"></i> {{ __('messages.msg_sent') }}
    </div>

<script>
// ===== PARTICLES SYSTEM =====
(function() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let particles = [];
    let mouse = { x: 0, y: 0 };

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.4;
            this.speedY = (Math.random() - 0.5) * 0.4;
            this.opacity = Math.random() * 0.4 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 120) { this.x -= dx * 0.008; this.y -= dy * 0.008; }
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(59, 130, 246, ' + this.opacity + ')';
            ctx.fill();
        }
    }

    function initParticles() {
        particles = [];
        var count = Math.min(80, Math.floor((canvas.width * canvas.height) / 15000));
        for (var i = 0; i < count; i++) particles.push(new Particle());
    }
    initParticles();

    function connectParticles() {
        for (var i = 0; i < particles.length; i++) {
            for (var j = i + 1; j < particles.length; j++) {
                var dx = particles[i].x - particles[j].x;
                var dy = particles[i].y - particles[j].y;
                var dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 150) {
                    ctx.beginPath();
                    ctx.strokeStyle = 'rgba(59, 130, 246, ' + (0.06 * (1 - dist / 150)) + ')';
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < particles.length; i++) { particles[i].update(); particles[i].draw(); }
        connectParticles();
        requestAnimationFrame(animateParticles);
    }
    animateParticles();

    document.addEventListener('mousemove', function(e) { mouse.x = e.clientX; mouse.y = e.clientY; });
})();

// ===== CURSOR GLOW =====
(function() {
    var glow = document.getElementById('cursorGlow');
    if (!glow) return;
    document.addEventListener('mousemove', function(e) {
        glow.style.left = e.clientX + 'px';
        glow.style.top = e.clientY + 'px';
    });
    document.querySelectorAll('a, button, .magnetic, .project-card, .pkg-card, .skill-ball, .social-link, .btn-primary-custom, .btn-outline-custom, .freelance-btn').forEach(function(el) {
        el.addEventListener('mouseenter', function() { glow.classList.add('active'); });
        el.addEventListener('mouseleave', function() { glow.classList.remove('active'); });
    });
})();

// ===== HERO HOLO FIELD (falling code glyphs + orbit ring + horizon grid) =====
(function() {
    var canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');

    var W = 0, H = 0, dpr = 1, t = 0;

    var palette = [
        [129,140,248],[96,165,250],[52,211,153],[232,121,249],[251,191,36]
    ];

    /* ---------- falling code glyphs (matrix-style code rain) ---------- */
    var GLYPHS = ['{ }','</>','=>','()','[]',';','::','$','#','let','const','fn','async','await','&&','||','===','...','?.','->','git','npm','\x3C?php','\x3C/div>','\x3Cspan>','::class'];
    var N_GLYPHS = 66;
    var glyphs = [];
    function spawnGlyph(init) {
        return {
            x: Math.random() * W,
            y: init ? Math.random() * H : -8,
            speed: 0.12 + Math.random() * 0.3,
            size: 8 + Math.random() * 5,
            baseAlpha: 0.08 + Math.random() * 0.22,
            phase: Math.random() * Math.PI * 2,
            drift: (Math.random() - 0.5) * 0.14,
            ch: GLYPHS[(Math.random() * GLYPHS.length) | 0],
            color: palette[(Math.random() * palette.length) | 0]
        };
    }
    function buildGlyphs() {
        glyphs = [];
        for (var i = 0; i < N_GLYPHS; i++) glyphs.push(spawnGlyph(true));
    }

    /* ---------- horizon grid (bottom 30%) ---------- */
    function drawHorizon() {
        var hy = H * 0.72;
        var by = H - hy;
        var cx = W * 0.5;

        ctx.strokeStyle = 'rgba(99,102,241,0.08)';
        ctx.lineWidth = 1;
        for (var gv = -7; gv <= 7; gv++) {
            ctx.beginPath();
            ctx.moveTo(cx + (gv / 7) * W * 0.08, hy);
            ctx.lineTo(cx + gv * W * 0.36, H + 40);
            ctx.stroke();
        }
        for (var gh = 0; gh < 6; gh++) {
            var zz = (gh + 1) / 7;
            var yy = hy + zz * zz * by;
            ctx.globalAlpha = 0.35 + zz * 0.65;
            ctx.beginPath();
            ctx.moveTo(W * 0.04, yy);
            ctx.lineTo(W * 0.96, yy);
            ctx.stroke();
        }
        ctx.globalAlpha = 1;

        var glow = 0.08 + Math.sin(t * 0.012) * 0.025;
        ctx.strokeStyle = 'rgba(99,102,241,' + glow.toFixed(3) + ')';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(W * 0.08, hy);
        ctx.lineTo(W * 0.92, hy);
        ctx.stroke();
    }

    /* ---------- orbit ring + dots ---------- */
    function drawOrbit() {
        var cx = W * 0.5;
        var cy = H * 0.44;
        var R = Math.min(W * 0.27, H * 0.33, 330);

        /* soft glow behind ring */
        ctx.save();
        ctx.shadowBlur = 60;
        ctx.shadowColor = 'rgba(99,102,241,0.12)';
        ctx.beginPath();
        ctx.arc(cx, cy, R, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(99,102,241,0.1)';
        ctx.lineWidth = 1.5;
        ctx.stroke();
        ctx.restore();

        /* ring stroke */
        ctx.beginPath();
        ctx.arc(cx, cy, R, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(99,102,241,0.14)';
        ctx.lineWidth = 1;
        ctx.setLineDash([6, 10]);
        ctx.stroke();
        ctx.setLineDash([]);

        /* orbiting dots */
        var dotAlpha = 0.65 + Math.sin(t * 0.018) * 0.2;
        for (var i = 0; i < 3; i++) {
            var ang = t * 0.0012 + (i * Math.PI * 2 / 3);
            var dx = cx + Math.cos(ang) * R;
            var dy = cy + Math.sin(ang) * R * 0.55;
            var c = palette[i + 2];
            ctx.shadowBlur = 14;
            ctx.shadowColor = 'rgba(' + c[0] + ',' + c[1] + ',' + c[2] + ',0.6)';
            ctx.fillStyle = 'rgba(' + c[0] + ',' + c[1] + ',' + c[2] + ',' + dotAlpha.toFixed(3) + ')';
            ctx.beginPath();
            ctx.arc(dx, dy, 2.5 + Math.sin(t * 0.02 + i) * 0.8, 0, Math.PI * 2);
            ctx.fill();
        }
        ctx.shadowBlur = 0;
    }

    /* ---------- resize / init ---------- */
    function resize() {
        dpr = Math.min(window.devicePixelRatio || 1, 1.5);
        W = canvas.offsetWidth; H = canvas.offsetHeight;
        canvas.width = W * dpr; canvas.height = H * dpr;
        buildGlyphs();
    }
    resize();
    window.addEventListener('resize', resize);

    /* ---------- draw loop ---------- */
    function draw() {
        if (!W || document.hidden) { requestAnimationFrame(draw); return; }
        t++;
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, W, H);

        /* falling code glyphs */
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        for (var i = 0; i < glyphs.length; i++) {
            var s = glyphs[i];
            s.y += s.speed;
            s.x += s.drift + Math.sin(s.phase + t * 0.004) * 0.06;
            if (s.y > H + 14 || s.x < -70 || s.x > W + 70) {
                glyphs[i] = spawnGlyph(false);
                continue;
            }
            var twinkle = s.baseAlpha + Math.sin(s.phase + t * 0.025) * s.baseAlpha * 0.45;
            if (twinkle < 0.03) twinkle = 0.03;
            ctx.font = '600 ' + s.size.toFixed(1) + 'px "Cascadia Code", ui-monospace, Consolas, monospace';
            ctx.fillStyle = 'rgba(' + s.color[0] + ',' + s.color[1] + ',' + s.color[2] + ',' + twinkle.toFixed(3) + ')';
            ctx.fillText(s.ch, s.x, s.y);
        }

        drawHorizon();
        drawOrbit();

        requestAnimationFrame(draw);
    }
    requestAnimationFrame(draw);
})();

// ===== MOBILE MENU =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var navLinks = document.getElementById('navLinks');
    if (!hamburger || !navLinks) return;
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('open');
    });
    navLinks.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('open');
        });
    });
})();


// ===== COALESCED SCROLL HANDLER (passive + rAF throttled) =====
(function() {
    var navbar = document.getElementById('navbar');
    var adminFloat = document.querySelector('.admin-float-btn');
    var progressBar = document.getElementById('scrollProgress');
    var revealElements = document.querySelectorAll('.reveal');
    var statNumbers = document.querySelectorAll('.number[data-count]');
    var ticking = false;

    function onScroll() {
        var scrollY = window.scrollY;
        var winHeight = window.innerHeight;
        var docHeight = document.documentElement.scrollHeight - winHeight;
        
        // Navbar
        if (navbar) {
            if (scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        }
        
        // Admin float
        if (adminFloat) {
            if (scrollY > 300) adminFloat.classList.add('visible');
            else adminFloat.classList.remove('visible');
        }
        
        // Scroll progress bar
        if (progressBar && docHeight > 0) {
            progressBar.style.width = Math.min((scrollY / docHeight) * 100, 100) + '%';
        }
        
        // Scroll reveal + counters (run both in same pass)
        [].forEach.call(revealElements, function(el) {
            if (el.getBoundingClientRect().top < winHeight - 80) el.classList.add('active');
        });
        [].forEach.call(statNumbers, function(el) {
            if (el.dataset.animated) return;
            if (el.getBoundingClientRect().top < winHeight) {
                el.dataset.animated = 'true';
                var target = parseInt(el.getAttribute('data-count'));
                var count = 0;
                var step = Math.ceil(target / 60);
                var interval = setInterval(function() {
                    count += step;
                    if (count >= target) { count = target; clearInterval(interval); }
                    el.textContent = count + '+';
                }, 30);
            }
        });    }

    // rAF-coalesced scroll for zero layout thrashing
    function scrollHandler() {
        if (!ticking) {
            requestAnimationFrame(function() {
                onScroll();
                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', scrollHandler, { passive: true });
    window.addEventListener('load', onScroll);
    window.addEventListener('resize', onScroll);
})();

// ===== PROJECT CARD TILT =====
(function() {
    document.querySelectorAll('.project-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var rotateX = (y - rect.height/2) / 20;
            var rotateY = (rect.width/2 - x) / 20;
            card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px)';
        });
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
})();

// ===== PROJECT PIPELINE CARDS (typed build command + ticking steps) =====
(function() {
    var cards = document.querySelectorAll('.project-card');
    if (!cards.length) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function run(card) {
        if (card.dataset.pjDone) return;
        card.dataset.pjDone = '1';

        var el = card.querySelector('[data-pj-cmd]');
        var full = el ? (el.getAttribute('data-pj-cmd') || el.textContent || '') : '';

        if (!el || reduce) {
            if (el) el.textContent = full;
            card.classList.add('pj-on');
            return;
        }

        el.textContent = '';
        var i = 0;
        (function type() {
            el.textContent = full.slice(0, ++i);
            if (i < full.length) setTimeout(type, 22 + Math.random() * 22);
            else card.classList.add('pj-on');
        })();
    }

    if (window.IntersectionObserver) {
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                run(entry.target);
                io.unobserve(entry.target);
            });
        }, { threshold: 0.25 });
        cards.forEach(function(card) { io.observe(card); });
    } else {
        cards.forEach(run);
    }

    // Cards hidden by a filter never intersect, so replay them when they come back.
    document.querySelectorAll('.filter-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            setTimeout(function() {
                cards.forEach(function(card) {
                    if (card.offsetParent !== null) run(card);
                });
            }, 60);
        });
    });
})();

// ===== SMOOTH ANCHOR SCROLL =====
(function() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href === '#') { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); return; }
            e.preventDefault();
            var target = document.querySelector(href);
            if (target) {
                var pos = target.getBoundingClientRect().top + window.scrollY - 80;
                window.scrollTo({ top: pos, behavior: 'smooth' });
            }
        });
    });
})();


// ===== MAGNETIC BUTTON EFFECT =====
(function() {
    document.querySelectorAll('.magnetic').forEach(function(btn) {
        btn.addEventListener('mousemove', function(e) {
            var rect = btn.getBoundingClientRect();
            var x = e.clientX - rect.left - rect.width/2;
            var y = e.clientY - rect.top - rect.height/2;
            btn.style.transform = 'translate(' + (x*0.2) + 'px, ' + (y*0.2) + 'px)';
        });
        btn.addEventListener('mouseleave', function() { btn.style.transform = 'translate(0, 0)'; });
    });
})();

// ===== TESTIMONIAL CAROUSEL =====
(function() {
    var track = document.getElementById('testimonialTrack');
    var dotsContainer = document.getElementById('testDots');
    var prevBtn = document.getElementById('testPrev');
    var nextBtn = document.getElementById('testNext');
    if (!track) return;
    var cards = track.querySelectorAll('.testimonial-card');
    var total = cards.length;
    if (total <= 1) return;
    var currentIndex = 0;
    var autoInterval;

    for (var i = 0; i < total; i++) {
        var dot = document.createElement('span');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        (function(idx) { dot.addEventListener('click', function() { goToSlide(idx); }); })(i);
        dotsContainer.appendChild(dot);
    }

    function goToSlide(index) {
        currentIndex = index;
        track.style.transform = 'translateX(-' + (index * 100) + '%)';
        dotsContainer.querySelectorAll('.dot').forEach(function(d, i) { d.classList.toggle('active', i === index); });
        // replay the review's line-by-line entrance on the incoming slide
        cards.forEach(function(c, i) {
            c.classList.remove('tst-in');
            if (i !== index) return;
            void c.offsetWidth;
            c.classList.add('tst-in');
        });
    }
    function startAutoPlay() { autoInterval = setInterval(function() { goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); }, 5000); }
    function stopAutoPlay() { clearInterval(autoInterval); }

    prevBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === 0 ? total - 1 : currentIndex - 1); startAutoPlay(); });
    nextBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); startAutoPlay(); });

    var carousel = document.querySelector('.testimonial-carousel');
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    startAutoPlay();
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') prevBtn.click();
        if (e.key === 'ArrowRight') nextBtn.click();
    });
})();

// ===== CONTACT FORM AJAX =====
(function() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(form);
        var btn = form.querySelector('.btn-submit');
        var origText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
        btn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async function(response) {
            if (!response.ok) { var err = await response.json(); throw err; }
            return response.text();
        })
        .then(function() {
            var toast = document.getElementById('toast');
            if (toast) { toast.classList.add('show'); setTimeout(function() { toast.classList.remove('show'); }, 3000); }
            form.reset();
        })
        .catch(function(error) { console.error('Error:', error); alert('Message send failed!'); })
        .finally(function() { btn.innerHTML = origText; btn.disabled = false; });
    });
})();

// ===== SCROLL PROGRESS BAR =====
(function() {
    var bar = document.getElementById('scrollProgress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var progress = (scrollTop / docHeight) * 100;
        bar.style.width = progress + '%';
    });
})();

// ===== PROJECT FILTER TABS =====
(function() {
    var filterBtns = document.querySelectorAll('.filter-btn');
    var projectCards = document.querySelectorAll('.project-card');
    if (!filterBtns.length || !projectCards.length) return;

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            var filter = this.getAttribute('data-filter');

            projectCards.forEach(function(card) {
                if (filter === 'all') {
                    card.style.display = '';
                    card.style.opacity = '1';
                } else {
                    var techs = (card.getAttribute('data-tech') || '').toLowerCase().split(' ');
                    if (techs.indexOf(filter) > -1) {
                        card.style.display = '';
                        card.style.opacity = '1';
                    } else {
                        card.style.display = 'none';
                    }
                }
                // Re-trigger reveal animation
                card.classList.remove('active');
                setTimeout(function() { card.classList.add('active'); }, 50);
            });
        });
    });
})();

// ===== SKILLS - LIVE PROCESS MONITOR (typed command + moving meters) =====
(function() {
    var panel = document.querySelector('[data-sk-panel]');
    if (!panel) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var cmdEl = panel.querySelector('[data-sk-cmd]');
    var cmd = cmdEl ? (cmdEl.getAttribute('data-sk-cmd') || '') : '';
    var tickEl = panel.querySelector('[data-sk-tick]');
    var avgEl = panel.querySelector('[data-sk-avg]');

    var rows = [].slice.call(panel.querySelectorAll('.sk-row')).map(function(row) {
        return {
            row: row,
            fill: row.querySelector('.sk-meter-fill'),
            state: row.querySelector('.sk-state'),
            base: parseInt(row.getAttribute('data-sk-pct'), 10) || 0,
            phase: Math.random() * Math.PI * 2
        };
    });

    var revealed = false;
    var liveTimer = null;
    var active = -1;
    var ticks = 0;

    function typeCmd() {
        if (!cmdEl || !cmd) return;
        if (reduce) { cmdEl.textContent = cmd; return; }
        var i = 0;
        (function step() {
            cmdEl.textContent = cmd.slice(0, ++i);
            if (i < cmd.length) setTimeout(step, 20 + Math.random() * 26);
        })();
    }

    // One sampling pass: the highlight moves down the list and every meter
    // drifts a little, so the panel keeps visibly moving instead of sitting still.
    function sample() {
        ticks++;
        if (tickEl) tickEl.textContent = ticks;

        active = rows.length ? (active + 1) % rows.length : -1;

        var sum = 0;
        var n = 0;
        rows.forEach(function(m, i) {
            var isActive = i === active;
            m.row.classList.toggle('is-active', isActive);
            if (m.state) m.state.textContent = isActive ? 'sampling' : 'running';
            if (!m.fill) return;
            var drift = Math.sin(ticks / 2.1 + m.phase) * 4;
            var val = Math.max(4, Math.min(100, Math.round(m.base + drift)));
            m.fill.style.setProperty('--w', val + '%');
            m.fill.style.width = val + '%';
            sum += val;
            n++;
        });

        if (avgEl && n) avgEl.textContent = Math.round(sum / n) + '%';
    }

    function startLive() {
        if (liveTimer || reduce || !rows.length) return;
        sample();
        liveTimer = setInterval(function() {
            if (document.hidden || !inView()) return;
            sample();
        }, 1500);
    }

    function stopLive() {
        if (liveTimer) { clearInterval(liveTimer); liveTimer = null; }
    }

    function inView() {
        var r = panel.getBoundingClientRect();
        return r.top < window.innerHeight - 40 && r.bottom > 40;
    }

    function reveal() {
        if (revealed) { startLive(); return; }
        if (!inView()) return;
        revealed = true;
        panel.classList.remove('sk-armed');
        panel.classList.add('sk-ready');
        setTimeout(typeCmd, 280);
        startLive();
    }

    // Armed by JS, so the panel is never hidden without scripts.
    panel.classList.add('sk-armed');

    if (window.IntersectionObserver) {
        new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) reveal();
                else stopLive();
            });
        }, { threshold: 0.15 }).observe(panel);
    } else {
        window.addEventListener('scroll', function() { reveal(); });
    }

    // Safety net: never leave the rows hidden if the observer never fires.
    setTimeout(function() {
        if (!revealed && inView()) {
            panel.classList.remove('sk-armed');
            panel.classList.add('sk-ready');
            revealed = true;
            startLive();
        }
    }, 2200);
})();

// ===== GLASS CARD SHINE EFFECT (all glass cards) =====
(function() {
    var selectors = '.cs-step, .timeline-card, .project-card, .pkg-card, .testimonial-card, .faq-item, .svc-card, .contact-info-card, .contact-item, .casestudy-card, .edu-card, .about-shell, .coding-card';
    document.querySelectorAll(selectors).forEach(function(card) {
        var rafId = null;
        card.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shine-x', x + '%');
                self.style.setProperty('--shine-y', y + '%');
                rafId = null;
            });
        });
        card.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shine-x', '50%');
            this.style.setProperty('--shine-y', '50%');
        });
    });
})();

// ===== SERVICES � API ENDPOINT CARDS (staggered reveal + typed route) =====
(function() {
    var cards = document.querySelectorAll('.svc-card');
    if (!cards.length) return;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function fullPath(card) {
        var el = card.querySelector('.svc-path');
        if (!el) return '';
        return el.getAttribute('data-path') || el.textContent || '';
    }

    function typePath(card) {
        var el = card.querySelector('.svc-path');
        var full = fullPath(card);
        if (!el || !full) return;
        el.setAttribute('data-path', full);
        if (reduce) { el.textContent = full; return; }
        el.textContent = '';
        var i = 0;
        (function step() {
            el.textContent = full.substring(0, i + 1);
            i++;
            if (i <= full.length) setTimeout(step, 28);
        })();
    }

    function run(card) {
        if (card.dataset.svcRan) return;
        card.dataset.svcRan = '1';
        card.classList.add('visible');
        setTimeout(function() { typePath(card); }, reduce ? 0 : 200);
    }

    if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                run(entry.target);
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.3 });
        [].forEach.call(cards, function(c) { obs.observe(c); });
    } else {
        [].forEach.call(cards, function(c) { run(c); });
    }

    // Safety net: reveal every card and never leave a route half-typed
    setTimeout(function() {
        [].forEach.call(cards, function(c) {
            run(c);
            var el = c.querySelector('.svc-path');
            var full = fullPath(c);
            if (el && full) el.textContent = full;
        });
    }, 4000);
})();

// ===== PRICING - TERMINAL INSTALL CARDS (typing, progress, price count-up) ====
(function() {
    var cards = document.querySelectorAll('.pkg-card');
    if (!cards.length) return;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function setStagger(card) {
        if (reduce) return;
        [].forEach.call(card.querySelectorAll('.term-line[data-term]'), function(line, i) {
            line.style.animationDelay = (0.05 + i * 0.15).toFixed(2) + 's';
        });
    }

    function typeCmd(card) {
        var el = card.querySelector('.term-type');
        if (!el) return;
        var full = el.getAttribute('data-cmd') || '';
        if (!full) return;
        if (reduce) { el.textContent = full; return; }
        el.textContent = '';
        var i = 0;
        (function step() {
            el.textContent = full.substring(0, i + 1);
            i++;
            if (i <= full.length) setTimeout(step, 42);
        })();
    }

    function countUp(card) {
        var el = card.querySelector('.term-amount');
        var price = card.querySelector('.term-price');
        if (!el || !price) return;
        var target = parseInt(price.getAttribute('data-price'), 10);
        if (isNaN(target)) return;
        if (reduce || !window.requestAnimationFrame) { el.textContent = '$' + target; return; }
        var start = null;
        var dur = 900;
        function tick(ts) {
            if (start === null) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            var eased = 1 - Math.pow(1 - p, 3);
            el.textContent = '$' + Math.round(target * eased);
            if (p < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    }

    function run(card) {
        if (card.dataset.termRan) return;
        card.dataset.termRan = '1';
        setStagger(card);
        card.classList.add('visible');
        if (reduce) {
            typeCmd(card);
            countUp(card);
        } else {
            setTimeout(function() { typeCmd(card); }, 180);
            setTimeout(function() { countUp(card); }, 1150);
        }
    }

    if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                run(entry.target);
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.25 });
        [].forEach.call(cards, function(c) { obs.observe(c); });
    } else {
        [].forEach.call(cards, function(c) { run(c); });
    }

    // Safety net: never leave a card's session hidden or half-filled
    setTimeout(function() {
        [].forEach.call(cards, function(c) {
            run(c);
            c.classList.add('visible');
        });
    }, 4000);
})();

// ===== ABOUT � GIT LOG PROFILE (graph reveal + typed command) =====
(function() {
    var wb = document.getElementById('aboutWorkbench');
    if (!wb) return;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var cmdEl = wb.querySelector('.gl-cmd-text');
    var hashes = wb.querySelectorAll('.gl-hash');
    // The reveal classes live on the git window itself, not on the shell
    var panel = wb.querySelector('.gl-wb') || wb;
    var started = false;

    function fullCmd() { return cmdEl ? (cmdEl.getAttribute('data-cmd') || '') : ''; }

    function fillAll() {
        if (cmdEl) cmdEl.textContent = fullCmd();
        [].forEach.call(hashes, function(h) {
            if (!h.textContent) h.textContent = h.getAttribute('data-hash') || '';
        });
    }

    function type(el, text, speed, done) {
        if (!el || !text) { if (done) done(); return; }
        var i = 0;
        (function step() {
            el.textContent = text.substring(0, i + 1);
            i++;
            if (i < text.length) setTimeout(step, speed);
            else if (done) done();
        })();
    }

    function start() {
        if (started) return;
        started = true;
        panel.classList.add('gl-ready');

        if (reduce) { fillAll(); return; }

        // Blank the command + hashes so they can be typed like a real session
        if (cmdEl) cmdEl.textContent = '';
        [].forEach.call(hashes, function(h) { h.textContent = ''; });

        type(cmdEl, fullCmd(), 28, function() {
            var idx = 0;
            (function nextHash() {
                if (idx >= hashes.length) return;
                var h = hashes[idx++];
                type(h, h.getAttribute('data-hash') || '', 45, function() {
                    setTimeout(nextHash, 130);
                });
            })();
        });
    }

    // Arm the reveal (only when JS is there to reveal it again)
    if (!reduce) panel.classList.add('gl-armed');

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) { start(); io.disconnect(); }
            });
        }, { threshold: 0.15 });
        io.observe(wb);
    } else {
        start();
    }

    // Safety net: never leave the log hidden or half-typed
    setTimeout(function() { start(); fillAll(); }, 3500);
})();

// ===== SECTION HEADERS + CASE STUDIES CTA (suite reveal + typed command) =====
(function() {
    var panels = [].slice.call(document.querySelectorAll('[data-csh]'));
    if (!panels.length) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function type(el, text, speed, done) {
        if (!el || !text) { if (done) done(); return; }
        var i = 0;
        (function step() {
            el.textContent = text.substring(0, i + 1);
            i++;
            if (i < text.length) setTimeout(step, speed);
            else if (done) done();
        })();
    }

    function fillCmd(panel) {
        var el = panel.querySelector('.csh-cmd-text');
        if (el && !el.textContent) el.textContent = el.getAttribute('data-cmd') || '';
    }

    function reveal(panel) {
        if (panel.classList.contains('csh-ready')) return;
        panel.classList.add('csh-ready');

        var el = panel.querySelector('.csh-cmd-text');
        if (reduce || !el || el.dataset.typed) return;
        el.dataset.typed = '1';
        el.textContent = '';
        type(el, el.getAttribute('data-cmd') || '', 30);
    }

    if (reduce) {
        panels.forEach(fillCmd);
        panels.forEach(function(p) { p.classList.add('csh-ready'); });
    } else if ('IntersectionObserver' in window) {
        panels.forEach(function(p) { p.classList.add('csh-armed'); });
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                reveal(entry.target);
                io.unobserve(entry.target);
            });
        }, { threshold: 0.15 });
        panels.forEach(function(p) { io.observe(p); });
    } else {
        panels.forEach(function(p) { reveal(p); });
    }

    // Safety net: only un-hide a panel that is actually on screen and still armed
    setTimeout(function() {
        panels.forEach(function(p) {
            if (p.classList.contains('csh-ready')) return;
            var r = p.getBoundingClientRect();
            if (r.top < window.innerHeight && r.bottom > 0) {
                p.classList.add('csh-ready');
                fillCmd(p);
            }
        });
    }, 4000);
})();

// ===== EXPERIENCE - CHANGELOG (rail draw + staggered release reveal) =====
(function() {
    var log = document.getElementById('experienceLog');
    if (!log) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function reveal() { log.classList.add('rel-ready'); }

    if (reduce) { reveal(); return; }

    log.classList.add('rel-armed');

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                reveal();
                io.disconnect();
            });
        }, { threshold: 0.1 });
        io.observe(log);
    } else {
        reveal();
    }

    // Safety net: only un-hide when the log is actually on screen
    setTimeout(function() {
        if (log.classList.contains('rel-ready')) return;
        var r = log.getBoundingClientRect();
        if (r.top < window.innerHeight && r.bottom > 0) reveal();
    }, 4000);
})();

// ===== EDUCATION - COMPILED MODULES (staggered code reveal) =====
(function() {
    var grid = document.getElementById('educationGrid');
    if (!grid) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function reveal() { grid.classList.add('edu-ready'); }

    if (reduce) { reveal(); return; }

    grid.classList.add('edu-armed');

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                reveal();
                io.disconnect();
            });
        }, { threshold: 0.1 });
        io.observe(grid);
    } else {
        reveal();
    }

    // Safety net: only un-hide when the grid is actually on screen
    setTimeout(function() {
        if (grid.classList.contains('edu-ready')) return;
        var r = grid.getBoundingClientRect();
        if (r.top < window.innerHeight && r.bottom > 0) reveal();
    }, 4000);
})();

// ===== CASE STUDY CARDS (terminal typewriter + compile-in reveal) =====
(function() {
    var cards = document.querySelectorAll('.casestudy-card');
    if (!cards.length) return;

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function typeCommand(card) {
        var el = card.querySelector('.cs-cmd');
        if (!el) return;
        var full = el.getAttribute('data-cmd') || '';
        if (reduce) { el.textContent = full; return; }
        var i = 0;
        (function step() {
            el.textContent = full.substring(0, i + 1);
            i++;
            if (i <= full.length) setTimeout(step, 45);
        })();
    }

    function compile(card) {
        if (card.classList.contains('cs-compiled')) return;
        card.classList.add('cs-compiled');
        typeCommand(card);
    }

    if ('IntersectionObserver' in window && !reduce) {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                var card = entry.target;
                setTimeout(function() { compile(card); }, 120);
                obs.unobserve(card);
            });
        }, { threshold: 0.25 });
        [].forEach.call(cards, function(c) { obs.observe(c); });
    } else {
        [].forEach.call(cards, function(c) { compile(c); });
    }

    // Safety net: never leave card content hidden
    setTimeout(function() {
        [].forEach.call(cards, function(c) { c.classList.add('cs-compiled'); });
    }, 4000);
})();

</script>
@endsection


