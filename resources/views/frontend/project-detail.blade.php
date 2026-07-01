@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #0a0f1e;
        --bg-secondary: #0f172a;
        --bg-card: rgba(17, 28, 46, 0.8);
        --accent: #3b82f6;
        --accent-light: #60a5fa;
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: rgba(59, 130, 246, 0.12);
        --radius-lg: 20px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
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

    .project-detail-page {
        padding-top: 80px;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-primary);
    }

    .pd-container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }

    .top-bar {
        display: flex; align-items: center;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.4rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 50px;
        color: var(--text-secondary); text-decoration: none;
        font-size: 0.85rem; font-weight: 500;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .back-link:hover {
        border-color: rgba(59,130,246,0.3); color: var(--accent-light);
        transform: translateX(-4px); box-shadow: 0 4px 20px rgba(59,130,246,0.08);
    }

    .pd-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 24px; overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 25px 80px rgba(0,0,0,0.3);
        background: var(--bg-secondary);
        position: relative;
    }
    .pd-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
    }
    .pd-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1a1a3e 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .pd-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.2; color: var(--accent); }

    .pd-hero-content { margin-bottom: 2.5rem; padding: 0 0.5rem; }
    .pd-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .pd-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff; padding: 0.35rem 1.2rem; border-radius: 50px;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.3px;
    }
    .pd-hero-content .hero-category i { font-size: 0.7rem; }
    .pd-hero-content h1 {
        font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 900;
        color: var(--text-primary); margin: 0; letter-spacing: -1px;
        line-height: 1.15;
    }

    .pd-body {
        display: grid; grid-template-columns: 1fr 320px; gap: 2rem;
        align-items: start;
    }

    .pd-main { display: flex; flex-direction: column; gap: 1.5rem; }

    .pd-desc-block {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2rem 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .pd-desc-block:hover {
        border-color: rgba(99,102,241,0.2);
        box-shadow: 0 8px 30px rgba(99,102,241,0.06);
    }
    .pd-desc-block p {
        color: var(--text-secondary); font-size: 1rem; line-height: 1.8; margin: 0;
    }

    .pd-tech-wrap {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2rem 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px);
    }
    .pd-tech-wrap .tech-header {
        display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;
    }
    .pd-tech-wrap .tech-header .tech-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(139,92,246,0.1); color: #a78bfa;
        font-size: 1rem;
    }
    .pd-tech-wrap .tech-header .tech-label {
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px; color: #a78bfa;
    }
    .pd-tech-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .pd-tech-item {
        font-size: 0.78rem; font-weight: 600; padding: 0.35rem 1.1rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.08), rgba(139,92,246,0.08));
        color: var(--accent-light); border-radius: 50px;
        border: 1px solid rgba(99,102,241,0.06);
        transition: var(--transition);
    }
    .pd-tech-item:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(139,92,246,0.15));
        border-color: rgba(99,102,241,0.15); transform: translateY(-2px);
    }

    .pd-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }

    .sidebar-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 1.8rem; position: relative;
        overflow: hidden; backdrop-filter: blur(12px);
    }
    .sidebar-card .sc-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.2rem;
        padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);
    }
    .sidebar-card .sc-header i { font-size: 1.1rem; color: var(--accent-light); }
    .sidebar-card .sc-header h4 {
        font-size: 0.85rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px; color: var(--text-primary); margin: 0;
    }
    .sidebar-card .sc-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.6rem 0;
    }
    .sidebar-card .sc-row:not(:last-child) { border-bottom: 1px solid var(--border-color); }
    .sidebar-card .sc-row .sc-label {
        font-size: 0.78rem; color: var(--text-muted); min-width: 80px;
    }
    .sidebar-card .sc-row .sc-value {
        font-size: 0.85rem; font-weight: 600; color: var(--text-primary);
    }

    .sidebar-links { display: flex; flex-direction: column; gap: 0.75rem; }
    .sidebar-link {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.85rem 1.4rem;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 16px; color: var(--text-primary);
        text-decoration: none; font-weight: 600; font-size: 0.88rem;
        transition: var(--transition); backdrop-filter: blur(12px);
    }
    .sidebar-link:hover {
        border-color: rgba(99,102,241,0.25);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(99,102,241,0.08);
    }
    .sidebar-link i { font-size: 1.1rem; }

    @media (max-width: 968px) {
        .pd-body { grid-template-columns: 1fr; }
        .pd-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    }

    @media (max-width: 768px) {
        .project-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .pd-container { padding: 0 1rem; }
        .pd-image-wrap { aspect-ratio: 16 / 9; border-radius: 16px; margin-bottom: 1.5rem; }
        .pd-hero-content { margin-bottom: 1.5rem; padding: 0; }
        .pd-hero-content h1 { font-size: 1.6rem; }
        .pd-desc-block { padding: 1.5rem; }
        .pd-tech-wrap { padding: 1.5rem; }
        .pd-sidebar { grid-template-columns: 1fr; }
        .sidebar-card { padding: 1.4rem; }
    }

    @media (max-width: 480px) {
        .pd-image-wrap { aspect-ratio: 16 / 9; border-radius: 12px; }
        .pd-hero-content h1 { font-size: 1.3rem; }
        .pd-hero-content .hero-meta { gap: 0.5rem; }
        .pd-hero-content .hero-category { font-size: 0.7rem; padding: 0.25rem 0.9rem; }
        .pd-desc-block { padding: 1.2rem; border-radius: 16px; }
        .pd-tech-wrap { padding: 1.2rem; }
    }
</style>

<div class="project-detail-page">
    <div class="pd-container">
        <div class="top-bar">
            <a href="/#projects" class="back-link">
                <i class="bi bi-arrow-left"></i> {{ __('messages.back') }}
            </a>
        </div>

        <div class="pd-image-wrap">
            @if($project->image)
                <img src="{{ config('app.storage_url') }}{{ $project->image }}" alt="{{ $project->title }}">
            @else
                <div class="img-fallback">
                    <i class="bi bi-folder2-open"></i>
                </div>
            @endif
        </div>

        <div class="pd-hero-content">
            <div class="hero-meta">
                @if($project->category)
                    <span class="hero-category"><i class="bi bi-tag-fill"></i> {{ $project->category }}</span>
                @endif
            </div>
            <h1>{{ $project->title }}</h1>
        </div>

        <div class="pd-body">
            <div class="pd-main">
                @if($project->description)
                    <div class="pd-desc-block">
                        <p>{{ $project->description }}</p>
                    </div>
                @endif

                @if($project->tech_stack)
                    <div class="pd-tech-wrap">
                        <div class="tech-header">
                            <div class="tech-icon"><i class="bi bi-cpu-fill"></i></div>
                            <span class="tech-label">{{ __('messages.technologies_used') }}</span>
                        </div>
                        <div class="pd-tech-list">
                            @foreach($project->getTechStackArray() as $tech)
                                <span class="pd-tech-item">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="pd-sidebar">
                <div class="sidebar-card">
                    <div class="sc-header">
                        <i class="bi bi-info-circle-fill"></i>
                        <h4>{{ __('messages.project_details') }}</h4>
                    </div>
                    @if($project->category)
                        <div class="sc-row">
                            <span class="sc-label">{{ __('messages.category') }}</span>
                            <span class="sc-value">{{ $project->category }}</span>
                        </div>
                    @endif
                    <div class="sc-row">
                        <span class="sc-label">{{ __('messages.status') }}</span>
                        <span class="sc-value" style="color: #10b981;">{{ __('messages.completed') }}</span>
                    </div>
                </div>

                @if($project->live_link || $project->github_link)
                    <div class="sidebar-links">
                        @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank" rel="noopener noreferrer" class="sidebar-link" style="background: linear-gradient(135deg, rgba(59,130,246,0.06), rgba(99,102,241,0.06));">
                                <i class="bi bi-box-arrow-up-right" style="color: var(--accent-light);"></i>
                                {{ __('messages.live_demo') }}
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="sidebar-link">
                                <i class="bi bi-github" style="color: #94a3b8;"></i>
                                {{ __('messages.source') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
