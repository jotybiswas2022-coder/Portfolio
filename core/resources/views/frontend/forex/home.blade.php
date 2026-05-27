@extends('frontend.forex.layouts.app')

@section('title', 'DarkEAs — Premium Expert Advisors')

@section('content')
<style>
/* ===== HOME PAGE INLINE STYLES ===== */
.home-hero{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;padding-top:5rem}
.home-hero-stars{position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1}
.home-hero-noise{position:absolute;inset:0;opacity:0.03;pointer-events:none;z-index:2;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E")}
.home-hero-inner{position:relative;z-index:10;max-width:64rem;margin:0 auto;padding:0 1rem;text-align:center}
.home-hero-heading{font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;line-height:1.1;margin-bottom:1.25rem;color:#EAEAEA}
.home-hero-heading span.text-muted{color:#EAEAEA;display:inline-block}
.home-hero-desc{color:rgba(234,234,234,0.6);max-width:48rem;margin:0 auto 2rem;line-height:1.625}
.home-hero-stats{margin-top:3rem}
.home-hero-stat-number{color:#EAEAEA;font-weight:700;font-family:'JetBrains Mono',monospace}
.home-hero-stat-label{color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.25rem;transition:color 0.3s}
.home-hero-stat-label:hover{color:rgba(0,174,239,0.6)}
.home-hero-scroll{position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:0.5rem;opacity:0.4;animation:float 3s ease-in-out infinite;pointer-events:none}
/* Trusted by */
.home-trusted{background:linear-gradient(90deg,transparent,rgba(0,174,239,0.02),transparent)}
.home-logo-scroll{animation:logo-scroll 25s linear infinite}
.home-logo-scroll:hover{animation-play-state:paused}
/* CTA Section */
.home-cta-glow{position:absolute;inset:-8rem;background:linear-gradient(90deg,rgba(0,174,239,0),rgba(0,174,239,0.03),rgba(0,255,159,0));opacity:0;transition:opacity 0.7s;filter:blur(4rem);pointer-events:none}
.home-cta-card:hover .home-cta-glow{opacity:1}
@media (min-width:640px){
    .home-hero-heading{font-size:4.5rem}
    .home-hero-desc{font-size:1.125rem}
    .home-hero-stat-number{font-size:1.875rem}
}
@media (min-width:768px){
    .home-hero-heading{font-size:5.5rem}
    .home-hero-desc{font-size:1.25rem}
}
@media (min-width:1024px){
    .home-hero-heading{font-size:6rem}
}
@media (max-width:640px){
    .home-hero-heading{font-size:clamp(2.2rem,10vw,3rem)!important}
}
</style>

<!-- ==================== HERO ==================== -->
<div class="home-hero">
    <!-- Particle Stars Canvas -->
    <canvas id="heroStars" class="home-hero-stars"></canvas>

    <!-- Background Orbs & Grid -->
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>

    <!-- Noise overlay -->
    <div class="home-hero-noise"></div>

    <div class="home-hero-inner">
        <!-- Badge with shimmer -->
        <div class="badge animate-fade-in-up">
            <span class="badge-dot"></span>
            Trusted by 1M+ Traders Worldwide
        </div>

        <!-- Heading -->
        <h1 class="home-hero-heading" style="font-size:clamp(2.2rem,10vw,3rem)">
            <span class="text-muted" style="animation:fadeInUp 0.6s ease">Trade Smarter with</span><br>
            <span class="gradient-text" style="display:inline-block;animation:fadeInUp 0.6s ease 0.1s both">DarkEAs</span>
        </h1>

        <p class="home-hero-desc" style="animation:fadeInUp 0.6s ease 0.2s both;font-size:1rem">
            Institutional-grade Expert Advisors powered by AI-driven algorithms — delivering consistent returns with <span style="color:#00FF9F;font-weight:600">99.9% backtest precision</span>.
        </p>

        <!-- CTA buttons -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;animation:fadeInUp 0.6s ease 0.3s both">
            <a href="#pricing" class="btn-primary group" style="display:inline-flex;align-items:center;gap:0.5rem">
                <span style="display:flex;align-items:center;gap:0.5rem;position:relative;z-index:10">
                    Explore EAs
                    <svg style="width:1.25rem;height:1.25rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </span>
            </a>
            <a href="#features" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem">
                <span style="position:relative;z-index:10">View Pricing</span>
            </a>
        </div>

        <!-- Stats with count-up -->
        <div class="home-hero-stats" style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:1.5rem;animation:fadeInUp 0.6s ease 0.3s both">
            <style>@media (min-width:640px){.home-stats-gap{gap:2.5rem}}</style>
            <div style="cursor:default">
                <div style="font-size:1.5rem;font-weight:700;color:#EAEAEA;font-family:'JetBrains Mono',monospace">
                    <span class="count-up" data-target="1" data-suffix="M+">0</span><span>M+</span>
                </div>
                <div class="home-hero-stat-label">Active Traders</div>
            </div>
            <div class="stat-divider"></div>
            <div style="cursor:default">
                <div style="font-size:1.5rem;font-weight:700;color:#EAEAEA">
                    <span class="count-up" data-target="99.9" data-suffix="%">0</span><span>%</span>
                </div>
                <div class="home-hero-stat-label">Avg. Accuracy</div>
            </div>
            <div class="stat-divider"></div>
            <div style="cursor:default">
                <div style="font-size:1.5rem;font-weight:700;color:#EAEAEA;font-family:'JetBrains Mono',monospace">
                    <span class="count-up" data-target="4.9" data-suffix="★">0</span><span>★</span>
                </div>
                <div class="home-hero-stat-label">Avg. Rating</div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="home-hero-scroll">
        <svg style="width:1rem;height:1rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>

<!-- ==================== TRUSTED BY ==================== -->
<section style="padding-top:3rem;padding-bottom:3rem;border-top:1px solid rgba(255,255,255,0.04);border-bottom:1px solid rgba(255,255,255,0.04);position:relative;overflow:hidden">
    <div class="home-trusted" style="position:absolute;inset:0;pointer-events:none"></div>
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10">
        <style>@media (min-width:640px){.home-trusted-px{padding:0 1.5rem}}@media (min-width:1024px){.home-trusted-px{padding:0 2rem}}</style>
        <p style="text-align:center;color:rgba(234,234,234,0.3);font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:1.5rem">Trusted by Traders Worldwide</p>
        <div style="position:relative;overflow:hidden">
            <div class="logo-scroll home-logo-scroll" style="display:flex;gap:2.5rem;opacity:0.4;transition:opacity 0.5s;width:max-content" onmouseover="this.style.opacity='0.6'" onmouseout="this.style.opacity='0.4'">
                <style>@media (min-width:640px){.home-logo-gap{gap:4rem}}</style>
                @foreach(['IC Markets', 'Pepperstone', 'FXTM', 'XM', 'Exness', 'FP Markets', 'IC Markets', 'Pepperstone', 'FXTM', 'XM', 'Exness', 'FP Markets'] as $broker)
                <span style="color:#EAEAEA;font-size:0.875rem;font-weight:600;letter-spacing:0.05em;white-space:nowrap">{{ $broker }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================== TRUST METRICS ==================== -->
<section class="section-padding">
    <div style="max-width:72rem;margin:0 auto;padding:0 1rem">
        <style>@media (min-width:640px){.home-tm-px{padding:0 1.5rem}}@media (min-width:1024px){.home-tm-px{padding:0 2rem}}</style>
        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem">
            <style>@media (min-width:768px){.home-tm-grid{grid-template-columns:repeat(3,1fr)}}</style>
            @foreach($trustMetrics as $i => $tm)
            <div class="card text-center reveal card-hover-light group" style="transition-delay: {{ $i * 0.1 }}s;">
                <div style="width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,174,239,0.1),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    @if($tm['icon'] === 'award')
                    <svg style="width:1.5rem;height:1.5rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    @elseif($tm['icon'] === 'check-circle')
                    <svg style="width:1.5rem;height:1.5rem;color:#00FF9F" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @else
                    <svg style="width:1.5rem;height:1.5rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @endif
                </div>
                <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.25rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">{{ $tm['title'] }}</h3>
                <p style="color:#00AEEF;font-weight:500;font-size:0.875rem;margin-bottom:0.25rem">{{ $tm['text'] }}</p>
                <p style="color:rgba(234,234,234,0.4);font-size:0.75rem">{{ $tm['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== FEATURES ==================== -->
<section id="features" class="section-padding" style="background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.04;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding:0 1rem">
        <style>@media (min-width:640px){.home-feat-px{padding:0 1.5rem}}@media (min-width:1024px){.home-feat-px{padding:0 2rem}}</style>
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="badge">Why DarkEAs</div>
            <h2 class="section-title">Built for <span class="gradient-text">Peak Performance</span></h2>
            <p class="section-subtitle">Discover what makes our Expert Advisors the preferred choice for serious traders worldwide</p>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:1rem">
            <style>@media (min-width:640px){.home-feat-grid{grid-template-columns:repeat(2,1fr)}}@media (min-width:1024px){.home-feat-grid{grid-template-columns:repeat(3,1fr)}}</style>
            @foreach($features as $i => $feat)
            <div class="card reveal tilt-card group" style="transition-delay: {{ $i * 0.06 }}s;">
                <div class="tilt-card-inner">
                    @if($feat['icon'] === 'sliders')
                    <div class="icon-box icon-box-brand mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    @elseif($feat['icon'] === 'trending-up')
                    <div class="icon-box icon-box-profit mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    @elseif($feat['icon'] === 'cpu')
                    <div class="icon-box icon-box-brand mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                    </div>
                    @elseif($feat['icon'] === 'eye')
                    <div class="icon-box icon-box-profit mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    @elseif($feat['icon'] === 'headphones')
                    <div class="icon-box icon-box-brand mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    @else
                    <div class="icon-box icon-box-profit mb-3" style="transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                    </div>
                    @endif
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1rem;margin-bottom:0.375rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">{{ $feat['title'] }}</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">{{ $feat['desc'] }}</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== PRODUCTS ==================== -->
<section class="section-padding" style="position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem">
        <style>@media (min-width:640px){.home-prod-px{padding:0 1.5rem}}@media (min-width:1024px){.home-prod-px{padding:0 2rem}}</style>
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="badge"><span class="badge-dot"></span>Expert Advisors</div>
            <h2 class="section-title">Our <span class="gradient-text">Dark Series</span></h2>
            <p class="section-subtitle">Precision-engineered EAs for every trading style and market condition</p>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem">
            <style>@media (min-width:640px){.home-prod-grid{grid-template-columns:repeat(2,1fr)}}@media (min-width:1024px){.home-prod-grid{grid-template-columns:repeat(3,1fr)}}</style>
            @foreach($products as $slug => $prod)
            <a href="{{ url('/' . $slug) }}" class="card group reveal tilt-card" style="position:relative;overflow:hidden;transition-delay:{{ ($loop->index % 6) * 0.06 }}s;display:block">
                <div class="tilt-card-inner">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:0.75rem">
                        <h3 style="color:#EAEAEA;font-weight:700;font-size:1.125rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">{{ $prod['name'] }}</h3>
                        <span style="font-size:0.6875rem;color:#00FF9F;font-weight:600;padding:0.125rem 0.5rem;border-radius:9999px;background:rgba(0,255,159,0.1);border:1px solid rgba(0,255,159,0.15);white-space:nowrap">{{ $prod['indicator'] }}</span>
                    </div>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin-bottom:0.75rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">{{ $prod['tagline'] }}</p>
                    <div style="display:flex;flex-wrap:wrap;gap:0.375rem;margin-bottom:1rem">
                        @foreach($prod['pairs'] as $pair)
                        <span style="font-size:0.6875rem;color:rgba(234,234,234,0.5);padding:0.125rem 0.5rem;border-radius:0.25rem;background:rgba(0,174,239,0.05);border:1px solid rgba(0,174,239,0.1);transition:all 0.3s" onmouseover="this.style.background='rgba(0,174,239,0.15)';this.style.color='rgba(234,234,234,0.7)'" onmouseout="this.style.background='rgba(0,174,239,0.05)';this.style.color='rgba(234,234,234,0.5)'">{{ $pair }}</span>
                        @endforeach
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:0.75rem;border-top:1px solid rgba(255,255,255,0.06)">
                        <span style="color:#00AEEF;font-size:0.875rem;font-weight:600">From ${{ number_format(min(array_column($prod['plans'], 'price')), 0) }}</span>
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem;transition:color 0.3s;display:flex;align-items:center;gap:0.25rem" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='rgba(234,234,234,0.3)'">
                            Learn More
                            <svg style="width:0.75rem;height:0.75rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
                <div class="tilt-card-glow"></div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== PERFORMANCE ==================== -->
<section class="section-padding" style="background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent,rgba(0,174,239,0.02),transparent);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:64rem;margin:0 auto;padding:0 1rem;text-align:center">
        <style>@media (min-width:640px){.home-perf-px{padding:0 1.5rem}}@media (min-width:1024px){.home-perf-px{padding:0 2rem}}</style>
        <div class="badge">Live Performance</div>
        <h2 class="section-title">Verified <span class="gradient-text">Track Records</span></h2>
        <p class="section-subtitle" style="margin-bottom:2.5rem">99.9% backtest precision — real accounts, real results, full transparency</p>

        <div style="display:grid;grid-template-columns:1fr;gap:1rem;margin-bottom:2.5rem">
            <style>@media (min-width:768px){.home-perf-stats{grid-template-columns:repeat(3,1fr)}}</style>
            <div class="card reveal card-hover-profit group">
                <div style="font-size:1.5rem;font-weight:700;color:#00FF9F;margin-bottom:0.25rem">
                    <span class="counter-number" data-target="284" data-prefix="+" data-suffix="%">0</span>
                </div>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(234,234,234,0.7)'" onmouseout="this.style.color='rgba(234,234,234,0.5)'">Avg. Annual Return</p>
                <div style="margin-top:0.75rem;height:0.375rem;background:#1a1a1a;border-radius:9999px;overflow:hidden">
                    <div class="perf-bar" style="height:0%;background:linear-gradient(90deg,#00FF9F,#00AEEF);border-radius:9999px;--target-height:85%"></div>
                </div>
            </div>
            <div class="card reveal card-hover-light group" style="transition-delay:0.1s">
                <div style="font-size:1.5rem;font-weight:700;color:#FF4C4C;margin-bottom:0.25rem">
                    <span class="counter-number" data-target="12.4" data-suffix="%">0</span>
                </div>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(234,234,234,0.7)'" onmouseout="this.style.color='rgba(234,234,234,0.5)'">Max Drawdown</p>
                <div style="margin-top:0.75rem;height:0.375rem;background:#1a1a1a;border-radius:9999px;overflow:hidden">
                    <div class="perf-bar" style="height:0%;background:linear-gradient(90deg,#FF4C4C,#FF8888);border-radius:9999px;--target-height:35%"></div>
                </div>
            </div>
            <div class="card reveal card-hover-profit group" style="transition-delay:0.2s">
                <div style="font-size:1.5rem;font-weight:700;color:#00FF9F;margin-bottom:0.25rem">
                    <span class="counter-number" data-target="3.2">0</span>
                </div>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(234,234,234,0.7)'" onmouseout="this.style.color='rgba(234,234,234,0.5)'">Profit Factor</p>
                <div style="margin-top:0.75rem;height:0.375rem;background:#1a1a1a;border-radius:9999px;overflow:hidden">
                    <div class="perf-bar" style="height:0%;background:linear-gradient(90deg,#00AEEF,#00FF9F);border-radius:9999px;--target-height:65%"></div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card text-left reveal card-hover-light" style="border-color:rgba(0,174,239,0.08)">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
                <span style="color:rgba(234,234,234,0.5);font-size:0.875rem;font-weight:500">Account Growth (Last 12 Months)</span>
                <span style="color:#00FF9F;font-size:0.875rem;font-weight:600;display:flex;align-items:center;gap:0.25rem">
                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    +184.2%
                </span>
            </div>
            <div style="display:flex;align-items:flex-end;gap:0.375rem;height:7rem">
                <style>@media (min-width:640px){.home-chart-h{height:8rem}}</style>
                @php $heights = [20, 35, 28, 45, 38, 55, 48, 62, 58, 72, 68, 85]; @endphp
                @foreach($heights as $h => $height)
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:0.25rem">
                    <div style="width:100%;background:#1a1a1a;border-radius:0.125rem;overflow:hidden;height:100%">
                        <div class="perf-bar" style="width:100%;background:linear-gradient(180deg,{{ $h % 2 == 0 ? '#00FF9F' : '#00AEEF' }});border-radius:0.125rem;--target-height:{{ $height }}%;height:0%;animation-delay:{{ 0.08 * $h }}s" onmouseover="this.style.filter='brightness(1.25)'" onmouseout="this.style.filter=''"></div>
                    </div>
                    <span style="font-size:0.625rem;color:rgba(234,234,234,0.25);font-family:'JetBrains Mono',monospace;transition:color 0.3s" onmouseover="this.style.color='rgba(234,234,234,0.5)'" onmouseout="this.style.color='rgba(234,234,234,0.25)'">M{{ $h + 1 }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================== PRICING ==================== -->
<section id="pricing" class="section-padding" style="position:relative;overflow:hidden">
    <div class="orb orb-profit" style="position:absolute;top:0;right:0;transform:translate(50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(0,255,159,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem">
        <style>@media (min-width:640px){.home-price-px{padding:0 1.5rem}}@media (min-width:1024px){.home-price-px{padding:0 2rem}}</style>
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="badge">Pricing</div>
            <h2 class="section-title">Choose Your <span class="gradient-text">Bundle</span></h2>
            <p class="section-subtitle">One-time payment, lifetime value — pick the perfect bundle for your trading journey</p>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem;max-width:64rem;margin:0 auto">
            <style>@media (min-width:768px){.home-price-grid{grid-template-columns:repeat(3,1fr)}}</style>
            @foreach($bundles as $i => $bundle)
            <div class="card reveal tilt-card group {{ $bundle['popular'] ? 'pricing-popular' : 'card-hover-light' }}" style="transition-delay:{{ $i * 0.1 }}s;display:flex;flex-direction:column">
                @if($bundle['popular'])
                <div class="pricing-popular-badge">Most Popular</div>
                @endif
                <div class="tilt-card-inner" style="display:flex;flex-direction:column;height:100%">
                    <h3 style="font-size:1.125rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.25rem">{{ $bundle['name'] }}</h3>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-bottom:1rem">
                        {{ $bundle['products'][0] ?? '' }}{{ isset($bundle['products'][1]) ? ' + ' . $bundle['products'][1] : '' }}{{ isset($bundle['products'][2]) ? ' + ' . $bundle['products'][2] : '' }}
                    </p>
                    <div style="margin-bottom:1.25rem">
                        <span style="font-size:1.875rem;font-weight:700;color:#EAEAEA;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">${{ number_format($bundle['price'], 2) }}</span>
                        <span style="color:rgba(234,234,234,0.4);font-size:0.875rem;margin-left:0.375rem">/ {{ $bundle['period'] }}</span>
                    </div>
                    <ul style="display:flex;flex-direction:column;gap:0.625rem;margin-bottom:1.5rem;flex:1">
                        @foreach($bundle['features'] as $feature)
                        <li class="check-item">
                            <svg class="check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <div style="display:flex;gap:0.5rem;width:100%">
                        <button onclick="addToCart({{ json_encode($bundle) }})"
                            data-cart-id="{{ $bundle['id'] }}"
                            style="flex:1;text-align:center;font-weight:600;padding:0.75rem 1.5rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;{{ $bundle['available'] ? '' : 'opacity:0.4;cursor:not-allowed' }} {{ $bundle['popular'] ? 'background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;border:none' : 'border:1px solid rgba(0,174,239,0.25);color:rgba(234,234,234,0.8);background:transparent' }}"
                            {{ $bundle['available'] ? '' : 'disabled' }}
                            onmouseover="{{ $bundle['available'] ? ($bundle['popular'] ? 'this.style.boxShadow=\'0 8px 30px rgba(0,174,239,0.25)\';this.style.transform=\'translateY(-2px)\'' : 'this.style.borderColor=\'#00AEEF\';this.style.background=\'rgba(0,174,239,0.05)\';this.style.color=\'#EAEAEA\'') : '' }}"
                            onmouseout="{{ $bundle['available'] ? ($bundle['popular'] ? 'this.style.boxShadow=\'none\';this.style.transform=\'\'' : 'this.style.borderColor=\'rgba(0,174,239,0.25)\';this.style.background=\'transparent\';this.style.color=\'rgba(234,234,234,0.8)\'') : '' }}">
                            <svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Add to Cart
                        </button>
                        @if($bundle['available'])
                        <button onclick="openQuickCheckout({{ json_encode($bundle) }})"
                            style="flex-shrink:0;text-align:center;font-weight:600;padding:0.75rem 1.25rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;background:linear-gradient(135deg,#00FF9F,#00CC7E);color:#0D0D0D;border:none;white-space:nowrap;font-size:0.875rem"
                            onmouseover="this.style.boxShadow='0 8px 30px rgba(0,255,159,0.25)';this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.boxShadow='none';this.style.transform=''">
                            <svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Buy Now
                        </button>
                        @endif
                    </div>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== REVIEWS ==================== -->
<section class="section-padding" style="background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.03;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding:0 1rem">
        <style>@media (min-width:640px){.home-rev-px{padding:0 1.5rem}}@media (min-width:1024px){.home-rev-px{padding:0 2rem}}</style>
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="badge">Testimonials</div>
            <h2 class="section-title">What Our <span class="gradient-text">Clients Say</span></h2>
            <p class="section-subtitle">Join thousands of satisfied traders who trust DarkEAs</p>
        </div>
        <div class="reveal" style="position:relative">
            <div id="reviewTrack" class="review-track" style="touch-action:pan-y">
                @foreach($reviews as $review)
                <div class="review-card">
                    <div class="card card-hover-light">
                        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem">
                            <div style="width:2.25rem;height:2.25rem;border-radius:50%;background:linear-gradient(135deg,#00AEEF,#00FF9F);display:flex;align-items:center;justify-content:center;color:#0D0D0D;font-weight:700;font-size:0.875rem">{{ substr($review['reviewer'], 0, 1) }}</div>
                            <div style="flex:1;min-width:0">
                                <div style="color:#EAEAEA;font-weight:500;font-size:0.875rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $review['reviewer'] }}</div>
                                <div style="display:flex;align-items:center;gap:0.375rem">
                                    <div style="display:flex">
                                        @for($r = 0; $r < $review['rating']; $r++)
                                        <svg class="star" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    @if($review['verified'])
                                    <svg style="width:0.75rem;height:0.75rem;color:#00AEEF" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p style="color:rgba(234,234,234,0.65);font-size:0.875rem;line-height:1.625;margin-bottom:0.75rem">"{{ $review['text'] }}"</p>
                        <a href="{{ $review['sourceUrl'] }}" style="color:#00AEEF;font-size:0.75rem;transition:color 0.3s;display:inline-flex;align-items:center;gap:0.25rem;position:relative;text-decoration:none" onmouseover="this.style.color='#00FF9F';this.style.textDecoration='underline'" onmouseout="this.style.color='#00AEEF';this.style.textDecoration='none'">from {{ $review['source'] }}<svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Controls -->
            <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:1.5rem">
                <button type="button" id="reviewPrev" class="carousel-btn" aria-label="Previous review">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div id="reviewDots" style="display:flex;gap:0.5rem">
                    @foreach($reviews as $i => $review)
                    <button type="button" style="width:0.5rem;height:0.5rem;border-radius:50%;transition:all 0.3s;cursor:pointer;border:none;background:{{ $i === 0 ? '#00AEEF' : 'rgba(0,174,239,0.2)' }};width:{{ $i === 0 ? '1.25rem' : '0.5rem' }}" data-index="{{ $i }}" aria-label="Go to review {{ $i + 1 }}" onmouseover="this.style.background='rgba(0,174,239,0.4)'" onmouseout="this.style.background='{{ $i === 0 ? '#00AEEF' : 'rgba(0,174,239,0.2)' }}'"></button>
                    @endforeach
                </div>
                <button type="button" id="reviewNext" class="carousel-btn" aria-label="Next review">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FAQ ==================== -->
<section class="section-padding" style="position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;bottom:0;right:0;transform:translate(33%,33%);opacity:0.03;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="max-width:48rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="badge">FAQ</div>
            <h2 class="section-title">Frequently Asked <span class="gradient-text">Questions</span></h2>
            <p class="section-subtitle">Everything you need to know about our Expert Advisors</p>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.5rem">
            @foreach($faq as $i => $item)
            <div class="card !p-0 overflow-hidden reveal accordion-item" style="transition-delay:{{ $i * 0.03 }}s;transition:all 0.3s" onmouseover="this.style.borderColor='rgba(0,174,239,0.2)'" onmouseout="this.style.borderColor=''">
                <button type="button" class="accordion-btn" data-index="{{ $i }}">
                    <span style="padding-right:1rem">{{ $item['q'] }}</span>
                    <svg class="accordion-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content">
                    <div class="accordion-content-inner">{{ $item['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== CTA ==================== -->
<section class="section-padding" style="padding-top:0">
    <div style="max-width:56rem;margin:0 auto;padding:0 1rem;text-align:center">
        <div class="home-cta-card" style="background:linear-gradient(180deg,rgba(0,174,239,0.04),rgba(17,17,17,0.6));border:1px solid rgba(0,174,239,0.12);border-radius:1rem;padding:2.5rem;position:relative;overflow:hidden" onmouseover="this.style.borderColor='rgba(0,174,239,0.25)'" onmouseout="this.style.borderColor='rgba(0,174,239,0.12)'">
            <style>@media (min-width:640px){.home-cta-p{padding:3.5rem}}</style>
            <div class="home-cta-glow"></div>
            <div style="position:relative;z-index:10">
                <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:1rem">Ready to Dominate the Markets?</h2>
                <p style="color:rgba(234,234,234,0.6);font-size:1.125rem;margin-bottom:2rem;max-width:36rem;margin-left:auto;margin-right:auto">Join over <span style="color:#00AEEF;font-weight:600">1 million</span> traders who've elevated their trading with DarkEAs. Start your journey today.</p>
                <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem">
                    <a href="#pricing" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,174,239,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                        Get Started Now
                        <svg style="width:1.25rem;height:1.25rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('forex.contact-us') }}" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem">Talk to Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== QUICK CHECKOUT MODAL ==================== -->
<div id="quickCheckoutOverlay" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);align-items:center;justify-content:center;padding:1rem;overflow-y:auto" onclick="if(event.target===this)closeQuickCheckout()">
    <div style="width:100%;max-width:28rem;background:#1a1a1a;border:1px solid #2a2a2a;border-radius:1.25rem;overflow:hidden;box-shadow:0 24px 80px rgba(0,0,0,0.6);animation:scaleIn 0.25s ease" onclick="event.stopPropagation()">
        <!-- Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.06)">
            <div style="display:flex;align-items:center;gap:0.625rem">
                <svg style="width:1.25rem;height:1.25rem;color:#00FF9F" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin:0;font-family:'DM Sans',sans-serif">Quick Checkout</h3>
            </div>
            <button onclick="closeQuickCheckout()" style="width:2rem;height:2rem;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.06);border-radius:0.5rem;color:rgba(234,234,234,0.4);cursor:pointer;transition:all 0.2s;font-size:1rem" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#EAEAEA'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='rgba(234,234,234,0.4)'">&times;</button>
        </div>

        <!-- Body -->
        <div style="padding:1.5rem">
            <!-- Selected Bundle Info -->
            <div id="quickBundleInfo" style="margin-bottom:1.25rem;padding:1rem;background:rgba(0,174,239,0.04);border:1px solid rgba(0,174,239,0.1);border-radius:0.75rem">
                <p id="quickBundleName" style="color:#EAEAEA;font-weight:600;font-size:1rem;margin:0 0 0.25rem 0"></p>
                <p id="quickBundleDesc" style="color:rgba(234,234,234,0.4);font-size:0.8125rem;margin:0 0 0.5rem 0"></p>
                <div style="display:flex;align-items:center;gap:0.5rem">
                    <span style="color:#00FF9F;font-weight:700;font-size:1.25rem;font-family:'JetBrains Mono',monospace" id="quickBundlePrice"></span>
                    <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">One-Time Payment</span>
                </div>
            </div>

            <!-- Contact Info -->
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                <div>
                    <label for="quickName" style="display:block;color:rgba(234,234,234,0.4);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem">Full Name <span style="color:#00AEEF">*</span></label>
                    <input type="text" id="quickName" placeholder="Your full name" autocomplete="name"
                        style="width:100%;background:rgba(10,10,10,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.625rem;padding:0.75rem 0.875rem;font-size:0.875rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box;outline:none"
                        onfocus="this.style.borderColor='#00AEEF';this.style.boxShadow='0 0 0 3px rgba(0,174,239,0.12)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
                </div>
                <div>
                    <label for="quickEmail" style="display:block;color:rgba(234,234,234,0.4);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem">Email Address <span style="color:#00AEEF">*</span></label>
                    <input type="email" id="quickEmail" placeholder="your@email.com" autocomplete="email"
                        style="width:100%;background:rgba(10,10,10,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.625rem;padding:0.75rem 0.875rem;font-size:0.875rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box;outline:none"
                        onfocus="this.style.borderColor='#00AEEF';this.style.boxShadow='0 0 0 3px rgba(0,174,239,0.12)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="padding:1rem 1.5rem;border-top:1px solid rgba(255,255,255,0.06);display:flex;justify-content:flex-end;gap:0.75rem">
            <button onclick="closeQuickCheckout()" style="padding:0.75rem 1.5rem;font-size:0.875rem;font-weight:500;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:0.625rem;color:rgba(234,234,234,0.5);cursor:pointer;transition:all 0.2s;font-family:'DM Sans',sans-serif"
                onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#EAEAEA'"
                onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='rgba(234,234,234,0.5)'">Cancel</button>
            <button onclick="submitQuickOrder()" id="quickOrderBtn" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.75rem;font-size:0.875rem;font-weight:600;background:linear-gradient(135deg,#00AEEF,#0095CC);border:none;border-radius:0.625rem;color:white;cursor:pointer;transition:all 0.3s;font-family:'DM Sans',sans-serif"
                onmouseover="this.style.boxShadow='0 8px 25px rgba(0,174,239,0.25)';this.style.transform='translateY(-1px)'"
                onmouseout="this.style.boxShadow='none';this.style.transform=''">
                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Place Order
            </button>
        </div>
    </div>
</div>

<style>
@keyframes scaleIn {
    from { opacity:0; transform:scale(0.95) translateY(10px); }
    to { opacity:1; transform:scale(1) translateY(0); }
}
@keyframes spin {
    from { transform:rotate(0deg); }
    to { transform:rotate(360deg); }
}
</style>

<script>
// ==================== QUICK CHECKOUT ====================
let quickBundleData = null;

window.openQuickCheckout = function(bundle) {
    quickBundleData = bundle;
    document.getElementById('quickBundleName').textContent = bundle.name || 'Bundle';
    const products = (bundle.products || []).join(' + ');
    document.getElementById('quickBundleDesc').textContent = products || (bundle.name || '');
    const price = parseFloat(bundle.price) || 0;
    document.getElementById('quickBundlePrice').textContent = '$' + price.toFixed(2);
    document.getElementById('quickName').value = @json(Auth::user()?->name ?? '');
    document.getElementById('quickEmail').value = @json(Auth::user()?->email ?? '');
    document.getElementById('quickOrderBtn').disabled = false;
    document.getElementById('quickOrderBtn').innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Place Order';
    document.getElementById('quickCheckoutOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    // Show a subtle hint if user is logged in
    @auth
    var emailField = document.getElementById('quickEmail');
    if (emailField && emailField.value) {
        emailField.style.opacity = '0.6';
        emailField.title = 'Signed in as ' + emailField.value;
    }
    var nameField = document.getElementById('quickName');
    if (nameField && nameField.value) {
        nameField.style.opacity = '0.6';
    }
    @endauth
    // Focus on name field after a short delay
    setTimeout(function() {
        var firstField = document.getElementById('quickName');
        if (firstField && !firstField.value) firstField.focus();
        else {
            var emailF = document.getElementById('quickEmail');
            if (emailF && !emailF.value) emailF.focus();
        }
    }, 300);
};

window.closeQuickCheckout = function() {
    document.getElementById('quickCheckoutOverlay').style.display = 'none';
    document.body.style.overflow = '';
    quickBundleData = null;
};

window.submitQuickOrder = function() {
    if (!quickBundleData) {
        showToast('No item selected.', 'error');
        return;
    }

    const name = document.getElementById('quickName').value.trim();
    const email = document.getElementById('quickEmail').value.trim();

    if (!name) {
        showToast('Please enter your name.', 'error');
        document.getElementById('quickName').focus();
        return;
    }
    if (!email) {
        showToast('Please enter your email address.', 'error');
        document.getElementById('quickEmail').focus();
        return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showToast('Please enter a valid email address.', 'error');
        document.getElementById('quickEmail').focus();
        return;
    }

    const btn = document.getElementById('quickOrderBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg style="width:1rem;height:1rem;animation:spin 0.8s linear infinite" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Processing...';

    // Build cart item from bundle
    const items = [{
        id: 'bundle-' + quickBundleData.id,
        name: quickBundleData.name || 'Bundle',
        price: parseFloat(quickBundleData.price) || 0,
        qty: 1
    }];
    const total = items.reduce(function(s, i) { return s + (i.price * i.qty); }, 0);

    fetch('{{ route('order.place') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            items: JSON.stringify(items),
            total: total,
            name: name,
            email: email
        })
    })
    .then(function(response) {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        if (!response.ok) {
            return response.json().then(function(err) {
                var msg = 'Order failed';
                if (err.errors) {
                    var first = Object.values(err.errors)[0];
                    if (first && first.length) msg = first[0];
                } else if (err.message) {
                    msg = err.message;
                }
                throw new Error(msg);
            }).catch(function(e) {
                if (e instanceof TypeError && e.message.includes('JSON')) {
                    throw new Error('Order failed. Please try again.');
                }
                throw e;
            });
        }
        return response.json();
    })
    .then(function(data) {
        if (data && data.redirect) {
            window.location.href = data.redirect;
        }
    })
    .catch(function(error) {
        showToast(error.message || 'Failed to place order. Please try again.', 'error');
        btn.disabled = false;
        btn.innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Place Order';
    });
};
</script>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ==================== PARTICLE STARS (Hero Canvas) ====================
    (function initParticles() {
        const canvas = document.getElementById('heroStars');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let stars = [];
        let W, H;
        let reqId;

        function resize() {
            W = canvas.width = canvas.offsetWidth;
            H = canvas.height = canvas.offsetHeight;
        }

        function createStars(count) {
            stars = [];
            for (let i = 0; i < count; i++) {
                stars.push({
                    x: Math.random() * W,
                    y: Math.random() * H,
                    r: Math.random() * 1.5 + 0.3,
                    dx: (Math.random() - 0.5) * 0.3,
                    dy: (Math.random() - 0.5) * 0.3,
                    opacity: Math.random() * 0.6 + 0.2,
                    pulse: Math.random() * Math.PI * 2
                });
            }
        }

        function draw() {
            ctx.clearRect(0, 0, W, H);
            const now = Date.now() / 1000;
            stars.forEach(s => {
                s.pulse += 0.02;
                const pulseAlpha = 0.3 + Math.sin(s.pulse) * 0.2;
                s.x += s.dx;
                s.y += s.dy;
                if (s.x < 0) s.x = W;
                if (s.x > W) s.x = 0;
                if (s.y < 0) s.y = H;
                if (s.y > H) s.y = 0;
                ctx.beginPath();
                ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(234, 234, 234, ' + (s.opacity * pulseAlpha) + ')';
                ctx.fill();
            });

            // Draw connections near stars
            for (let i = 0; i < stars.length; i++) {
                for (let j = i + 1; j < stars.length; j++) {
                    const dx = stars[i].x - stars[j].x;
                    const dy = stars[i].y - stars[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.moveTo(stars[i].x, stars[i].y);
                        ctx.lineTo(stars[j].x, stars[j].y);
                        ctx.strokeStyle = 'rgba(0, 174, 239, ' + (0.06 * (1 - dist / 120)) + ')';
                        ctx.stroke();
                    }
                }
            }
            reqId = requestAnimationFrame(draw);
        }

        resize();
        createStars(Math.min(120, Math.floor((W * H) / 8000)));
        draw();

        window.addEventListener('resize', function() {
            resize();
            createStars(Math.min(120, Math.floor((W * H) / 8000)));
        });
    })();

    // ==================== SCROLL REVEAL ====================
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // ==================== COUNT-UP ANIMATION (Hero Stats) ====================
    (function initCountUps() {
        const counters = document.querySelectorAll('.count-up');
        if (!counters.length) return;

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseFloat(el.dataset.target);
                    const suffix = el.dataset.suffix || '';
                    const duration = 2000;
                    const startTime = performance.now();
                    const isDecimal = target % 1 !== 0;

                    function update(now) {
                        const elapsed = now - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        const current = eased * target;
                        el.textContent = isDecimal ? current.toFixed(1) : Math.floor(current);
                        if (progress < 1) {
                            requestAnimationFrame(update);
                        } else {
                            el.textContent = isDecimal ? target.toFixed(1) : Math.floor(target);
                        }
                    }
                    requestAnimationFrame(update);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => counterObserver.observe(c));
    })();

    // ==================== COUNTER NUMBERS (Performance) ====================
    (function initCounters() {
        const counters = document.querySelectorAll('.counter-number');
        if (!counters.length) return;

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseFloat(el.dataset.target);
                    const prefix = el.dataset.prefix || '';
                    const suffix = el.dataset.suffix || '';
                    const duration = 1800;
                    const startTime = performance.now();
                    const isDecimal = target % 1 !== 0;

                    function update(now) {
                        const elapsed = now - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        const current = eased * target;
                        el.textContent = prefix + (isDecimal ? current.toFixed(1) : Math.floor(current)) + suffix;
                        if (progress < 1) {
                            requestAnimationFrame(update);
                        } else {
                            el.textContent = prefix + (isDecimal ? target.toFixed(1) : Math.floor(target)) + suffix;
                        }
                    }
                    requestAnimationFrame(update);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => counterObserver.observe(c));
    })();

    // ==================== 3D TILT ON CARDS ====================
    (function initTilt() {
        const tiltCards = document.querySelectorAll('.tilt-card');
        if (!tiltCards.length || window.innerWidth < 768) return;

        tiltCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -6;
                const rotateY = ((x - centerX) / centerX) * 6;
                const inner = this.querySelector('.tilt-card-inner');
                if (inner) {
                    inner.style.transform = 'rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)';
                }
                const glow = this.querySelector('.tilt-card-glow');
                if (glow) {
                    glow.style.setProperty('--mouseX', (x / rect.width * 100) + '%');
                    glow.style.setProperty('--mouseY', (y / rect.height * 100) + '%');
                }
            });

            card.addEventListener('mouseleave', function() {
                const inner = this.querySelector('.tilt-card-inner');
                if (inner) {
                    inner.style.transform = 'rotateX(0deg) rotateY(0deg)';
                }
            });
        });
    })();

    // ==================== REVIEW CAROUSEL ====================
    const track = document.getElementById('reviewTrack');
    const dots = document.querySelectorAll('#reviewDots button');
    const prevBtn = document.getElementById('reviewPrev');
    const nextBtn = document.getElementById('reviewNext');
    let current = 0;
    const total = {{ count($reviews) }};
    let autoSlide;

    function goTo(index) {
        current = Math.max(0, Math.min(index, total - 1));
        if (track) track.style.transform = 'translateX(-' + (current * 100) + '%)';
        dots.forEach((d, i) => {
            d.style.background = i === current ? '#00AEEF' : 'rgba(0,174,239,0.2)';
            d.style.width = i === current ? '1.25rem' : '0.5rem';
        });
    }

    function nextReview() { goTo((current + 1) % total); }
    function prevReview() { goTo((current - 1 + total) % total); }
    function resetAuto() { clearInterval(autoSlide); autoSlide = setInterval(nextReview, 5000); }

    if (prevBtn) prevBtn.addEventListener('click', function() { prevReview(); resetAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function() { nextReview(); resetAuto(); });
    dots.forEach(function(d) {
        d.addEventListener('click', function() { goTo(parseInt(this.dataset.index)); resetAuto(); });
    });
    resetAuto();

    // Touch/swipe for carousel
    if (track) {
        let startX, isDragging = false, translateX = 0;
        track.addEventListener('touchstart', function(e) {
            isDragging = true;
            startX = e.touches[0].clientX;
            translateX = -current * track.offsetWidth;
            track.style.transition = 'none';
            clearInterval(autoSlide);
        }, { passive: true });
        track.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            const diff = e.touches[0].clientX - startX;
            track.style.transform = 'translateX(' + (translateX + diff) + 'px)';
        }, { passive: true });
        track.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            track.style.transition = 'transform 0.4s ease';
            const diff = e.changedTouches[0].clientX - startX;
            if (Math.abs(diff) > 50) {
                diff < 0 ? nextReview() : prevReview();
            } else {
                goTo(current);
            }
            resetAuto();
        }, { passive: true });
    }

    // ==================== FAQ ACCORDION ====================
    document.querySelectorAll('.accordion-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const chevron = this.querySelector('.accordion-chevron');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

            // Close all
            document.querySelectorAll('.accordion-content').forEach(function(c) {
                c.style.maxHeight = '0px';
                const ch = c.previousElementSibling.querySelector('.accordion-chevron');
                if (ch) ch.style.transform = 'rotate(0deg)';
            });

            if (!isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            }
        });
    });
});
</script>
@endpush
