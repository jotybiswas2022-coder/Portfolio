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
        --radius-xl: 24px;
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

    .gig-detail-page {
        padding-top: 90px;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-primary);
        position: relative;
    }
    .gig-detail-page::before {
        content: ''; position: fixed; top: -30%; right: -15%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(99,102,241,0.05) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .gd-container { max-width: 1000px; margin: 0 auto; padding: 0 1.25rem; position: relative; z-index: 1; }

    /* window dots — defined locally so every bar renders on this page too */
    .ab-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .ab-dot.red { background: #ff5f57; }
    .ab-dot.yellow { background: #febc2e; }
    .ab-dot.green { background: #28c840; }

    /* ===== MAIN TERMINAL SHELL ===== */
    .gd-shell {
        position: relative;
        border: 1px solid rgba(147, 197, 253, 0.2);
        border-radius: 20px; overflow: hidden;
        background: rgba(13, 20, 40, 0.35);
        -webkit-backdrop-filter: blur(18px) saturate(150%); backdrop-filter: blur(18px) saturate(150%);
        box-shadow: 0 40px 120px rgba(2, 8, 23, 0.55);
    }
    html.light-theme .gd-shell {
        background: rgba(255, 255, 255, 0.78);
        border-color: rgba(59, 130, 246, 0.25);
        box-shadow: 0 40px 100px rgba(59, 130, 246, 0.12);
    }
    .gd-shell::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, #3b82f6, #8b5cf6, transparent);
        background-size: 200% 100%; animation: gdSweep 6s linear infinite;
        z-index: 5; pointer-events: none;
    }
    @keyframes gdSweep { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

    .gd-bar {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.6rem 0.9rem;
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .gd-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .gd-file {
        margin-left: 0.35rem; font-family: var(--mono); font-size: 0.72rem; color: #cbd5e1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        display: inline-flex; align-items: center; gap: 0.4rem;
    }
    html.light-theme .gd-file { color: #334155; }
    .gd-file i { color: #818cf8; font-size: 0.72rem; }
    .gd-branch {
        margin-left: auto; flex-shrink: 0; white-space: nowrap;
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-family: var(--mono); font-size: 0.58rem; font-weight: 700; letter-spacing: 0.4px;
        color: #93c5fd; background: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.26);
        padding: 0.14rem 0.5rem; border-radius: 50px;
    }
    html.light-theme .gd-branch { color: #2563eb; }



    .gd-inner { padding: 2rem; position: relative; z-index: 1; }
    .gd-foot {
        display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; flex-wrap: wrap;
        padding: 0.6rem 1rem; font-family: var(--mono); font-size: 0.64rem; color: #64748b;
        background: rgba(2, 8, 23, 0.28); border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    html.light-theme .gd-foot { background: rgba(15, 23, 42, 0.04); border-top-color: rgba(15, 23, 42, 0.08); }
    .gd-exit { display: inline-flex; align-items: center; gap: 0.35rem; color: #34d399; }
    .gd-exit i { font-size: 0.7rem; }
    .gd-loc { color: #475569; }
    html.light-theme .gd-loc { color: #64748b; }

    /* ===== Reveal animation ===== */
    .gd-rv {
        opacity: 0; transform: translateY(26px);
        transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gd-rv.in { opacity: 1; transform: none; }

    /* ===== Back bar ===== */
    .top-bar {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.8rem; flex-wrap: wrap; gap: 1rem;
    }
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
    .gd-crumb {
        display: inline-flex; align-items: center; gap: 0.4rem; min-width: 0;
        font-family: var(--mono); font-size: 0.68rem; color: var(--text-muted);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .gd-crumb i { color: #818cf8; }
    .gd-crumb-sep { color: #475569; }
    .gd-from {
        flex-shrink: 0; display: inline-flex; align-items: center; gap: 0.4rem; margin-left: auto;
        font-family: var(--mono); font-size: 0.68rem; font-weight: 700;
        color: #34d399; background: rgba(52, 211, 153, 0.08);
        border: 1px solid rgba(52, 211, 153, 0.22);
        padding: 0.3rem 0.7rem; border-radius: 8px; white-space: nowrap;
    }
    html.light-theme .gd-from { color: #047857; }

    /* ===== Hero image ===== */
    .gd-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 16px; overflow: hidden;
        margin-bottom: 2rem; position: relative;
        box-shadow: 0 30px 90px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-color);
        background: var(--bg-secondary);
    }
    .gd-img-bar {
        position: absolute; top: 12px; left: 12px; z-index: 3;
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.35rem 0.8rem; border-radius: 9px;
        background: rgba(8, 12, 24, 0.72); border: 1px solid rgba(147, 197, 253, 0.25);
        -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px);
        font-family: var(--mono); font-size: 0.66rem; color: #cbd5e1;
        opacity: 0; transform: translateY(-8px); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gd-image-wrap:hover .gd-img-bar, .gd-img-bar.static { opacity: 1; transform: none; }
    html.light-theme .gd-img-bar { background: rgba(15, 23, 42, 0.75); color: #e2e8f0; }
    .gd-img-bar i { color: #818cf8; font-size: 0.7rem; }
    .gd-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gd-image-wrap:hover img { transform: scale(1.03); }
    .gd-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1a1a3e 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .gd-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.15; color: var(--accent); }
    .gd-image-wrap::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(99,102,241,0.3) 0%, rgba(99,102,241,0.08) 30%, transparent 60%);
        pointer-events: none; z-index: 1; opacity: 0; transition: opacity 0.5s ease;
    }
    .gd-image-wrap:hover::after { opacity: 1; }
    /* scanner that sweeps the preview once, the moment the card reveals */
    .gd-scan {
        position: absolute; left: 0; right: 0; top: 0; height: 35%; z-index: 2;
        background: linear-gradient(180deg, transparent, rgba(34, 211, 238, 0.18), transparent);
        transform: translateY(-140%); pointer-events: none;
    }
    .gd-image-wrap.in .gd-scan { animation: gdImgScan 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.25s 1 forwards; }
    @keyframes gdImgScan { to { transform: translateY(330%); } }

    /* ===== Hero content ===== */
    .gd-hero-content { margin-bottom: 2.8rem; padding: 0 0.2rem; }
    .gd-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .gd-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff; font-family: var(--mono); font-size: 0.72rem; font-weight: 700;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.28);
    }
    .gd-hero-content .hero-badge-meta {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        font-family: var(--mono); font-size: 0.72rem; font-weight: 600;
        background: rgba(34, 197, 94, 0.08); color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.18);
    }
    html.light-theme .gd-hero-content .hero-badge-meta {
        background: rgba(34, 197, 94, 0.07); color: #15803d; border-color: rgba(34, 197, 94, 0.2);
    }
    .gd-hero-content .hero-badge-meta i { font-size: 0.7rem; }
    .gd-hero-content h1 {
        font-size: clamp(1.7rem, 3.6vw, 2.7rem); font-weight: 900;
        color: var(--text-primary); margin: 0 0 0.5rem; letter-spacing: -1px; line-height: 1.12;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    html.light-theme .gd-hero-content h1 {
        background: linear-gradient(135deg, #0f172a 0%, #3b82f6 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .gd-hero-content h1::before {
        content: '>'; margin-right: 0.4rem; color: #22d3ee; -webkit-text-fill-color: #22d3ee;
        font-weight: 700;
    }
    .gd-hero-content .hero-sub {
        font-family: var(--mono); font-size: 0.92rem; color: var(--text-secondary);
        line-height: 1.75; max-width: 640px; margin: 0;
    }

    /* ===== Description (terminal file) ===== */
    .gd-description-wrap { max-width: 800px; margin: 0 auto 3rem; }
    .gd-description-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition); position: relative;
    }
    html.light-theme .gd-description-card { background: rgba(255,255,255,0.9); }
    .gd-description-card:hover {
        border-color: rgba(99, 102, 241, 0.3); box-shadow: 0 14px 40px rgba(99, 102, 241, 0.08);
    }
    .gd-desc-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.85rem; font-family: var(--mono);
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .gd-desc-bar { background: rgba(15,23,42,0.035); border-bottom-color: rgba(15,23,42,0.08); }
    .gd-desc-file {
        font-size: 0.68rem; color: #94a3b8;
        display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 0.35rem;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .gd-desc-file i { color: #60a5fa; font-size: 0.72rem; }
    .gd-desc-body { padding: 1.5rem 1.6rem; }
    .gd-desc-body .desc-label {
        font-family: var(--mono); font-size: 0.66rem; font-weight: 700;
        letter-spacing: 0.8px; text-transform: uppercase; color: #818cf8;
        margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.45rem;
    }
    html.light-theme .gd-desc-body .desc-label { color: #4f46e5; }
    /* line-numbered listing — like opening the file in an editor */
    .desc-code { display: flex; flex-direction: column; }
    .desc-line {
        display: flex; align-items: flex-start; gap: 0.7rem;
        font-family: var(--mono); font-size: 0.88rem; line-height: 1.85;
        color: var(--text-secondary); padding: 0.1rem 0.35rem; border-radius: 6px;
        transition: background 0.25s ease;
    }
    .desc-line:hover { background: rgba(59, 130, 246, 0.05); }
    .desc-txt { min-width: 0; word-break: break-word; }
    /* the listing cascades in when the card reveals */
    .gd-description-wrap.in .desc-line { animation: descIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; animation-delay: calc(var(--i, 0) * 45ms); }
    @keyframes descIn { from { opacity: 0; transform: translateY(7px); } to { opacity: 1; transform: none; } }

    /* ===== Pricing ===== */
    .pricing-section-title { text-align: center; margin-bottom: 2rem; }
    .pricing-section-title h2 {
        font-size: 1.7rem; font-weight: 800;
        color: var(--text-primary); margin-bottom: 0.4rem; letter-spacing: -0.5px;
        font-family: var(--mono);
    }
    .pricing-section-title h2::before { content: '> '; color: #22d3ee; }
    .pricing-section-title p {
        color: var(--text-secondary); font-size: 0.9rem; margin: 0;
    }
    .pricing-section-title .title-line {
        width: 50px; height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        margin: 0.8rem auto 0; border-radius: 2px;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.4rem;
        margin: 0 auto;
    }

    .pricing-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; overflow: hidden;
        text-align: left;
        transition: all 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        backdrop-filter: blur(12px);
        display: flex; flex-direction: column;
    }
    html.light-theme .pricing-card { background: rgba(255,255,255,0.9); }
    .pricing-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 16px 45px rgba(99, 102, 241, 0.1);
        transform: translateY(-6px);
    }
    .pkg-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 0.85rem; font-family: var(--mono); font-size: 0.66rem; color: #94a3b8;
        background: rgba(255,255,255,0.035); border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    html.light-theme .pkg-bar { background: rgba(15,23,42,0.045); border-bottom-color: rgba(15,23,42,0.08); }
    .pkg-file { display: inline-flex; align-items: center; gap: 0.4rem; min-width: 0; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
    .pkg-file i { color: #60a5fa; font-size: 0.72rem; }
    .pkg-flag {
        margin-left: auto; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.6px;
        color: #34d399; border: 1px solid rgba(52, 211, 153, 0.35);
        padding: 0.12rem 0.5rem; border-radius: 4px;
        flex-shrink: 0;
    }
    .pkg-body { padding: 1.4rem 1.4rem 1.45rem; display: flex; flex-direction: column; flex: 1; position: relative; }
    .pkg-icon {
        width: 42px; height: 42px; margin-bottom: 0.8rem;
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.12);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: var(--accent-light);
        transition: all 0.4s ease;
    }
    .pricing-card:hover .pkg-icon {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-color: transparent; color: #fff;
        transform: scale(1.1) rotate(-3deg);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.25);
    }
    .pkg-name {
        font-family: var(--mono); font-size: 1.02rem; font-weight: 700;
        color: var(--text-primary); margin-bottom: 0.25rem;
    }
    .pkg-name::before { content: '~ '; color: #22d3ee; font-weight: 700; }
    .pkg-subtitle {
        font-family: var(--mono); font-size: 0.72rem; color: var(--text-muted);
        margin-bottom: 1rem;
    }
    .pkg-price {
        font-family: var(--mono); font-size: 2.2rem; font-weight: 800;
        color: var(--accent-light); line-height: 1; margin-bottom: 0.25rem;
        display: flex; align-items: baseline; gap: 0.15rem;
    }
    .pkg-price .currency { font-size: 1.1rem; font-weight: 600; }
    .pkg-duration {
        font-family: var(--mono); font-size: 0.72rem; color: var(--text-muted);
        margin-bottom: 1.2rem;
    }
    .pkg-divider {
        width: 100%; height: 1px; margin-bottom: 0.6rem;
        background: linear-gradient(90deg, var(--border-color), transparent);
    }

    .pricing-features {
        list-style: none; padding: 0; margin: 0 0 1.3rem;
        flex: 1;
    }
    .pricing-features li {
        padding: 0.5rem 0; color: var(--text-secondary);
        font-family: var(--mono); font-size: 0.8rem;
        display: flex; align-items: center; gap: 0.5rem;
        border-bottom: 1px dashed var(--border-color);
        transition: all 0.3s ease;
    }
    .pricing-features li:last-child { border-bottom: none; }
    .pricing-features li .feat-plus {
        color: #22d55e; font-weight: 700; width: 18px; flex-shrink: 0;
        display: inline-block; transition: transform 0.3s ease;
    }
    .pricing-card:hover .pricing-features li .feat-plus { transform: scale(1.35); }
    /* features tick in one by one when the card reveals */
    .pricing-card.in .pricing-features li { animation: featIn 0.45s cubic-bezier(0.16, 1, 0.3, 1) both; animation-delay: calc(var(--i, 0) * 55ms + 0.1s); }
    @keyframes featIn { from { opacity: 0; transform: translateX(-6px); } to { opacity: 1; transform: none; } }
    .pricing-features li .feature-text { flex: 1; text-align: left; }

    .btn-order {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 0.6rem; width: 100%;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff; border: none; border-radius: 12px;
        font-weight: 700; font-size: 0.9rem;
        font-family: var(--mono);
        text-decoration: none; cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
        position: relative; overflow: hidden; z-index: 1;
    }
    .btn-order::before {
        content: '❯ '; color: #7dd3fc; font-weight: 700; flex-shrink: 0;
    }
    .btn-order i { font-size: 0.95rem; transition: transform 0.4s ease; flex-shrink: 0; }
    .btn-order:hover i { transform: translateX(4px); }
    .btn-order::after {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.14), transparent);
        transition: left 0.6s ease;
    }
    .btn-order:hover::after { left: 100%; }
    .btn-order:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4); color: #fff;
    }

    .pricing-card.featured {
        border-color: rgba(59, 130, 246, 0.35);
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.08), 0 10px 40px rgba(0, 0, 0, 0.15);
        transform: scale(1.03); z-index: 2;
    }
    .pricing-card.featured:hover {
        transform: scale(1.03) translateY(-6px);
        box-shadow: 0 0 60px rgba(99, 102, 241, 0.14), 0 16px 50px rgba(0, 0, 0, 0.2);
    }
    .pricing-card.featured .pkg-bar { background: rgba(59, 130, 246, 0.08); }
    .featured-tag {
        position: absolute; top: 0.9rem; right: 0.9rem; z-index: 2;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: #fff; padding: 0.25rem 0.8rem; border-radius: 8px;
        font-family: var(--mono); font-size: 0.62rem; font-weight: 700;
        letter-spacing: 0.6px; text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }
    @media (max-width: 968px) {
        .pricing-grid { grid-template-columns: repeat(2, 1fr); gap: 1.3rem; }
        .pricing-card.featured { grid-column: 1 / -1; max-width: 500px; margin: 0 auto; }
        .pricing-card.featured:hover { transform: translateY(-6px); }
    }

    /* ===== Suggested gigs ===== */
    .suggested-section { margin-top: 4rem; }
    .suggested-header { text-align: center; margin-bottom: 2.2rem; }
    .suggested-header h2 {
        font-size: 1.7rem; font-weight: 800; color: var(--text-primary);
        margin-bottom: 0.4rem; letter-spacing: -0.5px; font-family: var(--mono);
    }
    .suggested-header h2::before { content: '> '; color: #22d3ee; }
    .suggested-header p { color: var(--text-secondary); font-size: 0.9rem; margin: 0; }
    .suggested-header .title-line {
        width: 50px; height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        margin: 0.8rem auto 0; border-radius: 2px;
    }
    .suggested-grid {
        display: flex; flex-wrap: wrap; justify-content: center; gap: 1.5rem;
    }
    .suggested-card {
        width: calc(33.333% - 1rem);
        min-width: 260px; max-width: 360px; flex-shrink: 0;
        display: block; text-decoration: none;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 16px; overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); position: relative;
    }
    html.light-theme .suggested-card { background: rgba(255, 255, 255, 0.92); }
    .suggested-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 20px 60px rgba(99, 102, 241, 0.1);
        transform: translateY(-6px);
    }
    .suggested-card .sc-image {
        height: 180px; position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; background: var(--bg-secondary);
    }
    .suggested-card .sc-image img {
        width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .suggested-card:hover .sc-image img { transform: scale(1.08); }
    .suggested-card .sc-image .sc-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1a1a3e 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .suggested-card .sc-image .sc-fallback i { font-size: 3.5rem; opacity: 0.12; color: var(--accent); }
    .sc-bar {
        position: absolute; top: 10px; left: 10px; z-index: 2;
        display: flex; align-items: center; gap: 0.45rem;
        padding: 0.3rem 0.7rem; border-radius: 8px;
        background: rgba(8, 12, 24, 0.72); border: 1px solid rgba(147, 197, 253, 0.25);
        -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px);
        font-family: var(--mono); font-size: 0.62rem; color: #cbd5e1;
    }
    html.light-theme .sc-bar { background: rgba(15, 23, 42, 0.75); color: #e2e8f0; }
    .sc-bar i { color: #818cf8; font-size: 0.68rem; }
    .suggested-card .sc-image::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 60px;
        background: linear-gradient(transparent, rgba(10, 15, 30, 0.95)); pointer-events: none; z-index: 1;
    }
    html.light-theme .suggested-card .sc-image::after { background: linear-gradient(transparent, rgba(248, 250, 252, 0.9)); }
    .suggested-card .sc-body { padding: 1.2rem 1.4rem 1.4rem; position: relative; z-index: 2; }
    .suggested-card .sc-body h3 {
        font-family: var(--mono); font-size: 1rem; font-weight: 700;
        margin-bottom: 0.4rem; color: var(--text-primary); line-height: 1.35;
    }
    .suggested-card .sc-body h3::before { content: '> '; color: #22d3ee; }
    .suggested-card .sc-body p {
        color: var(--text-secondary); font-family: var(--mono); font-size: 0.8rem; line-height: 1.6;
        margin-bottom: 1rem; overflow: hidden;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    }
    .sc-price {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.28rem 0.9rem;
        background: rgba(59, 130, 246, 0.1); color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.22); border-radius: 8px;
        font-family: var(--mono); font-size: 0.76rem; font-weight: 600;
    }
    html.light-theme .sc-price { color: #2563eb; }
    .sc-price .sc-arrow { margin-left: auto; transition: transform 0.3s ease; }
    .suggested-card:hover .sc-price .sc-arrow { transform: translateX(3px); }

    /* ===== section title bars draw themselves in ===== */
    @keyframes gdLineGrow { from { transform: scaleX(0); opacity: 0; } to { transform: scaleX(1); opacity: 1; } }
    .pricing-section-title.gd-rv.in .title-line,
    .suggested-section.gd-rv.in .title-line {
        animation: gdLineGrow 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.15s both;
    }

    /* ===== Responsive ===== */
    @media (max-width: 968px) {
        .suggested-grid { gap: 1.2rem; }
    }
    @media (max-width: 768px) {
        .gig-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .gd-container { padding: 0 1rem; }
        .gd-shell { border-radius: 14px; }
        .gd-bar { padding: 0.5rem 0.8rem; }
        .gd-file { font-size: 0.66rem; }
        .gd-crumb { display: none; }
        .desc-line { font-size: 0.82rem; line-height: 1.8; gap: 0.55rem; }
        .gd-inner { padding: 1.1rem; }
        .gd-foot { padding: 0.5rem 0.8rem; }
        .top-bar { margin-bottom: 1.4rem; }
        .gd-image-wrap { border-radius: 12px; margin-bottom: 1.4rem; }
        .gd-hero-content { margin-bottom: 2.2rem; }
        .gd-hero-content h1 { font-size: 1.5rem; }
        .gd-hero-content .hero-sub { font-size: 0.84rem; }
        .pricing-grid { grid-template-columns: 1fr; gap: 1.3rem; }
        .pricing-card.featured { max-width: 100%; }
        .gd-desc-body { padding: 1.3rem 1.2rem; }
        .suggested-section { margin-top: 3rem; }
        .suggested-card { width: 100%; max-width: 400px; }
        .suggested-card .sc-image { height: 200px; }
        .pricing-section-title, .suggested-header { margin-bottom: 1.5rem; }
        .pricing-section-title h2, .suggested-header h2 { font-size: 1.4rem; margin-bottom: 0.3rem; }
        .pricing-section-title p, .suggested-header p { font-size: 0.82rem; }
        .pricing-section-title .title-line, .suggested-header .title-line {
            width: 36px; margin-top: 0.6rem;
        }
    }
    @media (max-width: 480px) {
        .gd-inner { padding: 0.8rem; }
        .gd-shell { border-radius: 12px; }
        .gd-file { font-size: 0.6rem; }
        .desc-line { font-size: 0.75rem; line-height: 1.75; padding: 0.05rem 0.2rem; }
        .gd-from { font-size: 0.62rem; padding: 0.26rem 0.6rem; }
        .gd-branch { display: none; }
        .gd-img-bar { top: 8px; left: 8px; font-size: 0.6rem; padding: 0.28rem 0.65rem; }
        .gd-hero-content h1 { font-size: 1.25rem; }
        .gd-hero-content .hero-meta { gap: 0.45rem; }
        .gd-hero-content .hero-category, .gd-hero-content .hero-badge-meta {
            font-size: 0.64rem; padding: 0.25rem 0.7rem;
        }
        .pricing-card { padding: 0; }
        .pkg-body { padding: 1.2rem 1rem 1.2rem; }
        .pkg-price { font-size: 1.9rem; }
        .pricing-features li { font-size: 0.74rem; }
        .btn-order { font-size: 0.82rem; padding: 0.65rem 1.1rem; }
        .pricing-section-title h2, .suggested-header h2 { font-size: 1.15rem; }
        .pricing-section-title p, .suggested-header p { font-size: 0.75rem; }
        .pricing-section-title, .suggested-header { margin-bottom: 1.25rem; }
        .pricing-section-title .title-line, .suggested-header .title-line {
            width: 30px; height: 2px; margin-top: 0.5rem;
        }
        .top-bar { margin-bottom: 1.2rem; }
        .back-link { font-size: 0.7rem; padding: 0.45rem 0.9rem; }
        .gd-desc-body { padding: 1.1rem 1rem; }
        .featured-tag { top: 0.7rem; right: 0.7rem; font-size: 0.56rem; padding: 0.2rem 0.65rem; }
    }

    /* ===== REDUCED MOTION ===== */
    @media (prefers-reduced-motion: reduce) {
        .gd-shell::before { animation: none; }
        .gd-rv { opacity: 1 !important; transform: none !important; }
        .gd-image-wrap.in .gd-scan { display: none; }
        .gd-description-wrap.in .desc-line,
        .pricing-card.in .pricing-features li,
        .title-line { animation: none; }
    }
</style>

@php
    // cheapest package, used by the response payload and the "from" chip
    $prices = array_filter([(float) $gig->basic_price, (float) $gig->standard_price, (float) $gig->premium_price]);
    $minPrice = $prices ? min($prices) : 0;
@endphp

<div class="gig-detail-page">
    <div class="gd-container">
        <div class="gd-shell">
            <div class="gd-bar">
                <span class="ab-dot red" aria-hidden="true"></span>
                <span class="ab-dot yellow" aria-hidden="true"></span>
                <span class="ab-dot green" aria-hidden="true"></span>
                <span class="gd-file"><i class="bi bi-file-earmark-code-fill"></i> ~/portfolio/gigs/{{ $gig->id }}.json</span>
                <span class="gd-branch"><i class="bi bi-git"></i> main</span>
            </div>

            <div class="gd-inner">
                <div class="top-bar gd-rv">
                    <a href="{{ route('home') }}#gigs" class="back-link">
                        <span>{{ __('messages.back_to_gigs') }}</span>
                    </a>
                    <span class="gd-crumb"><i class="bi bi-signpost-split-fill"></i> ~/gigs/{{ $gig->id }}<span class="gd-crumb-sep">&#8250;</span>{{ $gig->title }}</span>
                    @if($minPrice > 0)
                        <span class="gd-from"><i class="bi bi-tag-fill"></i> from ${{ number_format($minPrice, 0) }}</span>
                    @endif
                </div>

                <div class="gd-image-wrap gd-rv">
                    @if($gig->image)
                        <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                    @else
                        <div class="img-fallback">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                    <span class="gd-scan" aria-hidden="true"></span>
                    <div class="gd-img-bar static"><i class="bi bi-image-fill"></i> ./preview.png</div>
                </div>

                <div class="gd-hero-content gd-rv">
                    <div class="hero-meta">
                        <span class="hero-category"><i class="bi bi-gear-fill"></i> --type=service</span>
                        <span class="hero-badge-meta"><i class="bi bi-star-fill"></i> --premium=true</span>
                    </div>
                    <h1>{{ $gig->title }}</h1>
                    @if($gig->short_description)
                        <p class="hero-sub">{{ $gig->short_description }}</p>
                    @endif
                </div>

                @if($gig->description)
                    <div class="gd-description-wrap gd-rv">
                        <div class="gd-description-card">
                            <div class="gd-desc-bar">
                                <span class="ab-dot red" aria-hidden="true"></span>
                                <span class="ab-dot yellow" aria-hidden="true"></span>
                                <span class="ab-dot green" aria-hidden="true"></span>
                                <span class="gd-desc-file"><i class="bi bi-file-earmark-text"></i> DESCRIPTION.md</span>
                            </div>
                            <div class="gd-desc-body">
                                <div class="desc-label">
                                    <i class="bi bi-info-circle"></i> {{ __('messages.about_this_gig') }}
                                </div>
                                <div class="desc-code">
                                    @foreach(preg_split('/\r\n|\r|\n/', trim($gig->description)) as $line)
                                        <div class="desc-line" style="--i: {{ min($loop->index, 12) }}">
                                            <span class="desc-txt">@if(trim($line) === '')&nbsp;@else{{ $line }}@endif</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="pricing-section-title gd-rv">
                    <h2>{{ __('messages.pricing_plans') }}</h2>
                    <p>{{ __('messages.choose_package') }}</p>
                    <div class="title-line"></div>
                </div>

                <div class="pricing-grid">
                    <div class="pricing-card gd-rv">
                        <div class="pkg-bar">
                            <span class="ab-dot red" aria-hidden="true"></span>
                            <span class="ab-dot yellow" aria-hidden="true"></span>
                            <span class="ab-dot green" aria-hidden="true"></span>
                            <span class="pkg-file"><i class="bi bi-file-earmark-code"></i> install-basic.sh</span>
                            <span class="pkg-flag">--basic</span>
                        </div>
                        <div class="pkg-body">
                            <div class="pkg-icon"><i class="bi bi-rocket-takeoff"></i></div>
                            <div class="pkg-name">{{ $gig->basic_name ?: 'Basic' }}</div>
                            <div class="pkg-subtitle">{{ __('messages.starter_package') }}</div>
                            <div class="pkg-price"><span class="currency">$</span><span class="pkg-num" data-count="{{ (int) round((float) $gig->basic_price) }}">{{ number_format($gig->basic_price, 0) }}</span></div>
                            <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                            <div class="pkg-divider"></div>
                            @if($gig->basic_features)
                                <ul class="pricing-features">
                                    @foreach(explode("\n", $gig->basic_features) as $feature)
                                        @if(trim($feature))
                                            <li style="--i: {{ min($loop->index, 8) }}"><span class="feat-plus">+</span><span class="feature-text">{{ trim($feature) }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <form action="{{ route('inbox.order', [$gig->id, 'basic']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="pricing-card featured gd-rv">
                        <div class="featured-tag"><i class="bi bi-stars me-1"></i>{{ __('messages.popular') }}</div>
                        <div class="pkg-bar">
                            <span class="ab-dot red" aria-hidden="true"></span>
                            <span class="ab-dot yellow" aria-hidden="true"></span>
                            <span class="ab-dot green" aria-hidden="true"></span>
                            <span class="pkg-file"><i class="bi bi-file-earmark-code"></i> install-standard.sh</span>
                            <span class="pkg-flag">--standard</span>
                        </div>
                        <div class="pkg-body">
                            <div class="pkg-icon"><i class="bi bi-stars"></i></div>
                            <div class="pkg-name">{{ $gig->standard_name ?: 'Standard' }}</div>
                            <div class="pkg-subtitle">{{ __('messages.best_value') }}</div>
                            <div class="pkg-price"><span class="currency">$</span><span class="pkg-num" data-count="{{ (int) round((float) $gig->standard_price) }}">{{ number_format($gig->standard_price, 0) }}</span></div>
                            <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                            <div class="pkg-divider"></div>
                            @if($gig->standard_features)
                                <ul class="pricing-features">
                                    @foreach(explode("\n", $gig->standard_features) as $feature)
                                        @if(trim($feature))
                                            <li style="--i: {{ min($loop->index, 8) }}"><span class="feat-plus">+</span><span class="feature-text">{{ trim($feature) }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <form action="{{ route('inbox.order', [$gig->id, 'standard']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="pricing-card gd-rv">
                        <div class="pkg-bar">
                            <span class="ab-dot red" aria-hidden="true"></span>
                            <span class="ab-dot yellow" aria-hidden="true"></span>
                            <span class="ab-dot green" aria-hidden="true"></span>
                            <span class="pkg-file"><i class="bi bi-file-earmark-code"></i> install-premium.sh</span>
                            <span class="pkg-flag">--premium</span>
                        </div>
                        <div class="pkg-body">
                            <div class="pkg-icon"><i class="bi bi-gem"></i></div>
                            <div class="pkg-name">{{ $gig->premium_name ?: 'Premium' }}</div>
                            <div class="pkg-subtitle">{{ __('messages.premium_package') }}</div>
                            <div class="pkg-price"><span class="currency">$</span><span class="pkg-num" data-count="{{ (int) round((float) $gig->premium_price) }}">{{ number_format($gig->premium_price, 0) }}</span></div>
                            <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                            <div class="pkg-divider"></div>
                            @if($gig->premium_features)
                                <ul class="pricing-features">
                                    @foreach(explode("\n", $gig->premium_features) as $feature)
                                        @if(trim($feature))
                                            <li style="--i: {{ min($loop->index, 8) }}"><span class="feat-plus">+</span><span class="feature-text">{{ trim($feature) }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <form action="{{ route('inbox.order', [$gig->id, 'premium']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                @if($suggestedGigs->count() > 0)
                    <div class="suggested-section gd-rv">
                        <div class="suggested-header">
                            <h2>{{ __('messages.suggested_gigs') }}</h2>
                            <p>{{ __('messages.choose_package') }}</p>
                            <div class="title-line"></div>
                        </div>
                        <div class="suggested-grid">
                            @foreach($suggestedGigs as $suggested)
                                <a href="{{ route('gig.detail', $suggested->id) }}" class="suggested-card gd-rv">
                                    <div class="sc-image">
                                        @if($suggested->image)
                                            <img src="{{ config('app.storage_url') }}{{ $suggested->image }}" alt="{{ $suggested->title }}">
                                        @else
                                            <div class="sc-fallback">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="sc-bar"><i class="bi bi-folder-fill"></i> ./open.git</div>
                                    </div>
                                    <div class="sc-body">
                                        <h3>{{ $suggested->title }}</h3>
                                        @if($suggested->short_description)
                                            <p>{{ $suggested->short_description }}</p>
                                        @endif
                                        <span class="sc-price">
                                            {{ __('messages.starting_from') }} ${{ number_format(min($suggested->basic_price, $suggested->standard_price, $suggested->premium_price), 0) }}
                                            <i class="bi bi-arrow-right sc-arrow"></i>
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="gd-foot">
                <span class="gd-exit"><i class="bi bi-check-circle"></i> exit code 0</span>
                <span class="gd-loc">~/portfolio/gigs/{{ $gig->id }}</span>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // ===== Spot-light cursor tracking =====
    var selectors = '.back-link, .gd-image-wrap, .gd-description-card, .pricing-card, .suggested-card';
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

    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ===== Package prices count up the first time they scroll into view =====
    var counts = [].slice.call(document.querySelectorAll('.pkg-num[data-count]'));
    if (counts.length) {
        var runCount = function(el) {
            if (el.dataset.counted) return;
            el.dataset.counted = '1';

            var target = parseInt(el.getAttribute('data-count'), 10) || 0;
            if (reduce || target <= 0) return;

            var started = null, dur = 700;
            var tick = function(ts) {
                if (!started) started = ts;
                var p = Math.min((ts - started) / dur, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(target * eased).toLocaleString('en-US');
                if (p < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        };

        if ('IntersectionObserver' in window) {
            var cio = new IntersectionObserver(function(entries) {
                entries.forEach(function(en) {
                    if (!en.isIntersecting) return;
                    runCount(en.target);
                    cio.unobserve(en.target);
                });
            }, { threshold: 0.35 });
            counts.forEach(function(el) { cio.observe(el); });
        } else {
            counts.forEach(runCount);
        }
    }

    // ===== Scroll reveal =====
    var revealEls = document.querySelectorAll('.gd-rv');
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