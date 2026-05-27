// ==================== CART SYSTEM ====================
window.getCart = function() {
    try { return JSON.parse(localStorage.getItem('forex_cart') || '[]'); }
    catch(e) { return []; }
};
window.saveCart = function(cart) {
    localStorage.setItem('forex_cart', JSON.stringify(cart));
};
window.clearCart = function() {
    localStorage.removeItem('forex_cart');
};
window.updateCartButtons = function() {
    const cart = window.getCart();
    document.querySelectorAll('[data-cart-id]').forEach(function(btn) {
        const itemId = btn.getAttribute('data-cart-id');
        const isInCart = cart.some(function(item) {
            return String(item.id) === String(itemId);
        });
        if (isInCart) {
            btn.disabled = true;
            btn.innerHTML = '<svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Added To Cart';
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
        }
    });
};

window.addToCart = function(item) {
    const cart = window.getCart();
    const existing = cart.findIndex(i => i.id === item.id);
    if (existing >= 0) {
        cart[existing].qty = (cart[existing].qty || 1) + 1;
    } else {
        cart.push({ ...item, qty: 1 });
    }
    window.saveCart(cart);
    window.updateCartBadge();
    window.updateCartButtons();
    window.showToast(`${item.name} added to cart!`, 'success');
};
window.removeFromCart = function(index) {
    const cart = window.getCart();
    cart.splice(index, 1);
    window.saveCart(cart);
    window.updateCartBadge();
    window.updateCartButtons();
    if (typeof renderCart === 'function') renderCart();
};
window.updateCartBadge = function() {
    const badge = document.getElementById('cartBadge');
    if (!badge) return;
    const cart = window.getCart();
    const count = cart.reduce((s, i) => s + (i.qty || 1), 0);
    if (count > 0) {
        badge.classList.remove('hidden');
        badge.textContent = count > 99 ? '99+' : count;
    } else {
        badge.classList.add('hidden');
    }
};

// ==================== TOAST SYSTEM ====================
window.showToast = function(message, type = 'info') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const colors = { success: '#22c55e', error: '#ef4444', info: '#3b82f6', warning: '#f59e0b' };
    const toast = document.createElement('div');
    toast.className = 'flex items-center gap-3 px-4 py-3 rounded-lg shadow-2xl text-sm font-medium translate-x-full opacity-0 transition-all duration-300';
    toast.style.backgroundColor = '#1a1a1a';
    toast.style.border = '1px solid #2a2a2a';
    toast.style.borderLeft = `3px solid ${colors[type] || colors.info}`;
    toast.style.maxWidth = '380px';
    toast.innerHTML = `
        <span style="color:${colors[type] || colors.info}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>' :
                  type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>' :
                  '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'}
            </svg>
        </span>
        <span style="color: #e5e5e5">${message}</span>
    `;
    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
    });

    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
};

// ==================== NAVBAR SCROLL ====================
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.borderBottomColor = '#2a2a2a';
                navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.95)';
            } else {
                navbar.style.borderBottomColor = 'transparent';
                navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.8)';
            }
        });
    }

    // Mobile Drawer
    const menuBtn = document.getElementById('mobileMenuBtn');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const hamburger = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (menuBtn && drawer) {
        function openDrawer() {
            drawer.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (hamburger) hamburger.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
        }
        function closeDrawer() {
            drawer.classList.add('hidden');
            document.body.style.overflow = '';
            if (hamburger) hamburger.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }
        menuBtn.addEventListener('click', openDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);
        drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));
    }

    // Cookie Banner
    const cookieBanner = document.getElementById('cookieBanner');
    const cookieAccept = document.getElementById('cookieAccept');
    if (cookieBanner && !localStorage.getItem('cookie_consent')) {
        cookieBanner.classList.remove('hidden');
    }
    if (cookieAccept) {
        cookieAccept.addEventListener('click', () => {
            localStorage.setItem('cookie_consent', 'true');
            cookieBanner.classList.add('hidden');
        });
    }

    // Risk Disclaimer Toggle
    const riskToggle = document.getElementById('riskDisclaimerToggle');
    const riskContent = document.getElementById('riskDisclaimerContent');
    const riskChevron = document.getElementById('disclaimerChevron');
    if (riskToggle && riskContent) {
        riskToggle.addEventListener('click', () => {
            riskContent.classList.toggle('hidden');
            if (riskChevron) riskChevron.style.transform = riskContent.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    }

    // Initialize cart badge and button states
    window.updateCartBadge();
    window.updateCartButtons();
});
