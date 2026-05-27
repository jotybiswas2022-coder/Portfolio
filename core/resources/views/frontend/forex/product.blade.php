@extends('frontend.forex.layouts.app')

@section('title', $product['name'] . ' — ' . $product['tagline'])

@section('content')
<style>
@media (min-width:640px){.prod-px{padding-left:1.5rem;padding-right:1.5rem}}
@media (min-width:1024px){.prod-px{padding-left:2rem;padding-right:2rem}}
@media (min-width:640px){.prod-text-lg{font-size:1.125rem}}
@media (min-width:1024px){.prod-hero-btn{padding:1rem 2rem;font-size:1.125rem}}
.prod-bg-grid{background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:48px 48px}
.prod-feature-card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:1rem;padding:2rem;aspect-ratio:16/9;display:flex;align-items:center;justify-content:center;transition:all 0.3s}
.prod-feature-card:hover{border-color:#00AEEF}
.prod-plan-card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:1rem;padding:2rem;transition:all 0.3s}
.prod-plan-card:hover{border-color:#00AEEF;box-shadow:0 0 20px rgba(0,174,239,0.1)}
.prod-plan-popular{border-color:#00AEEF;box-shadow:0 0 30px rgba(0,174,239,0.15)}
.prod-faq-item{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:0.75rem;overflow:hidden;transition:all 0.3s}
.prod-faq-item:hover{border-color:rgba(0,174,239,0.5)}
.prod-faq-toggle{width:100%;display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;text-align:left;cursor:pointer;background:none;border:none;color:#EAEAEA;font-weight:500;font-size:0.875rem}
@media (min-width:640px){.prod-faq-toggle{padding:1.25rem;font-size:1rem}}
.prod-faq-chevron{width:1.25rem;height:1.25rem;color:#9ca3af;flex-shrink:0;transition:transform 0.3s}
.prod-faq-content{max-height:0;overflow:hidden;transition:max-height 0.3s}
.prod-faq-inner{padding:0 1.25rem 1rem;color:#9ca3af;font-size:0.875rem;line-height:1.625;border-top:1px solid #2a2a2a;padding-top:1rem}
@media (min-width:640px){.prod-faq-inner{padding:0 1.25rem 1.25rem}}
.prod-review-btn{width:2.5rem;height:2.5rem;border-radius:50%;background:rgba(13,13,13,0.7);backdrop-filter:blur(12px);border:1px solid #2a2a2a;display:flex;align-items:center;justify-content:center;color:#9ca3af;cursor:pointer;transition:all 0.3s;position:absolute;top:50%;transform:translateY(-50%)}
.prod-review-btn:hover{color:#EAEAEA;border-color:#00AEEF}
</style>
<!-- HERO -->
<section style="position:relative;min-height:70vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="prod-bg-grid" style="position:absolute;inset:0;opacity:0.03;pointer-events:none"></div>
    <div class="orb orb-brand" style="position:absolute;top:-12rem;right:-12rem;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none;animation:float 6s ease-in-out infinite"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;width:100%">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.prod-hero{grid-template-columns:repeat(2,1fr)}}</style>
            <div>
                <span style="display:inline-block;color:#00AEEF;font-size:0.875rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:1rem;animation:fadeInUp 0.6s ease">{{ $product['heroTagline'] }}</span>
                <h1 style="font-size:2.25rem;font-weight:700;font-family:'Bebas Neue','Oswald',sans-serif;line-height:1.1;margin-bottom:1.5rem;animation:fadeInUp 0.6s ease 0.1s both">
                    <span style="color:#EAEAEA">{{ $product['name'] }}:</span><br>
                    <span style="background:linear-gradient(135deg,#00AEEF,#00FF9F);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ $product['tagline'] }}</span>
                </h1>
                <p style="color:#9ca3af;font-size:1rem;line-height:1.625;margin-bottom:2rem;max-width:36rem;animation:fadeInUp 0.6s ease 0.2s both" class="prod-text-lg">{{ $product['heroDescription'] }}</p>
                <a href="#pricing-{{ $slug }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;animation:fadeInUp 0.6s ease 0.3s both" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,174,239,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    Get {{ $product['name'] }} Now
                    <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div style="display:none;animation:fadeInUp 0.6s ease 0.2s both">
                <style>@media (min-width:1024px){.prod-hero-visual{display:block}}</style>
                <div style="background:#111111;border:1px solid #2a2a2a;border-radius:1rem;padding:2rem;aspect-ratio:1;display:flex;align-items:center;justify-content:center">
                    <div style="text-align:center">
                        <div style="width:6rem;height:6rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,rgba(0,174,239,0.2),rgba(0,153,204,0.1));display:flex;align-items:center;justify-content:center;animation:float 3s ease-in-out infinite">
                            <svg style="width:3rem;height:3rem;color:#00AEEF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                        </div>
                        <p style="color:#6b7280;font-size:0.875rem">Trading Chart Visualization</p>
                        <p style="color:#4b5563;font-size:0.75rem;margin-top:0.25rem">{{ $product['name'] }} Performance Dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
@foreach($product['features'] as $i => $feature)
<section style="padding-top:4rem;padding-bottom:4rem;background:{{ $i % 2 === 0 ? 'transparent' : '#111111' }}">
    <div style="max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.prod-feat{{ $i }}{grid-template-columns:repeat(2,1fr)}}</style>
            <div style="order:{{ $i % 2 === 0 ? '0' : '2' }}" class="reveal">
                <span style="color:#00AEEF;font-size:0.875rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.5rem;display:block">{{ $feature['tagline'] }}</span>
                <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:1rem">{{ $feature['title'] }}</h2>
                <p style="color:#9ca3af;line-height:1.625">{{ $feature['text'] }}</p>
            </div>
            <div style="order:{{ $i % 2 === 0 ? '0' : '1' }}" class="reveal">
                <div class="prod-feature-card">
                    <div style="text-align:center">
                        <svg style="width:4rem;height:4rem;color:#4b5563;margin:0 auto 0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                        <p style="color:#6b7280;font-size:0.875rem">Chart / Image Placeholder</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

<!-- PERFORMANCE CHART -->
<section style="padding-top:5rem;padding-bottom:5rem">
    <div style="max-width:64rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">Low Drawdown — Real Data</h2>
        <p style="color:#9ca3af;text-align:center;margin-bottom:2.5rem" class="reveal stagger-1">3-year conservative signal performance</p>
        <div style="background:#111111;border:1px solid #2a2a2a;border-radius:1rem;padding:1.5rem" class="reveal">
            <style>@media (min-width:640px){.prod-chart-p{padding:2rem}}</style>
            <canvas id="perfChart-{{ $slug }}" height="300" style="width:100%"></canvas>
        </div>
        <div style="text-align:center;margin-top:2rem" class="reveal stagger-2">
            <a href="#" style="display:inline-flex;align-items:center;gap:0.5rem;background:#1a1a1a;border:1px solid #2a2a2a;color:#EAEAEA;padding:0.75rem 1.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:500;transition:all 0.3s" onmouseover="this.style.borderColor='#00AEEF'" onmouseout="this.style.borderColor='#2a2a2a'">
                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Fully Verified MyFxBook
            </a>
        </div>
    </div>
</section>

<!-- REVIEWS -->
<section style="padding-top:5rem;padding-bottom:5rem;background:#111111;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.2;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:1rem" class="reveal">What Our Clients Say</h2>
        <p style="color:#9ca3af;text-align:center;margin-bottom:2.5rem" class="reveal stagger-1">Over {{ $product['reviews'] }} positive reviews and {{ $product['liveSignalYears'] }} Years of Live Signal</p>
        <div id="reviewCarousel-{{ $slug }}" style="position:relative;max-width:56rem;margin:0 auto;overflow:hidden" class="reveal">
            <div id="reviewTrack-{{ $slug }}" style="display:flex;transition:transform 0.5s ease-in-out">
                @foreach($reviews as $review)
                <div style="min-width:100%;padding:0 1rem">
                    <div style="background:#1a1a1a;border:1px solid #2a2a2a;border-radius:0.75rem;padding:1.5rem" class="prod-rev-card">
                        <style>@media (min-width:640px){.prod-rev-card{padding:2rem}}</style>
                        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.75rem">
                            <div style="display:flex;color:#f59e0b">
                                @for($i = 0; $i < $review['rating']; $i++)
                                <svg style="width:1rem;height:1rem;fill:currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            @if($review['verified']) <span style="color:#00FF9F;font-size:0.75rem;font-weight:600;display:flex;align-items:center;gap:0.25rem"><svg style="width:0.875rem;height:0.875rem;fill:currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Verified</span> @endif
                            <span style="color:#6b7280;font-size:0.75rem;margin-left:auto">{{ $review['date'] }}</span>
                        </div>
                        <p style="color:#d1d5db;font-size:0.875rem;line-height:1.625;margin-bottom:1rem">"{{ $review['text'] }}"</p>
                        <div style="display:flex;align-items:center;justify-content:space-between">
                            <span style="color:#EAEAEA;font-weight:500;font-size:0.875rem">{{ $review['reviewer'] }}</span>
                            <a href="{{ $review['sourceUrl'] }}" style="color:#00AEEF;font-size:0.75rem;position:relative;text-decoration:none" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">from {{ $review['source'] }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="prod-review-btn" style="left:0;transform:translateY(-50%) translateX(-0.5rem)" data-carousel="{{ $slug }}" onclick="prevReview{{ $slug }}()">
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="prod-review-btn" style="right:0;transform:translateY(-50%) translateX(0.5rem)" data-carousel="{{ $slug }}" onclick="nextReview{{ $slug }}()">
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- PRICING -->
<section id="pricing-{{ $slug }}" style="padding-top:5rem;padding-bottom:5rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:64rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">{{ $product['name'] }} Expert Advisor</h2>
        <p style="color:#9ca3af;text-align:center;margin-bottom:2.5rem" class="reveal stagger-1">Over {{ $product['reviews'] }} positive reviews and {{ $product['liveSignalYears'] }} Years of Live Signal</p>
        <div style="display:grid;grid-template-columns:1fr;gap:2rem;max-width:48rem;margin:0 auto">
            <style>@media (min-width:768px){.prod-plans{grid-template-columns:repeat(2,1fr)}}</style>
            @foreach($product['plans'] as $plan)
            <div style="position:relative;background:#1a1a1a;border:1px solid #2a2a2a;border-radius:1rem;padding:2rem;transition:all 0.3s;{{ isset($plan['popular']) && $plan['popular'] ? 'border-color:#00AEEF;box-shadow:0 0 30px rgba(0,174,239,0.15)' : '' }}" class="reveal" onmouseover="this.style.borderColor='#00AEEF';this.style.boxShadow='0 0 20px rgba(0,174,239,0.1)'" onmouseout="this.style.borderColor='{{ isset($plan['popular']) && $plan['popular'] ? '#00AEEF' : '#2a2a2a' }}';this.style.boxShadow='{{ isset($plan['popular']) && $plan['popular'] ? '0 0 30px rgba(0,174,239,0.15)' : 'none' }}'">
                @if(isset($plan['popular']) && $plan['popular'])
                <span style="position:absolute;top:-0.75rem;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-size:0.75rem;font-weight:700;padding:0.25rem 1rem;border-radius:9999px;white-space:nowrap">Most Popular</span>
                @endif
                <h3 style="font-size:1.25rem;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem">{{ $plan['name'] }}</h3>
                <div style="margin-bottom:1.5rem">
                    <span style="font-size:2.25rem;font-weight:700;color:#EAEAEA">${{ number_format($plan['price'], 2) }}</span>
                    <span style="color:#9ca3af;font-size:0.875rem;margin-left:0.5rem">One Time</span>
                </div>
                <ul style="display:flex;flex-direction:column;gap:0.75rem;margin-bottom:2rem">
                    @foreach($plan['features'] as $feature)
                    <li style="display:flex;align-items:flex-start;gap:0.5rem;font-size:0.875rem;color:#d1d5db">
                        <svg style="width:1rem;height:1rem;color:#00FF9F;margin-top:0.125rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                <div style="display:flex;gap:0.5rem;width:100%">
                    <button onclick="addToCart({name:'{{ $product['name'] }} {{ $plan['name'] }}', price:{{ $plan['price'] }}, id:'{{ $slug }}-{{ $plan['id'] }}'})" data-cart-id="{{ $slug }}-{{ $plan['id'] }}" style="flex:1;text-align:center;font-weight:600;padding:0.75rem 1rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:1px solid rgba(0,174,239,0.25);color:rgba(234,234,234,0.8);background:transparent;font-size:0.875rem" onmouseover="this.style.borderColor='#00AEEF';this.style.background='rgba(0,174,239,0.05)';this.style.color='#EAEAEA'" onmouseout="this.style.borderColor='rgba(0,174,239,0.25)';this.style.background='transparent';this.style.color='rgba(234,234,234,0.8)'">
                        <svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        Add to Cart
                    </button>
                    <button onclick="openQuickCheckout({{ json_encode(['name' => $product['name'].' '.$plan['name'], 'price' => $plan['price'], 'id' => $slug.'-'.$plan['id']]) }})" style="flex-shrink:0;text-align:center;font-weight:600;padding:0.75rem 1.25rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;background:linear-gradient(135deg,#00FF9F,#00CC7E);color:#0D0D0D;border:none;white-space:nowrap;font-size:0.875rem" onmouseover="this.style.boxShadow='0 8px 30px rgba(0,255,159,0.25)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform=''">
                        <svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Buy Now
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ -->
<section style="padding-top:5rem;padding-bottom:5rem;background:#111111;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.2;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:48rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:2.5rem" class="reveal">Frequently Asked Questions</h2>
        <div style="display:flex;flex-direction:column;gap:0.75rem">
            @foreach($faq as $i => $item)
            <div class="prod-faq-item reveal">
                <button class="prod-faq-toggle" onclick="toggleFaq{{ $slug }}(this)">
                    <span style="padding-right:1rem">{{ $item['q'] }}</span>
                    <svg class="prod-faq-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="prod-faq-content">
                    <div class="prod-faq-inner">{{ $item['a'] }}</div>
                </div>
            </div>
            @endforeach
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

<!-- CTA -->
<section style="padding-top:5rem;padding-bottom:5rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:rgba(0,174,239,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:1rem" class="reveal">Let's Get Started</h2>
        <p style="color:#9ca3af;font-size:1.125rem;margin-bottom:2rem;max-width:36rem;margin-left:auto;margin-right:auto" class="reveal stagger-1">Start trading with {{ $product['name'] }} and experience the difference.</p>
        <a href="#pricing-{{ $slug }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#00AEEF,#0095CC);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,174,239,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            Get Started Now
            <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Performance Chart
    const ctx = document.getElementById('perfChart-{{ $slug }}');
    if (ctx) {
        const months = [];
        const equity = [];
        let val = 10000;
        for (let i = 0; i < 36; i++) {
            months.push('M' + (i+1));
            val += 280 + (Math.random() * 500 - 150);
            equity.push(Math.round(val * 100) / 100);
        }
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Equity Curve',
                    data: equity,
                    borderColor: '#00AEEF',
                    backgroundColor: (ctx) => {
                        const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, ctx.chart.height);
                        gradient.addColorStop(0, 'rgba(0,174,239,0.3)');
                        gradient.addColorStop(1, 'rgba(0,174,239,0.01)');
                        return gradient;
                    },
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#666', maxTicksLimit: 12 } },
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#666', callback: v => '$' + v.toLocaleString() } }
                }
            }
        });
    }

    // FAQ Accordion
    document.querySelectorAll('.prod-faq-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const chevron = this.querySelector('.prod-faq-chevron');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
            if (isOpen) {
                content.style.maxHeight = '0px';
                chevron.style.transform = 'rotate(0deg)';
                this.closest('.prod-faq-item').style.borderColor = '#2a2a2a';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                chevron.style.transform = 'rotate(180deg)';
                this.closest('.prod-faq-item').style.borderColor = 'rgba(0,174,239,0.5)';
            }
        });
    });
});

// Review carousel functions
let current{{ $slug }} = 0;
const total{{ $slug }} = {{ count($reviews) }};
function goTo{{ $slug }}(index) {
    current{{ $slug }} = Math.max(0, Math.min(index, total{{ $slug }} - 1));
    const track = document.getElementById('reviewTrack-{{ $slug }}');
    if (track) track.style.transform = 'translateX(-' + (current{{ $slug }} * 100) + '%)';
}
function nextReview{{ $slug }}() { goTo{{ $slug }}((current{{ $slug }} + 1) % total{{ $slug }}); }
function prevReview{{ $slug }}() { goTo{{ $slug }}((current{{ $slug }} - 1 + total{{ $slug }}) % total{{ $slug }}); }
</script>
@endpush
