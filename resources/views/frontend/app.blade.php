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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-KOKx7/j+fNU1R1H9lKDz9EwT5PpFKF4P4FQn8vHCEa8l/HzIhM+fq0Iu6iX2QzYeb6gi3W4Z2Zob/nkZfgF+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ===== LOADING SKELETON BASE ===== */
        [data-skeleton] {
            background: linear-gradient(90deg, 
                rgba(255,255,255,0.04) 25%, 
                rgba(255,255,255,0.08) 50%, 
                rgba(255,255,255,0.04) 75%
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
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
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
                rgba(255,255,255,0.04) 25%, 
                rgba(255,255,255,0.08) 50%, 
                rgba(255,255,255,0.04) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
        }

        .sk-block {
            background: linear-gradient(90deg, 
                rgba(255,255,255,0.04) 25%, 
                rgba(255,255,255,0.08) 50%, 
                rgba(255,255,255,0.04) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
            border-radius: 6px;
        }

        .sk-line {
            height: 14px;
            border-radius: 4px;
            background: linear-gradient(90deg, 
                rgba(255,255,255,0.04) 25%, 
                rgba(255,255,255,0.08) 50%, 
                rgba(255,255,255,0.04) 75%
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
</body>
</html>