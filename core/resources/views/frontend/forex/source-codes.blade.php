@extends('frontend.forex.layouts.app')

@section('title', 'Source Codes — Core Trading Solutions')

@section('content')
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center">
        <div class="badge animate-fade-in-up"><span class="badge-dot"></span> Developer Resources</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:3rem;font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Source <span class="gradient-text">Codes</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:1.125rem;max-width:36rem;margin:0 auto;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">Get access to the complete source code of our Expert Advisors — study, customize, and innovate.</p>
    </div>
</section>

<!-- ==================== PRODUCTS ==================== -->
<section style="padding-top:2rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.src-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.src-px{padding-left:2rem;padding-right:2rem}}
            .src-grid{display:grid;grid-template-columns:1fr;gap:1.25rem}
            @media (min-width:768px){.src-grid{grid-template-columns:repeat(2,1fr)}}
            @media (min-width:1024px){.src-grid{grid-template-columns:repeat(3,1fr)}}
            .src-buy-btn{display:inline-flex;align-items:center;gap:0.5rem;padding:0.625rem 1.25rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:0.875rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none}
            .src-buy-btn:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(0,174,239,0.25)}
        </style>
        <div class="src-grid">
            @foreach(['Dark Algo', 'Dark Nova', 'Dark Kronos', 'Dark Titan', 'Dark Gold', 'Ultimate Bundle'] as $i => $item)
            @php
                $price = 199 + ($i * 50);
                $colors = [
                    ['from' => '#00AEEF', 'to' => '#0095CC'],
                    ['from' => '#00FF9F', 'to' => '#00CC7F'],
                    ['from' => '#A855F7', 'to' => '#7C3AED'],
                    ['from' => '#F59E0B', 'to' => '#D97706'],
                    ['from' => '#EF4444', 'to' => '#DC2626'],
                    ['from' => '#00AEEF', 'to' => '#00FF9F'],
                ];
                $c = $colors[$i];
            @endphp
            <div class="card group reveal tilt-card" style="transition-delay: {{ $i * 0.08 }}s;">
                <div class="tilt-card-inner">
                    <!-- Icon -->
                    <div style="width:3.5rem;height:3.5rem;border-radius:0.75rem;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;transition:transform 0.3s;background:linear-gradient(135deg, {{ $c['from'] }}26, {{ $c['to'] }}0D)" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:1.75rem;height:1.75rem;color:{{ $c['from'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>

                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#00AEEF'" onmouseout="this.style.color='#EAEAEA'">{{ $item }} <span style="color:rgba(234,234,234,0.3);font-size:0.875rem;font-weight:400">Source Code</span></h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin-bottom:1rem;line-height:1.625">Complete MQL4/MQL5 source code with full documentation and development guide.</p>

                    <!-- Features -->
                    <div style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.25rem">
                        <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.5)">
                            <svg style="width:0.875rem;height:0.875rem;color:#00FF9F;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Full MQL4/MQL5 Source
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.5)">
                            <svg style="width:0.875rem;height:0.875rem;color:#00FF9F;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Documentation Included
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.5)">
                            <svg style="width:0.875rem;height:0.875rem;color:#00FF9F;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Lifetime Updates
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06)">
                        <span style="background:linear-gradient(135deg,#00AEEF,#00FF9F);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-weight:700;font-size:1.25rem">${{ $price }}</span>
                        <div style="display:flex;gap:0.375rem">
                            <button onclick="addToCart({name:'{{ $item }} Source Code', price:{{ $price }}, id:'src-{{ $i }}'})" data-cart-id="src-{{ $i }}" style="font-weight:600;padding:0.5rem 0.75rem;border-radius:0.625rem;transition:all 0.3s;cursor:pointer;border:1px solid rgba(0,174,239,0.2);color:rgba(234,234,234,0.7);background:transparent;font-size:0.75rem;white-space:nowrap" onmouseover="this.style.borderColor='#00AEEF';this.style.background='rgba(0,174,239,0.05)';this.style.color='#EAEAEA'" onmouseout="this.style.borderColor='rgba(0,174,239,0.2)';this.style.background='transparent';this.style.color='rgba(234,234,234,0.7)'">
                                <svg style="width:0.875rem;height:0.875rem;display:inline;margin-right:0.125rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                Add to Cart
                            </button>
                            <button onclick="openQuickCheckout({{ json_encode(['name' => $item.' Source Code', 'price' => $price, 'id' => 'src-'.$i]) }})" style="font-weight:600;padding:0.5rem 0.875rem;border-radius:0.625rem;transition:all 0.3s;cursor:pointer;background:linear-gradient(135deg,#00FF9F,#00CC7E);color:#0D0D0D;border:none;font-size:0.75rem;white-space:nowrap" onmouseover="this.style.boxShadow='0 6px 20px rgba(0,255,159,0.2)';this.style.transform='translateY(-1px)'" onmouseout="this.style.boxShadow='none';this.style.transform=''">
                                <svg style="width:0.875rem;height:0.875rem;display:inline;margin-right:0.125rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== WHY BUY ==================== -->
<section style="padding-top:6rem;padding-bottom:6rem;background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.03;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:3rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span> Why Buy Source Codes</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:0">Unlock the <span class="gradient-text">Full Potential</span></h2>
            <p style="font-size:clamp(0.95rem,1.2vw,1.1rem);color:rgba(234,234,234,0.5);max-width:36rem;margin:0 auto;line-height:1.6;margin-top:1rem">Three powerful reasons to get the source code</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:1.5rem">
            <style>@media (min-width:768px){.src-why{grid-template-columns:repeat(3,1fr)}}</style>
            <div class="card text-center group reveal tilt-card stagger-1">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,174,239,0.15),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:2rem;height:2rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem">Learn</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Study the code to understand advanced MQL4/MQL5 programming techniques used by professional developers.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="card text-center group reveal tilt-card stagger-2">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,174,239,0.15),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:2rem;height:2rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem">Customize</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Modify and adapt the code to fit your specific trading strategies and requirements.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="card text-center group reveal tilt-card stagger-3">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,174,239,0.15),rgba(0,255,159,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:2rem;height:2rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem">Resell</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Purchase a reseller license and sell modified versions under your own brand.</p>
                </div>
                <div class="tilt-card-glow"></div>
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
            <!-- Selected Item Info -->
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
    document.getElementById('quickBundleName').textContent = bundle.name || 'Item';
    document.getElementById('quickBundleDesc').textContent = bundle.name || '';
    const price = parseFloat(bundle.price) || 0;
    document.getElementById('quickBundlePrice').textContent = '$' + price.toFixed(2);
    document.getElementById('quickName').value = @json(Auth::user()?->name ?? '');
    document.getElementById('quickEmail').value = @json(Auth::user()?->email ?? '');
    document.getElementById('quickOrderBtn').disabled = false;
    document.getElementById('quickOrderBtn').innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Place Order';
    document.getElementById('quickCheckoutOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    // Pre-fill logged-in user info
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

    const items = [{
        id: 'item-' + quickBundleData.id,
        name: quickBundleData.name || 'Item',
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
