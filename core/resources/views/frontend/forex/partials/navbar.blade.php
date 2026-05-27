<nav id="mainNavbar" style="position: fixed; top: 0; left: 0; right: 0; z-index: 50; transition: all 0.5s ease; background: rgba(10,10,10,0.55); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid transparent;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 16px;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">
            <!-- Logo -->
            <a href="{{ route('forex.home') }}" style="display: flex; align-items: center; gap: 8px; text-decoration: none;" class="logo-group">
                <div style="position: relative;">
                    <span style="font-size: 24px; font-weight: 800; letter-spacing: 1px;">
                        <span style="color: #fff; transition: color 0.3s ease;" class="logo-core">CORE</span>
                    </span>
                    <span style="color: #00AEEF; position: absolute; right: -14px; top: -4px; font-size: 18px; transition: all 0.3s ease; display: inline-block;" class="logo-diamond">◈</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div style="display: none; align-items: center; gap: 4px;" class="desktop-nav">
                <a href="{{ route('forex.home') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #d1d5db; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    Home
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: #00AEEF; transform: scaleX(0); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>

                <!-- EAs Dropdown -->
                <div style="position: relative; display: inline-block;" class="ea-dropdown-group">
                    <button style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #d1d5db; background: transparent; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px; position: relative; font-family: inherit;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                        Expert Advisors
                        <svg style="width: 12px; height: 12px; transition: transform 0.3s ease; color: #6b7280;" class="dropdown-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: #00AEEF; transform: scaleX(0); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                    </button>
                    <div style="position: absolute; top: 100%; left: 0; margin-top: 8px; width: 260px; background: rgba(15,15,20,0.95); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid #2a2a2a; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); opacity: 0; visibility: hidden; transition: all 0.2s ease; padding: 8px 0; overflow: hidden;" class="ea-dropdown-menu">
                        <div style="padding: 8px 16px 6px; border-bottom: 1px solid #2a2a2a; margin-bottom: 4px;">
                            <p style="color: #00AEEF; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Our Products</p>
                        </div>
                        <a href="{{ route('forex.product.dark-kronos') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #00AEEF; display: inline-block;"></span>
                            Dark Kronos
                        </a>
                        <a href="{{ route('forex.product.dark-nova') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #00FF9F; display: inline-block;"></span>
                            Dark Nova
                        </a>
                        <a href="{{ route('forex.product.dark-algo') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #A855F7; display: inline-block;"></span>
                            Dark Algo
                        </a>
                        <a href="{{ route('forex.product.dark-titan') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #F59E0B; display: inline-block;"></span>
                            Dark Titan
                        </a>
                        <a href="{{ route('forex.product.dark-gold') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #EF4444; display: inline-block;"></span>
                            Dark Gold
                        </a>
                        <div style="border-top: 1px solid #2a2a2a; margin: 4px 16px;"></div>
                        <a href="{{ route('forex.source-codes') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <svg style="width: 16px; height: 16px; color: #00AEEF;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            Source Codes
                        </a>
                    </div>
                </div>

                <a href="{{ route('forex.partnership') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #d1d5db; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    Partnership
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: #00AEEF; transform: scaleX(0); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                <a href="{{ route('forex.knowledgebase') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #d1d5db; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    Knowledge Base
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: #00AEEF; transform: scaleX(0); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                <a href="{{ route('forex.contact-us') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: #d1d5db; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    Contact
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: #00AEEF; transform: scaleX(0); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
            </div>

            <!-- Right side -->
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Cart -->
                <a href="{{ route('forex.cart') }}" style="position: relative; color: #9ca3af; text-decoration: none; transition: all 0.3s ease; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                    <svg style="width: 20px; height: 20px; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    <span id="cartBadge" style="position: absolute; top: -2px; right: -2px; background: linear-gradient(135deg, #00AEEF, #0095CC); color: #fff; font-size: 10px; font-weight: 800; border-radius: 50%; min-width: 18px; height: 18px; display: none; align-items: center; justify-content: center; padding: 0 4px; box-shadow: 0 0 8px rgba(0,174,239,0.4);">0</span>
                </a>

                <!-- Language -->
                <div style="position: relative; display: none;" class="lang-desktop">
                    <button style="width: 40px; height: 40px; border-radius: 8px; background: transparent; border: none; color: #9ca3af; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; gap: 3px; position: relative; font-family: inherit;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        EN
                    </button>
                </div>

                <!-- Auth -->
                @guest
                <a href="{{ route('login') }}" style="display: none; font-size: 14px; font-weight: 500; color: #9ca3af; text-decoration: none; padding: 8px 12px; border-radius: 8px; transition: all 0.3s ease;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'" class="login-desktop">Login</a>
                <a href="{{ route('register') }}" style="display: none; font-size: 14px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #00AEEF, #0095CC); text-decoration: none; padding: 8px 20px; border-radius: 8px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,174,239,0.15); position: relative; overflow: hidden;"
                onmouseover="this.style.boxShadow='0 6px 25px rgba(0,174,239,0.3)';this.style.transform='translateY(-1px)'" onmouseout="this.style.boxShadow='0 4px 15px rgba(0,174,239,0.15)';this.style.transform=''" class="signup-desktop">
                    <span style="position: relative; z-index: 1;">Sign Up</span>
                </a>
                @else
                <div style="display: none; align-items: center; gap: 12px;" class="auth-desktop">
                    <div style="position: relative;" class="profile-group">
                        <button style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #9ca3af; background: transparent; border: none; border-radius: 8px; cursor: pointer; padding: 8px 12px; transition: all 0.3s ease; font-family: inherit;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                            <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #00AEEF, #00FF9F); display: flex; align-items: center; justify-content: center; color: #0D0D0D; font-size: 12px; font-weight: 800;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg style="width: 12px; height: 12px; color: #6b7280; transition: transform 0.3s ease;" class="profile-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div style="position: absolute; top: 100%; right: 0; margin-top: 8px; width: 200px; background: rgba(15,15,20,0.95); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid #2a2a2a; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); opacity: 0; visibility: hidden; transition: all 0.2s ease; padding: 8px 0; overflow: hidden;" class="profile-dropdown">
                            <a href="/admin" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #00AEEF;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('forex.my-orders') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #00FF9F;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                My Orders
                            </a>
                            <a href="{{ route('forex.my-partnership') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                My Partnership
                            </a>
                            <div style="border-top: 1px solid #2a2a2a; margin: 4px 16px;"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; width: 100%; padding: 10px 16px; font-size: 14px; color: #d1d5db; background: transparent; border: none; cursor: pointer; transition: all 0.2s ease; font-family: inherit; text-align: left;"
                                onmouseover="this.style.color='#ef4444';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Mobile hamburger -->
                <button id="mobileMenuBtn" style="width: 40px; height: 40px; border-radius: 8px; background: transparent; border: none; color: #9ca3af; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'" class="mobile-menu-btn">
                    <svg id="hamburgerIcon" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="closeIcon" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div id="mobileDrawer" style="position: fixed; inset: 0; z-index: 40; display: none;" class="mobile-drawer">
        <div id="drawerOverlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"></div>
        <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 320px; max-width: 85vw; background: #111111; border-left: 1px solid #2a2a2a; padding: 24px; overflow-y: auto; box-shadow: -10px 0 40px rgba(0,0,0,0.5);">
            <!-- Mobile logo -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; padding-top: 16px;">
                <a href="{{ route('forex.home') }}" style="font-size: 20px; font-weight: 800; letter-spacing: 1px; text-decoration: none;">
                    <span style="color: #fff;">CORE</span>
                    <span style="color: #00AEEF;">◈</span>
                </a>
                <button id="drawerCloseBtn" style="width: 32px; height: 32px; border-radius: 8px; background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #9ca3af; transition: all 0.2s ease;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div style="display: flex; flex-direction: column; gap: 4px;">
                <a href="{{ route('forex.home') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Home</span>
                    <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <div style="padding: 8px 0;">
                    <p style="font-size: 11px; color: #00AEEF; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 0 16px; margin: 0 0 8px 0;">Expert Advisors</p>
                    <div style="display: flex; flex-direction: column; gap: 2px; padding-left: 16px;">
                        <a href="{{ route('forex.product.dark-kronos') }}" style="display: flex; align-items: center; gap: 12px; color: #d1d5db; text-decoration: none; padding: 10px 16px; border-radius: 8px; transition: all 0.2s ease; font-size: 14px;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #00AEEF; display: inline-block;"></span>
                            Dark Kronos
                        </a>
                        <a href="{{ route('forex.product.dark-nova') }}" style="display: flex; align-items: center; gap: 12px; color: #d1d5db; text-decoration: none; padding: 10px 16px; border-radius: 8px; transition: all 0.2s ease; font-size: 14px;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #00FF9F; display: inline-block;"></span>
                            Dark Nova
                        </a>
                        <a href="{{ route('forex.product.dark-algo') }}" style="display: flex; align-items: center; gap: 12px; color: #d1d5db; text-decoration: none; padding: 10px 16px; border-radius: 8px; transition: all 0.2s ease; font-size: 14px;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #A855F7; display: inline-block;"></span>
                            Dark Algo
                        </a>
                        <a href="{{ route('forex.product.dark-titan') }}" style="display: flex; align-items: center; gap: 12px; color: #d1d5db; text-decoration: none; padding: 10px 16px; border-radius: 8px; transition: all 0.2s ease; font-size: 14px;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #F59E0B; display: inline-block;"></span>
                            Dark Titan
                        </a>
                        <a href="{{ route('forex.product.dark-gold') }}" style="display: flex; align-items: center; gap: 12px; color: #d1d5db; text-decoration: none; padding: 10px 16px; border-radius: 8px; transition: all 0.2s ease; font-size: 14px;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #EF4444; display: inline-block;"></span>
                            Dark Gold
                        </a>
                    </div>
                </div>

                <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 4px 0;"></div>

                <a href="{{ route('forex.source-codes') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Source Codes</span>
                    <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('forex.free-eas') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Free EAs</span>
                    <span style="padding: 2px 8px; background: #1a3a1a; color: #00FF9F; font-size: 10px; font-weight: 800; border-radius: 50px;">FREE</span>
                </a>

                <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 4px 0;"></div>

                <a href="{{ route('forex.partnership') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Partnership</span>
                    <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('forex.contact-us') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Contact</span>
                    <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('forex.knowledgebase') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Knowledge Base</span>
                    <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 4px 0;"></div>

                <a href="{{ route('forex.cart') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
                onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                    <span>Cart</span>
                    <span id="mobileCartBadge" style="display: none; padding: 2px 8px; background: #00AEEF; color: #fff; font-size: 10px; font-weight: 800; border-radius: 50px;">0</span>
                </a>

                @guest
                <div style="margin-top: 16px; padding: 0 16px; display: flex; flex-direction: column; gap: 8px;">
                    <a href="{{ route('login') }}" style="display: block; width: 100%; text-align: center; font-size: 14px; font-weight: 500; color: #9ca3af; text-decoration: none; padding: 12px; border-radius: 12px; border: 1px solid #2a2a2a; transition: all 0.2s ease; box-sizing: border-box;"
                    onmouseover="this.style.color='#fff';this.style.borderColor='rgba(0,174,239,0.3)'" onmouseout="this.style.color='#9ca3af';this.style.borderColor='#2a2a2a'">Login</a>
                    <a href="{{ route('register') }}" style="display: block; width: 100%; text-align: center; font-size: 14px; font-weight: 700; color: #fff; background: linear-gradient(135deg, #00AEEF, #0095CC); text-decoration: none; padding: 12px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,174,239,0.15); transition: all 0.3s ease; box-sizing: border-box;"
                    onmouseover="this.style.boxShadow='0 6px 25px rgba(0,174,239,0.3)'" onmouseout="this.style.boxShadow='0 4px 15px rgba(0,174,239,0.15)'">Sign Up</a>
                </div>
                @else
                <div style="margin-top: 16px; padding: 0 16px; padding-top: 16px; border-top: 1px solid #2a2a2a; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; background: rgba(255,255,255,0.03);">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #00AEEF, #00FF9F); display: flex; align-items: center; justify-content: center; color: #0D0D0D; font-size: 14px; font-weight: 800;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span style="color: #fff; font-size: 14px; font-weight: 500;">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="/admin" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px; color: #00AEEF;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('forex.my-orders') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px; color: #00FF9F;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        My Orders
                    </a>
                    <a href="{{ route('forex.my-partnership') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px; color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        My Partnership
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; background: transparent; border: none; cursor: pointer; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; font-family: inherit; text-align: left; box-sizing: border-box;"
                        onmouseover="this.style.color='#ef4444';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<style>
@media (min-width: 1024px) {
    .desktop-nav { display: flex !important; }
    .mobile-menu-btn { display: none !important; }
    .lang-desktop { display: inline-block !important; }
}
@media (min-width: 640px) {
    .login-desktop { display: inline-flex !important; }
    .signup-desktop { display: inline-flex !important; }
    .auth-desktop { display: flex !important; }
    .lang-desktop { display: inline-block !important; }
}

/* Dropdown hover */
.ea-dropdown-group:hover .ea-dropdown-menu {
    opacity: 1 !important;
    visibility: visible !important;
}
.ea-dropdown-group:hover .dropdown-chevron {
    transform: rotate(180deg) !important;
    color: #00AEEF !important;
}

/* Profile dropdown hover */
.profile-group:hover .profile-dropdown {
    opacity: 1 !important;
    visibility: visible !important;
}
.profile-group:hover .profile-chevron {
    transform: rotate(180deg) !important;
}

/* Nav link underline on hover */
.nav-underline {
    position: absolute;
    bottom: 0;
    left: 16px;
    right: 16px;
    height: 2px;
    background: #00AEEF;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
}
a:hover > .nav-underline {
    transform: scaleX(1) !important;
}

/* Logo hover */
.logo-group:hover .logo-core {
    color: #00AEEF !important;
}
.logo-group:hover .logo-diamond {
    animation: float 1.5s ease-in-out infinite !important;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

/* Cart hover effect */
a[href*="cart"]:hover svg {
    transform: scale(1.1) !important;
}

/* Scrollbar for mobile drawer */
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar {
    width: 4px;
}
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar-track {
    background: transparent;
}
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar-thumb {
    background: #2a2a2a;
    border-radius: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('mobileMenuBtn');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const closeBtn = document.getElementById('drawerCloseBtn');
    const hamburger = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (menuBtn && drawer) {
        function openDrawer() {
            drawer.style.display = 'block';
            document.body.style.overflow = 'hidden';
            if (hamburger) hamburger.style.display = 'none';
            if (closeIcon) closeIcon.style.display = 'block';
        }
        function closeDrawer() {
            drawer.style.display = 'none';
            document.body.style.overflow = '';
            if (hamburger) hamburger.style.display = 'block';
            if (closeIcon) closeIcon.style.display = 'none';
        }
        menuBtn.addEventListener('click', openDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        drawer.querySelectorAll('a').forEach(function(a) { a.addEventListener('click', closeDrawer); });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDrawer();
        });
    }

    // Update mobile cart badge
    function updateMobileBadge() {
        const badge = document.getElementById('cartBadge');
        const mobileBadge = document.getElementById('mobileCartBadge');
        if (!mobileBadge || !badge) return;
        const count = badge.textContent;
        if (count && count !== '0') {
            mobileBadge.style.display = 'inline-block';
            mobileBadge.textContent = count;
        } else {
            mobileBadge.style.display = 'none';
        }
    }
    
    // Watch for cart badge updates
    const observer = new MutationObserver(updateMobileBadge);
    const cartBadge = document.getElementById('cartBadge');
    if (cartBadge) {
        observer.observe(cartBadge, { childList: true, characterData: true, subtree: true });
    }
    updateMobileBadge();

    // Navbar scroll effect
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.style.borderColor = 'rgba(255,255,255,0.06)';
                navbar.style.background = 'rgba(10,10,10,0.85)';
            } else {
                navbar.style.borderColor = 'transparent';
                navbar.style.background = 'rgba(10,10,10,0.55)';
            }
        });
    }

    // Desktop nav link underline animation
    document.querySelectorAll('.desktop-nav > a, .desktop-nav > div a').forEach(function(link) {
        link.addEventListener('mouseenter', function() {
            const underline = this.querySelector('.nav-underline');
            if (underline) underline.style.transform = 'scaleX(1)';
        });
        link.addEventListener('mouseleave', function() {
            const underline = this.querySelector('.nav-underline');
            if (underline) underline.style.transform = 'scaleX(0)';
        });
    });

    // Cart icon hover
    const cartLinks = document.querySelectorAll('a[href*="cart"]');
    cartLinks.forEach(function(link) {
        link.addEventListener('mouseenter', function() {
            const svg = this.querySelector('svg');
            if (svg) svg.style.transform = 'scale(1.1)';
        });
        link.addEventListener('mouseleave', function() {
            const svg = this.querySelector('svg');
            if (svg) svg.style.transform = 'scale(1)';
        });
    });
});
</script>
