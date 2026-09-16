@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #0a0f1e;
        --bg-secondary: #0f172a;
        --bg-card: rgba(17, 28, 46, 0.8);
        --accent: #3b82f6;
        --accent-light: #60a5fa;
        --accent-purple: #8b5cf6;
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: rgba(59, 130, 246, 0.12);
        --radius-lg: 20px;
        --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        --mono: "Cascadia Code", ui-monospace, Consolas, Menlo, monospace;
    }
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: rgba(59, 130, 246, 0.15);
    }
    html.light-theme body { background: #f8fafc; }
    body {
        font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif;
    }

    /* window dots — declared here so every bar on this page actually shows them */
    .ab-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .ab-dot.red { background: #ff5f57; }
    .ab-dot.yellow { background: #febc2e; }
    .ab-dot.green { background: #28c840; }
    .cs-bar .ab-dot, .csb-bar .ab-dot, .custech-bar .ab-dot, .sb-bar .ab-dot { width: 8px; height: 8px; }

    .cs-branch {
        margin-left: auto; flex-shrink: 0; white-space: nowrap;
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-family: var(--mono); font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px;
        color: #93c5fd; background: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.26);
        padding: 0.13rem 0.45rem; border-radius: 50px;
    }
    html.light-theme .cs-branch { color: #2563eb; }

    /* scanner that sweeps the preview once, right after it reveals */
    .cs-scan {
        position: absolute; left: 0; right: 0; top: 0; height: 35%; z-index: 2;
        background: linear-gradient(180deg, transparent, rgba(34, 211, 238, 0.18), transparent);
        transform: translateY(-140%); pointer-events: none;
    }
    .cs-image-wrap.in .cs-scan { animation: csImgScan 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.25s 1 forwards; }
    @keyframes csImgScan { to { transform: translateY(330%); } }

    /* stack chips tick in one by one */
    .cs-tech-wrap.in .cs-tech-item {
        animation: csChipIn 0.45s cubic-bezier(0.16, 1, 0.3, 1) both;
        animation-delay: calc(var(--i, 0) * 45ms + 0.1s);
    }
    @keyframes csChipIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }

    @media (max-width: 480px) {
        .cs-bar { padding: 0.45rem 0.7rem; }
        .cs-branch { display: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        .cs-detail-page::before, .cs-cursor { animation: none; }
        .cs-rv { opacity: 1 !important; transform: none !important; }
        .cs-image-wrap.in .cs-scan, .cs-tech-wrap.in .cs-tech-item { animation: none; }
    }

    .cs-detail-page {
        padding-top: 90px;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-primary);
        position: relative;
    }
    .cs-detail-page::before {
        content: ''; position: fixed; top: -30%; left: -15%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(99,102,241,0.05) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .cs-container { max-width: 1080px; margin: 0 auto; padding: 0 1.25rem; position: relative; z-index: 1; }

    /* ===== MAIN TERMINAL SHELL ===== */
    .cs-shell {
        position: relative;
        border: 1px solid rgba(147, 197, 253, 0.2);
        border-radius: 20px; overflow: hidden;
        background: rgba(13, 20, 40, 0.35);
        -webkit-backdrop-filter: blur(18px) saturate(150%); backdrop-filter: blur(18px) saturate(150%);
        box-shadow: 0 40px 120px rgba(2, 8, 23, 0.55);
    }
    html.light-theme .cs-shell {
        background: rgba(255, 255, 255, 0.78);
        border-color: rgba(59, 130, 246, 0.25);
        box-shadow: 0 40px 100px rgba(59, 130, 246, 0.12);
    }
    .cs-shell::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: csSweep 6s linear infinite;
        z-index: 5; pointer-events: none;
    }
    @keyframes csSweep { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

    .cs-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .cs-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .cs-file {
        margin-left: 0.35rem; font-family: var(--mono); font-size: 0.72rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        display: inline-flex; align-items: center; gap: 0.4rem;
    }
    html.light-theme .cs-file { color: #334155; }
    .cs-file i { color: #818cf8; font-size: 0.72rem; }

    .cs-cmd {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 0.9rem; font-family: var(--mono); font-size: 0.8rem;
        background: rgba(2, 8, 23, 0.5); border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        min-height: 2.2rem;
    }
    html.light-theme .cs-cmd { background: rgba(15, 23, 42, 0.05); border-bottom-color: rgba(15, 23, 42, 0.08); }
    .cs-prompt { color: #34d399; font-weight: 700; flex-shrink: 0; }
    .cs-cmd-text { color: #e2e8f0; min-width: 0; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
    html.light-theme .cs-cmd-text { color: #1e293b; }
    .cs-cursor {
        width: 9px; height: 16px; flex-shrink: 0;
        background: #22d3ee; animation: csBlink 1s steps(1) infinite;
    }
    @keyframes csBlink { 50% { opacity: 0; } }

    .cs-inner { padding: 2rem; position: relative; z-index: 1; }
    .cs-foot {
        display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; flex-wrap: wrap;
        padding: 0.6rem 1rem; font-family: var(--mono); font-size: 0.64rem; color: #64748b;
        background: rgba(2, 8, 23, 0.28); border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    html.light-theme .cs-foot { background: rgba(15, 23, 42, 0.04); border-top-color: rgba(15, 23, 42, 0.08); }
    .cs-exit { display: inline-flex; align-items: center; gap: 0.35rem; color: #34d399; }
    .cs-exit i { font-size: 0.7rem; }
    .cs-loc { color: #475569; }
    html.light-theme .cs-loc { color: #64748b; }

    /* ===== Reveal ===== */
    .cs-rv {
        opacity: 0; transform: translateY(26px);
        transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cs-rv.in { opacity: 1; transform: none; }

    /* ===== Top bar ===== */
    .top-bar { display: flex; align-items: center; margin-bottom: 1.8rem; flex-wrap: wrap; gap: 1rem; }
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1.1rem; background: rgba(59,130,246,0.06);
        border: 1px solid rgba(59, 130, 246, 0.16); border-radius: 10px;
        color: #93c5fd; text-decoration: none; font-family: var(--mono); font-size: 0.78rem; font-weight: 600;
        transition: var(--transition); position: relative; overflow: hidden;
    }
    html.light-theme .back-link { background: rgba(59,130,246,0.05); color: #2563eb; }
    .back-link::before { content: '$'; color: #34d399; font-weight: 700; }
    .back-link span { position: relative; z-index: 1; }
    .back-link::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(99,102,241,0.4) 0%, rgba(99,102,241,0.1) 30%, transparent 60%);
        opacity: 0; transition: opacity 0.4s; pointer-events: none; border-radius: inherit;
    }
    .back-link:hover::after { opacity: 1; }
    .back-link:hover {
        border-color: rgba(99,102,241,0.35); color: #c4b5fd;
        transform: translateX(-4px); box-shadow: 0 6px 20px rgba(99,102,241,0.1);
    }
    html.light-theme .back-link:hover { color: #4338ca; }

    /* ===== Hero image ===== */
    .cs-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 16px; overflow: hidden;
        margin-bottom: 2rem; position: relative;
        box-shadow: 0 30px 90px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-color);
        background: var(--bg-secondary);
    }
    .cs-img-bar {
        position: absolute; top: 12px; left: 12px; z-index: 3;
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.35rem 0.8rem; border-radius: 9px;
        background: rgba(8, 12, 24, 0.72); border: 1px solid rgba(147, 197, 253, 0.25);
        -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px);
        font-family: var(--mono); font-size: 0.66rem; color: #cbd5e1;
        opacity: 0; transform: translateY(-8px); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cs-image-wrap:hover .cs-img-bar, .cs-img-bar.static { opacity: 1; transform: none; }
    html.light-theme .cs-img-bar { background: rgba(15, 23, 42, 0.75); color: #e2e8f0; }
    .cs-img-bar i { color: #818cf8; font-size: 0.7rem; }
    .cs-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cs-image-wrap:hover img { transform: scale(1.03); }
    .cs-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1a1a3e 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .cs-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.2; color: var(--accent); }
    .cs-image-wrap::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(99,102,241,0.3) 0%, rgba(99,102,241,0.08) 30%, transparent 60%);
        pointer-events: none; z-index: 1; opacity: 0; transition: opacity 0.5s ease;
    }
    .cs-image-wrap:hover::after { opacity: 1; }

    /* ===== Hero content ===== */
    .cs-hero-content { margin-bottom: 2.8rem; padding: 0 0.2rem; }
    .cs-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 1rem;
    }
    .cs-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff; font-family: var(--mono); font-size: 0.72rem; font-weight: 700;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.28);
    }
    .cs-hero-content .hero-category i { font-size: 0.7rem; }
    .cs-hero-content .hero-client {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        font-family: var(--mono); font-size: 0.72rem; font-weight: 600;
        background: rgba(59,130,246,0.08); color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.18);
    }
    html.light-theme .cs-hero-content .hero-client { background: rgba(59,130,246,0.06); color: #2563eb; }
    .cs-hero-content .hero-client i { font-size: 0.75rem; }
    .cs-hero-content h1 {
        font-size: clamp(1.7rem, 3.6vw, 2.7rem); font-weight: 900;
        color: var(--text-primary); margin: 0; letter-spacing: -1px; line-height: 1.12;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    html.light-theme .cs-hero-content h1 {
        background: linear-gradient(135deg, #0f172a 0%, #3b82f6 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .cs-hero-content h1::before {
        content: '>'; margin-right: 0.4rem; color: #22d3ee; -webkit-text-fill-color: #22d3ee; font-weight: 700;
    }

    /* ===== Content grid ===== */
    .cs-body {
        display: grid; grid-template-columns: 1fr 320px; gap: 2rem;
        align-items: start;
    }

    .cs-main { display: flex; flex-direction: column; gap: 1.5rem; }

    /* ===== Main terminal blocks ===== */
    .cs-block, .cs-tech-wrap {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition); position: relative;
    }
    html.light-theme .cs-block, html.light-theme .cs-tech-wrap { background: rgba(255,255,255,0.9); }
    .cs-block:hover, .cs-tech-wrap:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 14px 40px rgba(99, 102, 241, 0.08);
        transform: translateY(-4px);
    }
    .cs-block::after, .cs-tech-wrap::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(99,102,241,0.4) 0%, rgba(99,102,241,0.12) 30%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease; border-radius: inherit; z-index: 1;
    }
    .cs-block:hover::after, .cs-tech-wrap:hover::after { opacity: 1; }

    .csb-bar, .custech-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.85rem; font-family: var(--mono); font-size: 0.68rem; color: #94a3b8;
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
        position: relative; z-index: 2;
    }
    html.light-theme .csb-bar, html.light-theme .custech-bar {
        background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08);
    }
    .csb-file, .custech-file {
        display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 0.35rem;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .csb-file i, .custech-file i { font-size: 0.72rem; }
    .csb-bar.csb-problem .csb-file i { color: #f87171; }
    .csb-bar.csb-solution .csb-file i { color: #60a5fa; }
    .csb-bar.csb-result .csb-file i { color: #34d399; }
    .custech-file i { color: #a78bfa; }

    .csb-body, .custech-body { padding: 1.5rem 1.6rem; position: relative; z-index: 2; }
    .csb-body .block-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.9rem;
    }
    .csb-body .block-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem; flex-shrink: 0;
    }
    .csb-body .block-icon.ic-problem { background: rgba(239,68,68,0.1); color: #f87171; }
    .csb-body .block-icon.ic-solution { background: rgba(59,130,246,0.1); color: #60a5fa; }
    .csb-body .block-icon.ic-result { background: rgba(16,185,129,0.1); color: #34d399; }
    .csb-body .block-label {
        font-family: var(--mono); font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.8px; text-transform: uppercase;
    }
    .csb-body .block-label.lb-problem { color: #f87171; }
    .csb-body .block-label.lb-solution { color: #60a5fa; }
    .csb-body .block-label.lb-result { color: #34d399; }
    .csb-body p, .custech-body p {
        color: var(--text-secondary); font-family: var(--mono); font-size: 0.9rem;
        line-height: 1.9; margin: 0;
    }

    /* ===== Tech ===== */
    .custech-body .tech-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1rem;
    }
    .custech-body .tech-header .tech-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(139,92,246,0.1); color: #a78bfa; font-size: 0.9rem;
    }
    .custech-body .tech-header .tech-label {
        font-family: var(--mono); font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.8px; text-transform: uppercase; color: #a78bfa;
    }
    .cs-tech-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .cs-tech-item {
        font-family: var(--mono); font-size: 0.76rem; font-weight: 600;
        padding: 0.32rem 0.85rem;
        background: rgba(99,102,241,0.07); color: #a5b4fc;
        border: 1px solid rgba(99,102,241,0.15); border-radius: 8px;
        transition: var(--transition);
    }
    html.light-theme .cs-tech-item { color: #4f46e5; }
    .cs-tech-item::before { content: '#'; color: #22d3ee; margin-right: 0.2rem; }
    .cs-tech-item:hover {
        background: rgba(99,102,241,0.14); border-color: rgba(99,102,241,0.3);
        transform: translateY(-2px);
    }

    /* ===== Sidebar ===== */
    .cs-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }

    .sidebar-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; overflow: hidden; position: relative;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    html.light-theme .sidebar-card { background: rgba(255,255,255,0.9); }
    .sidebar-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 14px 40px rgba(99, 102, 241, 0.08);
        transform: translateY(-4px);
    }
    .sb-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.85rem; font-family: var(--mono); font-size: 0.68rem; color: #94a3b8;
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .sb-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .sb-bar .sb-file {
        display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 0.35rem;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .sb-bar .sb-file i { color: #22d3ee; font-size: 0.72rem; }
    .sb-body { padding: 1.2rem 1.4rem 1.5rem; }
    .sb-body .sc-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.9rem;
        padding-bottom: 0.9rem; border-bottom: 1px solid var(--border-color);
    }
    .sb-body .sc-header i { font-size: 0.95rem; color: #22d3ee; }
    .sb-body .sc-header h4 {
        font-family: var(--mono); font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.5px; color: var(--text-primary); margin: 0;
    }
    .sb-body .sc-row {
        display: flex; align-items: baseline; gap: 0.6rem;
        padding: 0.55rem 0; font-family: var(--mono);
    }
    .sb-body .sc-row:not(:last-child) { border-bottom: 1px dashed var(--border-color); }
    .sb-body .sc-row .sc-label { font-size: 0.72rem; color: var(--text-muted); flex-shrink: 0; }
    .sb-body .sc-row .sc-label::after { content: ':'; }
    .sb-body .sc-row .sc-value {
        font-size: 0.78rem; font-weight: 600; color: #93c5fd;
        overflow-wrap: anywhere;
    }
    html.light-theme .sb-body .sc-row .sc-value { color: #2563eb; }

    .sidebar-cta {
        text-align: center; padding: 1.5rem 1.5rem 1.7rem;
        background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.14);
        border-radius: 14px; position: relative; overflow: hidden;
        backdrop-filter: blur(12px);
    }
    .sidebar-cta::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #6366f1, #8b5cf6, transparent);
        background-size: 200% 100%; animation: csCtaSweep 5s linear infinite;
    }
    @keyframes csCtaSweep { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    .sidebar-cta p {
        font-family: var(--mono); font-size: 0.82rem; color: var(--text-secondary); margin-bottom: 1.1rem;
    }
    .sidebar-cta .btn-cta {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.7rem 1.4rem;
        background: linear-gradient(135deg, #3b82f6, #6366f1, #8b5cf6);
        background-size: 200% 200%; color: #fff; border: none;
        border-radius: 12px; font-size: 0.85rem; font-weight: 700;
        font-family: var(--mono);
        cursor: pointer; text-decoration: none;
        transition: all 0.4s ease; animation: csCtaShimmer 3s ease infinite;
        position: relative; overflow: hidden;
    }
    .btn-cta::before { content: '❯ '; color: #a5f3fc; font-weight: 700; }
    @keyframes csCtaShimmer {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .sidebar-cta .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(99, 102, 241, 0.3); color: #fff;
    }

    /* ===== Responsive ===== */
    @media (max-width: 968px) {
        .cs-body { grid-template-columns: 1fr; }
        .cs-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    }

    @media (max-width: 768px) {
        .cs-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .cs-container { padding: 0 1rem; }
        .cs-shell { border-radius: 14px; }
        .cs-bar { padding: 0.5rem 0.8rem; }
        .cs-file { font-size: 0.66rem; }
        .cs-cmd { font-size: 0.7rem; padding: 0.45rem 0.8rem; min-height: 2rem; }
        .cs-cursor { width: 7px; height: 13px; }
        .cs-inner { padding: 1.1rem; }
        .cs-foot { padding: 0.5rem 0.8rem; }
        .top-bar { margin-bottom: 1.4rem; }
        .cs-image-wrap { aspect-ratio: 16 / 9; border-radius: 12px; margin-bottom: 1.4rem; }
        .cs-hero-content { margin-bottom: 2.2rem; padding: 0; }
        .cs-hero-content h1 { font-size: 1.5rem; }
        .csb-body, .custech-body { padding: 1.3rem 1.2rem; }
        .csb-body p, .custech-body p { font-size: 0.84rem; }
        .cs-sidebar { grid-template-columns: 1fr; }
        .sb-body { padding: 1.1rem 1.2rem; }
        .sidebar-cta { padding: 1.2rem 1.2rem 1.4rem; }
    }
    @media (max-width: 480px) {
        .cs-inner { padding: 0.8rem; }
        .cs-shell { border-radius: 12px; }
        .cs-file { font-size: 0.6rem; }
        .cs-cmd { font-size: 0.64rem; padding: 0.4rem 0.7rem; }
        .cs-img-bar { top: 8px; left: 8px; font-size: 0.6rem; padding: 0.28rem 0.65rem; }
        .cs-hero-content h1 { font-size: 1.25rem; }
        .cs-hero-content .hero-meta { gap: 0.45rem; }
        .cs-hero-content .hero-category, .cs-hero-content .hero-client {
            font-size: 0.64rem; padding: 0.25rem 0.7rem;
        }
        .csb-body, .custech-body { padding: 1.1rem 1rem; }
        .back-link { font-size: 0.7rem; padding: 0.45rem 0.9rem; }
    }
</style>

<div class="cs-detail-page">
    <div class="cs-container">
        <div class="cs-shell">
            <div class="cs-bar">
                <span class="ab-dot red"></span>
                <span class="ab-dot yellow"></span>
                <span class="ab-dot green"></span>
                <span class="cs-file"><i class="bi bi-file-earmark-text-fill"></i> ~/portfolio/case-studies/{{ $caseStudy->id }}.md</span>
                <span class="cs-branch"><i class="bi bi-git"></i> main</span>
            </div>

            <div class="cs-inner">
                <div class="top-bar cs-rv">
                    <a href="/#case-studies" class="back-link">
                        <span>{{ __('messages.back') }}</span>
                    </a>
                </div>

                <div class="cs-image-wrap cs-rv">
                    @if($caseStudy->image)
                        <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}">
                    @else
                        <div class="img-fallback">
                            <i class="bi bi-folder2-open"></i>
                        </div>
                    @endif
                    <span class="cs-scan" aria-hidden="true"></span>
                    <div class="cs-img-bar static"><i class="bi bi-image-fill"></i> ./screenshot.png</div>
                </div>

                <div class="cs-hero-content cs-rv">
                    <div class="hero-meta">
                        @if($caseStudy->category)
                            <span class="hero-category"><i class="bi bi-tag-fill"></i> --category={{ $caseStudy->category }}</span>
                        @endif
                        @if($caseStudy->client)
                            <span class="hero-client"><i class="bi bi-building"></i> --client={{ $caseStudy->client }}</span>
                        @endif
                    </div>
                    <h1>{{ $caseStudy->title }}</h1>
                </div>

                <div class="cs-body">
                    <div class="cs-main">
                        @if($caseStudy->problem)
                            <div class="cs-block cs-rv">
                                <div class="csb-bar csb-problem">
                                    <span class="ab-dot red"></span>
                                    <span class="ab-dot yellow"></span>
                                    <span class="ab-dot green"></span>
                                    <span class="csb-file"><i class="bi bi-file-earmark-code"></i> PROBLEM.md</span>
                                </div>
                                <div class="csb-body">
                                    <div class="block-header">
                                        <div class="block-icon ic-problem"><i class="bi bi-exclamation-triangle-fill"></i></div>
                                        <span class="block-label lb-problem">>> {{ __('messages.problem') }}</span>
                                    </div>
                                    <p>{{ $caseStudy->problem }}</p>
                                </div>
                            </div>
                        @endif

                        @if($caseStudy->solution)
                            <div class="cs-block cs-rv">
                                <div class="csb-bar csb-solution">
                                    <span class="ab-dot red"></span>
                                    <span class="ab-dot yellow"></span>
                                    <span class="ab-dot green"></span>
                                    <span class="csb-file"><i class="bi bi-file-earmark-code"></i> SOLUTION.md</span>
                                </div>
                                <div class="csb-body">
                                    <div class="block-header">
                                        <div class="block-icon ic-solution"><i class="bi bi-lightbulb-fill"></i></div>
                                        <span class="block-label lb-solution">>> {{ __('messages.solution') }}</span>
                                    </div>
                                    <p>{{ $caseStudy->solution }}</p>
                                </div>
                            </div>
                        @endif

                        @if($caseStudy->result)
                            <div class="cs-block cs-rv">
                                <div class="csb-bar csb-result">
                                    <span class="ab-dot red"></span>
                                    <span class="ab-dot yellow"></span>
                                    <span class="ab-dot green"></span>
                                    <span class="csb-file"><i class="bi bi-file-earmark-code"></i> RESULT.md</span>
                                </div>
                                <div class="csb-body">
                                    <div class="block-header">
                                        <div class="block-icon ic-result"><i class="bi bi-graph-up-arrow"></i></div>
                                        <span class="block-label lb-result">>> {{ __('messages.result') }}</span>
                                    </div>
                                    <p>{{ $caseStudy->result }}</p>
                                </div>
                            </div>
                        @endif

                        @if($caseStudy->technologies)
                            <div class="cs-tech-wrap cs-rv">
                                <div class="custech-bar">
                                    <span class="ab-dot red"></span>
                                    <span class="ab-dot yellow"></span>
                                    <span class="ab-dot green"></span>
                                    <span class="custech-file"><i class="bi bi-file-earmark-code"></i> stack.config</span>
                                </div>
                                <div class="custech-body">
                                    <div class="tech-header">
                                        <div class="tech-icon"><i class="bi bi-cpu-fill"></i></div>
                                        <span class="tech-label">>> {{ __('messages.technologies_used') }}</span>
                                    </div>
                                    <div class="cs-tech-list">
                                        @foreach($caseStudy->tech_list as $tech)
                                            <span class="cs-tech-item" style="--i: {{ min($loop->index, 10) }}">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="cs-sidebar">
                        <div class="sidebar-card cs-rv">
                            <div class="sb-bar">
                                <span class="ab-dot red"></span>
                                <span class="ab-dot yellow"></span>
                                <span class="ab-dot green"></span>
                                <span class="sb-file"><i class="bi bi-file-earmark-text"></i> info.txt</span>
                            </div>
                            <div class="sb-body">
                                <div class="sc-header">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <h4>> {{ __('messages.project_details') }}</h4>
                                </div>
                                @if($caseStudy->client)
                                    <div class="sc-row">
                                        <span class="sc-label">{{ __('messages.client') }}</span>
                                        <span class="sc-value">{{ $caseStudy->client }}</span>
                                    </div>
                                @endif
                                @if($caseStudy->category)
                                    <div class="sc-row">
                                        <span class="sc-label">{{ __('messages.category') }}</span>
                                        <span class="sc-value">{{ $caseStudy->category }}</span>
                                    </div>
                                @endif
                                <div class="sc-row">
                                    <span class="sc-label">{{ __('messages.status') }}</span>
                                    <span class="sc-value" style="color:#34d399;">&#10003; {{ __('messages.completed') }}</span>
                                </div>
                            </div>
                        </div>

                        @if($caseStudy->url)
                            <div class="sidebar-cta cs-rv">
                                <p><span class="cs-prompt">$</span> git clone {{ parse_url($caseStudy->url, PHP_URL_HOST) ?: $caseStudy->url }}</p>
                                <a href="{{ $caseStudy->url }}" target="_blank" rel="noopener noreferrer" class="btn-cta">
                                    <i class="bi bi-box-arrow-up-right"></i> {{ __('messages.live_demo') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="cs-foot">
                <span class="cs-exit"><i class="bi bi-check-circle"></i> exit code 0</span>
                <span class="cs-loc">~/portfolio/case-studies/{{ $caseStudy->id }}</span>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // ===== Spotlight cursor tracking =====
    var selectors = '.back-link, .cs-image-wrap, .cs-block, .cs-tech-wrap, .sidebar-card';
    document.querySelectorAll(selectors).forEach(function(el) {
        var rafId = null;
        el.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shx', x + '%');
                self.style.setProperty('--shy', y + '%');
                rafId = null;
            });
        });
        el.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shx', '50%');
            this.style.setProperty('--shy', '50%');
        });
    });

    // ===== Typewriter command =====
    var cmdEl = document.getElementById('csCmdText');
    if (cmdEl) {
        var text = cmdEl.getAttribute('data-text') || '';
        var i = 0, speed = 45;
        function type() {
            if (i < text.length) {
                cmdEl.textContent = text.slice(0, ++i);
                setTimeout(type, speed);
            }
        }
        setTimeout(type, 450);
    }

    // ===== Scroll reveal =====
    var revealEls = document.querySelectorAll('.cs-rv');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function(entries) {
            entries.forEach(function(en) {
                if (en.isIntersecting) {
                    en.target.classList.add('in');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(function(el, i) {
            el.style.transitionDelay = (i % 4) * 0.07 + 's';
            io.observe(el);
        });
    } else {
        revealEls.forEach(function(el) { el.classList.add('in'); });
    }
})();
</script>
@endsection