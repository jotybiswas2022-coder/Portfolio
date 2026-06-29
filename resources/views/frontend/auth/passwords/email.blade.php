<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f0f1a 0%,#1a0a0a 50%,#0d0d1a 100%);position:relative;overflow:hidden;padding:24px 16px;font-family:'Inter','Noto Sans Bengali',sans-serif;">

    {{-- ====== ANIMATED BACKGROUND LAYER ====== --}}
    <div style="position:absolute;inset:0;overflow:hidden;pointer-events:none;">

        {{-- Orbs --}}
        <div style="position:absolute;top:-200px;left:50%;transform:translateX(-50%);width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.2) 0%,transparent 70%);animation:orbPulse 4s ease-in-out infinite;"></div>
        <div style="position:absolute;bottom:-150px;right:-100px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,0.1) 0%,transparent 70%);animation:orbPulse2 6s ease-in-out infinite;"></div>
        <div style="position:absolute;top:10%;left:5%;width:250px;height:250px;border-radius:50%;background:radial-gradient(circle,rgba(239,68,68,0.08) 0%,transparent 70%);animation:orbPulse3 8s ease-in-out infinite;"></div>

        {{-- Grid --}}
        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:48px 48px;"></div>

        {{-- Floating blood drops --}}
        <div class="float-drop" style="left:5%;  animation-duration:9s;  animation-delay:0s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:18%; animation-duration:12s; animation-delay:2s;  bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:35%; animation-duration:7.5s;animation-delay:4s;  bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:50%; animation-duration:11s; animation-delay:1s;  bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:68%; animation-duration:8.5s;animation-delay:3.5s;bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:82%; animation-duration:10.5s;animation-delay:5s; bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:93%; animation-duration:13s; animation-delay:2.5s;bottom:-30px;">🩸</div>

        {{-- Floating plus/cross signs --}}
        <span class="float-plus" style="left:10%; animation-duration:14s; animation-delay:1s;  bottom:-20px;">+</span>
        <span class="float-plus" style="left:25%; animation-duration:11s; animation-delay:3s;  bottom:-20px;">✚</span>
        <span class="float-plus" style="left:42%; animation-duration:16s; animation-delay:.5s;  bottom:-20px;">+</span>
        <span class="float-plus" style="left:60%; animation-duration:10s; animation-delay:2s;  bottom:-20px;">✚</span>
        <span class="float-plus" style="left:75%; animation-duration:12.5s;animation-delay:4s; bottom:-20px;">+</span>
        <span class="float-plus" style="left:88%; animation-duration:13s; animation-delay:1.5s;bottom:-20px;">✚</span>
    </div>

    {{-- ====== MAIN CARD ====== --}}
    <div style="width:100%;max-width:440px;position:relative;z-index:1;animation:cardIn 0.7s cubic-bezier(0.22,1,0.36,1) both;">

        {{-- Brand --}}
        <div style="text-align:center;margin-bottom:24px;">
            <div style="width:56px;height:56px;margin:0 auto 12px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 30px rgba(220,38,38,0.3);transition:transform 0.3s;"
                 onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="bi bi-droplet-fill" style="font-size:26px;color:#fff;"></i>
            </div>
            <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:0.3px;">{{ __('ব্লাড ব্যাংক') }}</div>
            <div style="font-size:11px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-top:4px;">{{ __('রক্তদান · জীবন বাঁচান') }}</div>
        </div>

        {{-- Card --}}
        <div style="background:rgba(255,255,255,0.04);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border-radius:20px;border:1px solid rgba(255,255,255,0.08);overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.5),0 0 0 1px rgba(255,255,255,0.05);">

            {{-- Header --}}
            <div style="padding:28px 32px 20px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.06);">
                <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:4px;">
                    <span style="width:36px;height:36px;border-radius:10px;background:rgba(220,38,38,0.15);display:flex;align-items:center;justify-content:center;transition:transform 0.3s;"
                          onmouseover="this.style.transform='rotate(10deg)'" onmouseout="this.style.transform='rotate(0)'">
                        <i class="bi bi-shield-lock-fill" style="font-size:15px;color:#ef4444;"></i>
                    </span>
                    <span style="font-size:17px;font-weight:700;color:#fff;">{{ __('পাসওয়ার্ড রিসেট করুন') }}</span>
                </div>
                <p style="font-size:12.5px;color:rgba(255,255,255,0.35);margin:6px 0 0;">{{ __('আপনার ইমেইল ঠিকানা দিন, আমরা একটি লিংক পাঠাব') }}</p>
            </div>

            {{-- Body --}}
            <div style="padding:28px 32px 24px;">

                {{-- Session Status --}}
                @if (session('status'))
                    <div style="padding:10px 14px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);border-radius:10px;color:#4ade80;font-size:13px;text-align:center;margin-bottom:18px;">
                        <i class="bi bi-check-circle-fill" style="margin-right:6px;"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="resetEmailForm">
                    @csrf

                    {{-- Email --}}
                    <div style="margin-bottom:22px;">
                        <label for="email" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;transition:all 0.3s;" class="label-dot"></span>{{ __('ইমেইল ঠিকানা') }}
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-envelope-fill field-icon-custom" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2;"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.3s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.08)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.style.boxShadow='none';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                        </div>
                        @error('email')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" id="sendResetBtn"
                            style="width:100%;padding:13px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:15px;font-weight:700;font-family:inherit;border:none;border-radius:10px;cursor:pointer;letter-spacing:0.3px;transition:all 0.3s cubic-bezier(0.4,0,0.2,1);box-shadow:0 4px 20px rgba(220,38,38,0.35);display:flex;align-items:center;justify-content:center;gap:8px;position:relative;overflow:hidden;"
                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(220,38,38,0.5)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(220,38,38,0.35)'">
                        <span class="btn-text"><i class="bi bi-send-fill"></i> {{ __('রিসেট লিংক পাঠান') }}</span>
                        <span class="btn-loader" style="display:none;width:20px;height:20px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;"></span>
                    </button>

                </form>

                {{-- Back to Login --}}
                <div style="text-align:center;margin-top:20px;">
                    <a href="{{ route('login') }}"
                       style="font-size:13px;color:rgba(239,68,68,0.6);text-decoration:none;transition:color 0.2s;display:inline-flex;align-items:center;gap:6px;"
                       onmouseover="this.style.color='#ef4444'"
                       onmouseout="this.style.color='rgba(239,68,68,0.6)'">
                        <i class="bi bi-arrow-left"></i> {{ __('লগইন পৃষ্ঠায় ফিরুন') }}
                    </a>
                </div>

            </div>

            {{-- Bottom strip --}}
            <div style="padding:12px 32px;background:rgba(220,38,38,0.04);border-top:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;gap:6px;">
                <i class="bi bi-shield-check" style="font-size:12px;color:rgba(255,255,255,0.2);"></i>
                <span style="font-size:11px;color:rgba(255,255,255,0.2);">{{ __('আপনার তথ্য সম্পূর্ণ সুরক্ষিত') }}</span>
            </div>

        </div>

        {{-- Footer --}}
        <div style="text-align:center;margin-top:24px;font-size:11.5px;color:rgba(255,255,255,0.12);">
            Developed by <span style="font-weight:700;background:linear-gradient(135deg,#ef4444,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Joty Biswas</span> &copy; {{ date('Y') }}
        </div>

    </div>

</div>

<script>
// ── Submit Loading State ──
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('resetEmailForm');
    var btn = document.getElementById('sendResetBtn');
    if (form && btn) {
        form.addEventListener('submit', function() {
            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.btn-loader').style.display = 'inline-block';
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.85';
        });
    }
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700;800&display=swap');

@keyframes orbPulse {
    0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.7; }
    50% { transform: translateX(-50%) scale(1.12); opacity: 1; }
}
@keyframes orbPulse2 {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}
@keyframes orbPulse3 {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.25); opacity: 0.6; }
}
@keyframes cardIn {
    from { opacity: 0; transform: translateY(30px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Floating blood drops */
.float-drop {
    position: absolute;
    font-size: 20px;
    opacity: 0;
    animation: floatDrop linear infinite;
    pointer-events: none;
    user-select: none;
    filter: drop-shadow(0 0 6px rgba(220,38,38,0.3));
}
@keyframes floatDrop {
    0%   { transform: translateY(0) rotate(0deg) scale(0.6); opacity: 0; }
    10%  { opacity: 0.35; transform: translateX(10px) rotate(15deg) scale(0.8); }
    50%  { opacity: 0.2; transform: translateX(-15px) rotate(45deg) scale(1); }
    90%  { opacity: 0.3; transform: translateX(8px) rotate(75deg) scale(0.7); }
    100% { transform: translateY(-105vh) rotate(90deg) scale(0.4); opacity: 0; }
}

/* Floating plus signs */
.float-plus {
    position: absolute;
    color: rgba(255,120,120,0.2);
    font-size: 22px;
    font-weight: 900;
    animation: floatPlus linear infinite;
    pointer-events: none;
    user-select: none;
}
@keyframes floatPlus {
    0%   { transform: translateY(0) rotate(0deg);   opacity: 0; }
    15%  { opacity: 0.45; }
    85%  { opacity: 0.15; }
    100% { transform: translateY(-110vh) rotate(180deg); opacity: 0; }
}

* { box-sizing: border-box; }
body { margin: 0; }

@media (max-width: 480px) {
    div[style*="padding:28px 32px 24px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:28px 32px 20px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:12px 32px"] { padding-left: 20px !important; padding-right: 20px !important; }
}
</style>
