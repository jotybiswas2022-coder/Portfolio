<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-KOKx7/j+fNU1R1H9lKDz9EwT5PpFKF4P4FQn8vHCEa8l/HzIhM+fq0Iu6iX2QzYeb6gi3W4Z2Zob/nkZfgF+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ===== THEME SYSTEM ===== */
        :root {
            --theme-primary: #dc2626;
            --theme-primary-light: #ef4444;
            --theme-primary-dark: #b91c1c;
            --theme-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-bg-card: rgba(255, 255, 255, 0.04);
            --theme-bg-card-solid: #ffffff;
            --theme-text: #374151;
            --theme-text-light: #6b7280;
            --theme-text-white: #ffffff;
            --theme-text-primary: #f5f5f5;
            --theme-border: rgba(255, 255, 255, 0.08);
            --theme-border-light: rgba(255, 255, 255, 0.06);
            --theme-border-input: rgba(255, 255, 255, 0.1);
            --theme-text-muted: rgba(255, 255, 255, 0.35);
            --theme-text-label: rgba(255, 255, 255, 0.7);
            --theme-nav-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-nav-scrolled: rgba(26, 26, 46, 0.92);
            --theme-footer-bg: #1a1a2e;
            --theme-footer-bg-2: #16213e;
            --theme-btn-secondary-bg: rgba(255, 255, 255, 0.06);
            --theme-btn-secondary-border: rgba(255, 255, 255, 0.1);
            --theme-btn-secondary-text: rgba(255, 255, 255, 0.6);
            --theme-input-bg: rgba(255, 255, 255, 0.06);
            --theme-input-border: rgba(255, 255, 255, 0.1);
            --theme-input-text: #f5f5f5;
            --theme-input-placeholder: rgba(255, 255, 255, 0.2);
            --theme-input-icon: rgba(255, 255, 255, 0.25);
            --theme-card-shadow: 0 20px 60px rgba(0,0,0,0.3);
            --theme-hero-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-skeleton-overlay: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            --theme-skeleton-shine: rgba(255,255,255,0.04);
            --theme-skeleton-shine-2: rgba(255,255,255,0.08);
        }

        .light-mode {
            --theme-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f0f5 100%);
            --theme-bg-card: rgba(255, 255, 255, 0.85);
            --theme-bg-card-solid: #ffffff;
            --theme-text: #1f2937;
            --theme-text-light: #6b7280;
            --theme-text-white: #1f2937;
            --theme-text-primary: #1f2937;
            --theme-border: rgba(0, 0, 0, 0.08);
            --theme-border-light: rgba(0, 0, 0, 0.05);
            --theme-border-input: rgba(0, 0, 0, 0.1);
            --theme-text-muted: rgba(0, 0, 0, 0.45);
            --theme-text-label: rgba(0, 0, 0, 0.6);
            --theme-nav-bg: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #f0f0f5 100%);
            --theme-nav-scrolled: rgba(255, 255, 255, 0.92);
            --theme-footer-bg: #1f2937;
            --theme-footer-bg-2: #111827;
            --theme-btn-secondary-bg: rgba(0, 0, 0, 0.04);
            --theme-btn-secondary-border: rgba(0, 0, 0, 0.1);
            --theme-btn-secondary-text: rgba(0, 0, 0, 0.5);
            --theme-input-bg: rgba(0, 0, 0, 0.03);
            --theme-input-border: rgba(0, 0, 0, 0.1);
            --theme-input-text: #1f2937;
            --theme-input-placeholder: rgba(0, 0, 0, 0.3);
            --theme-input-icon: rgba(0, 0, 0, 0.3);
            --theme-card-shadow: 0 20px 60px rgba(0,0,0,0.08);
            --theme-hero-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%);
            --theme-skeleton-overlay: linear-gradient(135deg, #f8f9fa, #ffffff, #f0f0f5);
            --theme-skeleton-shine: rgba(0,0,0,0.04);
            --theme-skeleton-shine-2: rgba(0,0,0,0.08);
        }

        /* Smooth theme transition */
        body, .dark-navbar, .donor-hero, .profile-section, .edit-section,
        .profile-card, .edit-card, .footer, .profile-footer, .edit-footer,
        .blood-groups, .features, .why-donate, .contact-section, .filter-section,
        .donor-section, .filter-card, .donor-card, .contact-form-wrapper,
        .contact-info-card, .emergency-card, .blood-card, .feature-card,
        .info-item, .donation-status, .status-bar, .navbar-collapse,
        .alert-custom, .reset-info-badge, .form-group input, .form-group select,
        .form-group textarea, .input-group-custom input, .input-group-custom select,
        .search-wrap input, .select-wrap select, .btn-cancel, .btn-reset,
        .btn-back, .profile-footer, .edit-footer, .confirm-modal {
            transition: background 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== SCROLL ANIMATIONS (AOS) ===== */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
            transition-duration: 0.7s;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            will-change: opacity, transform;
        }

        [data-aos].aos-animate {
            opacity: 1;
            transform: none;
        }

        [data-aos="fade-up"] { transform: translateY(40px); }
        [data-aos="fade-down"] { transform: translateY(-40px); }
        [data-aos="fade-left"] { transform: translateX(-40px); }
        [data-aos="fade-right"] { transform: translateX(40px); }
        [data-aos="zoom-in"] { transform: scale(0.85); }
        [data-aos="zoom-out"] { transform: scale(1.1); }
        [data-aos="flip-up"] { transform: perspective(600px) rotateX(15deg); }
        [data-aos="flip-down"] { transform: perspective(600px) rotateX(-15deg); }

        /* Stagger delays */
        [data-aos-delay="100"] { transition-delay: 0.1s; }
        [data-aos-delay="150"] { transition-delay: 0.15s; }
        [data-aos-delay="200"] { transition-delay: 0.2s; }
        [data-aos-delay="300"] { transition-delay: 0.3s; }
        [data-aos-delay="400"] { transition-delay: 0.4s; }
        [data-aos-delay="500"] { transition-delay: 0.5s; }
        [data-aos-delay="600"] { transition-delay: 0.6s; }
        [data-aos-delay="700"] { transition-delay: 0.7s; }

        /* Preserve existing fade-in behavior */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* ===== LOADING SKELETON BASE ===== */
        [data-skeleton] {
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
            border-radius: 6px;
            color: transparent !important;
            user-select: none;
            pointer-events: none;
        }

        @keyframes skeleton-shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        #skeleton-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--theme-skeleton-overlay);
            overflow-y: auto;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #skeleton-overlay.skeleton-hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* ===== SKELETON BLOCK TYPES ===== */
        .sk-circle {
            display: block;
            border-radius: 50%;
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
        }

        .sk-block {
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
            border-radius: 6px;
        }

        .sk-line {
            height: 14px;
            border-radius: 4px;
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
        }
    </style>
</head>
<body>

    {{-- ===== LOADING SKELETON OVERLAY ===== --}}
    <div id="skeleton-overlay">
        @hasSection('skeleton')
            @yield('skeleton')
        @else
            {{-- Default skeleton: simple centered pulse --}}
            <div style="display:flex;align-items:center;justify-content:center;min-height:100vh;padding-top:72px;">
                <div style="text-align:center;">
                    <div style="width:60px;height:60px;margin:0 auto 20px;border:3px solid rgba(239,68,68,0.15);border-top-color:#ef4444;border-radius:50%;animation:sk-spin 0.8s linear infinite;"></div>
                    <div style="width:140px;height:12px;border-radius:6px;margin:0 auto;background:rgba(255,255,255,0.06);"></div>
                </div>
            </div>
            <style>
                @keyframes sk-spin { to { transform: rotate(360deg); } }
            </style>
        @endif
    </div>

    @include('frontend.partials.menu')
    @yield('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ===== THEME TOGGLE SYSTEM =====
(function() {
    var themeToggle = document.getElementById('themeToggle');
    var html = document.documentElement;
    var STORAGE_KEY = 'bloodbank_theme';

    function getPreferredTheme() {
        var stored = localStorage.getItem(STORAGE_KEY);
        if (stored) return stored;
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    }

    function applyTheme(theme) {
        if (theme === 'light') {
            html.classList.add('light-mode');
        } else {
            html.classList.remove('light-mode');
        }
        localStorage.setItem(STORAGE_KEY, theme);
        if (themeToggle) {
            themeToggle.innerHTML = theme === 'light'
                ? '<i class="bi bi-moon-stars-fill"></i>'
                : '<i class="bi bi-sun-fill"></i>';
            themeToggle.setAttribute('data-theme', theme);
        }
    }

    // Apply saved theme on load
    applyTheme(getPreferredTheme());

    // Listen for system preference changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', function(e) {
            if (!localStorage.getItem(STORAGE_KEY)) {
                applyTheme(e.matches ? 'light' : 'dark');
            }
        });
    }

    // Toggle click handler
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            var current = html.classList.contains('light-mode') ? 'dark' : 'light';
            applyTheme(current);
        });
    }
})();

// ===== AOS - ANIMATE ON SCROLL =====
(function() {
    function initAOS() {
        var targets = document.querySelectorAll('[data-aos]');
        if (!targets.length) return;

        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        });

        targets.forEach(function(el) { observer.observe(el); });
    }

    // Run after skeleton hides
    var overlay = document.getElementById('skeleton-overlay');
    if (overlay) {
        var checkHide = setInterval(function() {
            if (overlay.style.display === 'none' || overlay.classList.contains('skeleton-hidden')) {
                clearInterval(checkHide);
                setTimeout(initAOS, 100);
            }
        }, 100);
        setTimeout(function() { clearInterval(checkHide); initAOS(); }, 2500);
    } else {
        if (document.readyState === 'complete') {
            setTimeout(initAOS, 200);
        } else {
            window.addEventListener('load', function() { setTimeout(initAOS, 200); });
        }
    }
})();

// ===== HIDE SKELETON ON PAGE LOAD =====
(function() {
    var overlay = document.getElementById('skeleton-overlay');
    if (!overlay) return;

    function hideSkeleton() {
        overlay.classList.add('skeleton-hidden');
        setTimeout(function() {
            overlay.style.display = 'none';
        }, 500);
    }

    if (document.readyState === 'complete') {
        hideSkeleton();
    } else {
        window.addEventListener('load', hideSkeleton);
        // Fallback: hide after 2 seconds max
        setTimeout(hideSkeleton, 2000);
    }
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

{{-- ===== FLOATING ACTION BUTTON ===== --}}
<div class="fab-container" id="fabContainer">
    <div class="fab-backdrop" id="fabBackdrop" onclick="closeFab()"></div>

    {{-- Menu Items (reversed order so first appears on top when expanded) --}}
    <div class="fab-menu" id="fabMenu">
        {{-- Profile (only shown for authenticated users, but we'll handle with JS) --}}
        <a href="{{ url('/profile') }}" class="fab-item" data-tooltip="My Profile" data-auth="true" style="--i:3;">
            <span class="fab-item-bg" style="background:linear-gradient(135deg,#667eea,#764ba2);"></span>
            <i class="bi bi-person-circle"></i>
        </a>

        {{-- Donor List --}}
        <a href="{{ url('/donor_list') }}" class="fab-item" data-tooltip="Donor List" style="--i:2;">
            <span class="fab-item-bg" style="background:linear-gradient(135deg,#22c55e,#16a34a);"></span>
            <i class="bi bi-people-fill"></i>
        </a>

        {{-- Emergency Request --}}
        <a href="{{ url('/emergency-request') }}" class="fab-item" data-tooltip="Emergency Request" style="--i:1;">
            <span class="fab-item-bg" style="background:linear-gradient(135deg,#dc2626,#ef4444);"></span>
            <i class="bi bi-exclamation-triangle-fill"></i>
        </a>
    </div>

    {{-- Main Toggle Button --}}
    <button class="fab-toggle" id="fabToggle" onclick="toggleFab()" aria-label="Quick Actions">
        <span class="fab-toggle-bg"></span>
        <i class="bi bi-droplet-fill fab-icon-main"></i>
        <i class="bi bi-x-lg fab-icon-close"></i>
    </button>
</div>

<style>
/* ===== FAB Container ===== */
.fab-container {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 9998;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
}

/* Backdrop */
.fab-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: -1;
    opacity: 0;
    visibility: hidden;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

.fab-container.active .fab-backdrop {
    opacity: 1;
    visibility: visible;
}

/* ===== Menu Items ===== */
.fab-menu {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
    position: relative;
    z-index: 1;
}

.fab-item {
    position: relative;
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    transform: scale(0) translateY(30px);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    transition-delay: calc(var(--i) * 0.06s);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    overflow: hidden;
    position: relative;
}

.fab-container.active .fab-item {
    transform: scale(1) translateY(0);
    opacity: 1;
}

.fab-item:hover {
    transform: scale(1.1) translateY(-2px) !important;
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
}

.fab-item:active {
    transform: scale(0.95) !important;
}

.fab-item .fab-item-bg {
    position: absolute;
    inset: 0;
    border-radius: 16px;
    transition: all 0.3s;
}

.fab-item i {
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 1px 3px rgba(0,0,0,0.2));
}

/* ===== Tooltip ===== */
.fab-item::after {
    content: attr(data-tooltip);
    position: absolute;
    right: calc(100% + 14px);
    top: 50%;
    transform: translateY(-50%) scale(0.85);
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: #fff;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    white-space: nowrap;
    pointer-events: none;
    opacity: 0;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    transition-delay: 0s;
    border: 1px solid rgba(255,255,255,0.08);
}

.fab-item:hover::after {
    opacity: 1;
    transform: translateY(-50%) scale(1);
    transition-delay: 0.15s;
}

/* Small pointer arrow on tooltip */
.fab-item::before {
    content: '';
    position: absolute;
    right: calc(100% + 8px);
    top: 50%;
    transform: translateY(-50%) scale(0);
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    border-left: 6px solid rgba(0,0,0,0.85);
    pointer-events: none;
    opacity: 0;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    transition-delay: 0s;
}

.fab-item:hover::before {
    opacity: 1;
    transform: translateY(-50%) scale(1);
    transition-delay: 0.15s;
}

/* ===== Main Toggle Button ===== */
.fab-toggle {
    position: relative;
    width: 62px;
    height: 62px;
    border-radius: 18px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    padding: 0;
}

.fab-toggle-bg {
    position: absolute;
    inset: 0;
    border-radius: 18px;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    box-shadow: 0 6px 28px rgba(220, 38, 38, 0.45);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.fab-toggle:hover .fab-toggle-bg {
    box-shadow: 0 8px 40px rgba(220, 38, 38, 0.6);
}

.fab-toggle:active {
    transform: scale(0.92);
}

.fab-container.active .fab-toggle {
    transform: rotate(45deg);
}

.fab-container.active .fab-toggle-bg {
    background: linear-gradient(135deg, #1f2937, #374151);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.fab-icon-main {
    position: absolute;
    font-size: 26px;
    color: #fff;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

.fab-icon-close {
    position: absolute;
    font-size: 22px;
    color: #fff;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    transform: scale(0);
}

.fab-container.active .fab-icon-main {
    opacity: 0;
    transform: scale(0) rotate(-180deg);
}

.fab-container.active .fab-icon-close {
    opacity: 1;
    transform: scale(1) rotate(360deg);
}

/* ===== Pulse animation on toggle button ===== */
.fab-toggle::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 22px;
    background: rgba(220, 38, 38, 0.2);
    animation: fab-pulse 2.5s ease-in-out infinite;
    z-index: -1;
}

@keyframes fab-pulse {
    0%, 100% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.2); opacity: 0; }
}

.fab-container.active .fab-toggle::after {
    animation: none;
    opacity: 0;
}

/* ===== Light mode ===== */
.light-mode .fab-backdrop {
    background: rgba(0,0,0,0.15);
}

.light-mode .fab-item::after {
    background: rgba(0,0,0,0.9);
    color: #fff;
    border-color: rgba(255,255,255,0.08);
}

.light-mode .fab-item::before {
    border-left-color: rgba(0,0,0,0.9);
}

.light-mode .fab-container.active .fab-toggle-bg {
    background: linear-gradient(135deg, #374151, #4b5563);
}

/* ===== Mobile ===== */
@media (max-width: 767.98px) {
    .fab-container {
        bottom: 20px;
        right: 16px;
    }

    .fab-toggle {
        width: 54px;
        height: 54px;
        border-radius: 16px;
    }

    .fab-toggle-bg {
        border-radius: 16px;
    }

    .fab-item {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        font-size: 18px;
    }

    .fab-item .fab-item-bg {
        border-radius: 14px;
    }

    .fab-icon-main {
        font-size: 22px;
    }

    .fab-icon-close {
        font-size: 18px;
    }

    /* Smaller tooltip on mobile */
    .fab-item::after {
        font-size: 11px;
        padding: 5px 10px;
        right: calc(100% + 10px);
    }

    .fab-item::before {
        right: calc(100% + 5px);
    }
}

@media (max-width: 480px) {
    .fab-container {
        bottom: 16px;
        right: 12px;
    }

    .fab-toggle {
        width: 48px;
        height: 48px;
        border-radius: 14px;
    }

    .fab-toggle-bg {
        border-radius: 14px;
    }

    .fab-item {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        font-size: 16px;
    }

    .fab-item .fab-item-bg {
        border-radius: 12px;
    }

    .fab-icon-main {
        font-size: 19px;
    }

    .fab-icon-close {
        font-size: 16px;
    }

    .fab-menu {
        gap: 10px;
    }
}
</style>

<script>
// ===== FAB TOGGLE =====
function toggleFab() {
    var container = document.getElementById('fabContainer');
    container.classList.toggle('active');
}

function closeFab() {
    var container = document.getElementById('fabContainer');
    container.classList.remove('active');
}

// Close FAB on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeFab();
    }
});

// Hide profile link if user is not authenticated
(function() {
    var profileItem = document.querySelector('.fab-item[data-auth="true"]');
    if (profileItem) {
        // Check if user is authenticated by looking for auth-related elements
        var isAuth = document.querySelector('.btn-logout') !== null;
        if (!isAuth) {
            profileItem.style.display = 'none';
        }
    }
})();
</script>

</body>
</html>