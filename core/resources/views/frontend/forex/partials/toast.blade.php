<div id="toastContainer" style="position: fixed; top: 80px; right: 16px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;"></div>

<script>
// Toast system
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const colors = {
        success: { bg: 'rgba(0,255,159,0.1)', border: 'rgba(0,255,159,0.25)', icon: '#00FF9F', glow: 'rgba(0,255,159,0.15)' },
        error: { bg: 'rgba(239,68,68,0.1)', border: 'rgba(239,68,68,0.25)', icon: '#EF4444', glow: 'rgba(239,68,68,0.15)' },
        info: { bg: 'rgba(0,174,239,0.1)', border: 'rgba(0,174,239,0.25)', icon: '#00AEEF', glow: 'rgba(0,174,239,0.15)' }
    };
    const c = colors[type] || colors.success;

    const toast = document.createElement('div');
    toast.style.cssText = `
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        background: ${c.bg};
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid ${c.border};
        border-radius: 12px;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 8px 32px ${c.glow}, 0 2px 8px rgba(0,0,0,0.2);
        min-width: 280px;
        max-width: 400px;
        transform: translateX(120%);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    `;

    const icons = {
        success: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        error: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
        info: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
    };

    toast.innerHTML = icons[type] || icons.success;
    toast.innerHTML += '<span style="flex:1">' + message + '</span>';

    // Progress bar
    const progress = document.createElement('div');
    progress.style.cssText = `
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        background: ${c.icon};
        border-radius: 0 0 0 12px;
        transition: width 3.5s linear;
        width: 100%;
        opacity: 0.5;
    `;
    toast.appendChild(progress);

    container.appendChild(toast);

    // Animate in
    requestAnimationFrame(function() {
        toast.style.transform = 'translateX(0)';
    });

    // Auto dismiss
    setTimeout(function() {
        toast.style.transform = 'translateX(120%)';
        toast.style.opacity = '0';
        setTimeout(function() { toast.remove(); }, 500);
    }, 3800);

    // Start progress bar after a frame
    requestAnimationFrame(function() {
        requestAnimationFrame(function() {
            progress.style.width = '0%';
        });
    });
}

// Make showToast globally available
window.showToast = showToast;
</script>
