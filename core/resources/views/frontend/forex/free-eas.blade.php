@extends('frontend.forex.layouts.app')

@section('title', 'Free Expert Advisors — Core Trading Solutions')

@section('content')
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center">
        <div class="badge animate-fade-in-up"><span class="badge-dot"></span> Free Resources</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:3rem;font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Free <span class="gradient-text">Expert Advisors</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:1.125rem;max-width:42rem;margin:0 auto;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">Download and test our free Expert Advisors before making a purchase — no credit card required.</p>
    </div>
</section>

<!-- ==================== DOWNLOADS ==================== -->
<section style="padding-top:2rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.fea-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.fea-px{padding-left:2rem;padding-right:2rem}}
            .fea-tag{display:inline-flex;align-items:center;gap:0.25rem;padding:0.25rem 0.625rem;border-radius:9999px;font-size:0.75rem;border:1px solid}
        </style>

        <!-- Stats row -->
        <div style="display:grid;grid-template-columns:1fr;gap:1rem;margin-bottom:2.5rem" class="reveal">
            <style>@media (min-width:640px){.fea-stats{grid-template-columns:repeat(3,1fr)}}</style>
            <div style="background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;text-align:center;transition:all 0.3s" class="card-hover-light group" onmouseover="this.style.borderColor='rgba(0,174,239,0.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                <div style="font-size:1.5rem;font-weight:700;color:#EAEAEA;font-family:'JetBrains Mono',monospace;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">6</div>
                <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.125rem">Free EAs Available</p>
            </div>
            <div style="background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;text-align:center;transition:all 0.3s" class="reveal stagger-1" onmouseover="this.style.borderColor='rgba(0,174,239,0.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                <div style="font-size:1.5rem;font-weight:700;color:#00FF9F;font-family:'JetBrains Mono',monospace">10K+</div>
                <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.125rem">Total Downloads</p>
            </div>
            <div style="background:rgba(17,17,17,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:1rem;padding:1.5rem;text-align:center;transition:all 0.3s" class="reveal stagger-2" onmouseover="this.style.borderColor='rgba(0,174,239,0.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                <div style="font-size:1.5rem;font-weight:700;color:#EAEAEA;font-family:'JetBrains Mono',monospace;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">MT4/MT5</div>
                <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.125rem">Compatible Platforms</p>
            </div>
        </div>

        <!-- Free EAs Grid -->
        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem">
            <style>@media (min-width:768px){.fea-grid{grid-template-columns:repeat(2,1fr)}}@media (min-width:1024px){.fea-grid{grid-template-columns:repeat(3,1fr)}}</style>
            @for($i = 0; $i < 6; $i++)
            <div class="card group reveal tilt-card" style="transition-delay: {{ $i * 0.08 }}s;">
                <div class="tilt-card-inner">
                    <!-- Icon -->
                    <div style="width:3.5rem;height:3.5rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,174,239,0.15),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;margin-bottom:1rem;transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.75rem;height:1.75rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>

                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">Free EA {{ $i + 1 }}</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin-bottom:1rem;line-height:1.625">A free Expert Advisor to help you get started with automated trading. Compatible with MT4 and MT5 platforms.</p>

                    <!-- Tags -->
                    <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1.25rem">
                        <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.25rem 0.625rem;background:#1a3a1a;color:#00FF9F;font-size:0.75rem;border-radius:9999px;border:1px solid rgba(0,255,159,0.2)">
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:#00FF9F;display:inline-block"></span>
                            MT4
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.25rem 0.625rem;background:#1a3a1a;color:#00FF9F;font-size:0.75rem;border-radius:9999px;border:1px solid rgba(0,255,159,0.2)">
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:#00FF9F;display:inline-block"></span>
                            MT5
                        </span>
                        <span style="padding:0.25rem 0.625rem;background:#001a2e;color:#00AEEF;font-size:0.75rem;border-radius:9999px;border:1px solid rgba(0,174,239,0.2)">Free</span>
                    </div>

                    <!-- Downloads -->
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06)">
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem;display:flex;align-items:center;gap:0.25rem">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            {{ rand(500, 2000) }}+ downloads
                        </span>
                        <button onclick="showToast('Download started for Free EA {{ $i + 1 }}!', 'success')" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.625rem 1.25rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:0.875rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,174,239,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                            <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Free
                        </button>
                    </div>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            @endfor
        </div>

        <!-- Bottom CTA -->
        <div style="text-align:center;margin-top:3rem" class="reveal">
            <div style="background:linear-gradient(135deg,rgba(0,174,239,0.03),transparent);border:1px solid rgba(0,174,239,0.1);border-radius:1rem;padding:2rem;display:inline-block;max-width:36rem;margin:0 auto" class="fea-cta">
                <style>@media (min-width:640px){.fea-cta{padding:2.5rem}}</style>
                <h3 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem">Ready for More?</h3>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin-bottom:1.25rem">Upgrade to our premium Expert Advisors for advanced features and dedicated support.</p>
                <a href="{{ route('forex.home') }}#pricing" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,174,239,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    View Premium EAs
                    <svg style="width:1rem;height:1rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
