<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm py-2 dark-navbar">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 text-light" href="/">
            <i class="bi bi-droplet-fill me-2" style="color: red; font-size: 1.6rem;"></i>
            <span>ব্লাড ব্যাংক</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTopNav"
                aria-controls="navbarTopNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('profile') ? 'active-link' : '' }}" href="{{ url('/profile') }}">
                            <i class="bi bi-person-circle me-1"></i> My Profile
                        </a>
                    </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link {{ request()->is('admin') ? 'active-link' : '' }}" href="/admin">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100 text-start">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="/login">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link signup-btn text-center" href="/register">
                            <i class="bi bi-person-plus me-1"></i> Signup
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- ===== CSS ===== -->
<style>
/* Navbar adjustments */
.dark-navbar {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    transition: all 0.3s ease;
}
.navbar-brand {
    font-size: 1.5rem !important;
    gap: 8px;
    display: flex;
    align-items: center;
}
.top-nav-link {
    color: rgba(255,255,255,0.85) !important;
    font-weight: 500;
    padding: 8px 16px !important;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.top-nav-link:hover {
    color: #fff !important;
    background: rgba(255,255,255,0.1);
    transform: translateY(-1px);
}
.active-link {
    color: #fff !important;
    background: rgba(231,76,60,0.3) !important;
    border-bottom: 2px solid #E74C3C;
}
.signup-btn {
    background: linear-gradient(135deg, #c0392b, #E74C3C) !important;
    color: #fff !important;
    padding: 8px 24px !important;
    border-radius: 25px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}
.signup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(231,76,60,0.4);
}
/* Logout button */
.btn-logout {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.3);
    color: rgba(255,255,255,0.85);
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 0.95rem;
}
.btn-logout:hover {
    background: rgba(231,76,60,0.2);
    border-color: #E74C3C;
    color: #fff;
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .navbar-nav {
        text-align: center;
        gap: 10px !important;
        margin-top: 15px;
    }
    .signup-btn, .btn-logout {
        width: 100%;
        text-align: center;
    }
    .navbar-brand {
        font-size: 1.25rem !important;
    }
}
</style>