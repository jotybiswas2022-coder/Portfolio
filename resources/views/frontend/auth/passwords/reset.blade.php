<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f0f1a 0%,#1a0a0a 50%,#0d0d1a 100%);position:relative;overflow:hidden;padding:24px 16px;font-family:'Inter','Noto Sans Bengali',sans-serif;">

    {{-- BG orbs --}}
    <div style="position:absolute;inset:0;overflow:hidden;pointer-events:none;">
        <div style="position:absolute;top:-200px;left:50%;transform:translateX(-50%);width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.2) 0%,transparent 70%);animation:orbPulse 4s ease-in-out infinite;"></div>
        <div style="position:absolute;bottom:-150px;left:-100px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,0.1) 0%,transparent 70%);animation:orbPulse2 6s ease-in-out infinite;"></div>
    </div>

    {{-- Grid overlay --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>

    {{-- Card --}}
    <div style="width:100%;max-width:460px;position:relative;z-index:1;animation:cardIn 0.6s cubic-bezier(0.22,1,0.36,1) both;">

        {{-- Brand --}}
        <div style="text-align:center;margin-bottom:28px;">
            <div style="width:56px;height:56px;margin:0 auto 12px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 30px rgba(220,38,38,0.3);">
                <i class="bi bi-droplet-fill" style="font-size:26px;color:#fff;"></i>
            </div>
            <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:0.3px;">ব্লাড ব্যাংক</div>
            <div style="font-size:11px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-top:4px;">রক্তদান · জীবন বাঁচান</div>
        </div>

        {{-- Card --}}
        <div style="background:rgba(255,255,255,0.04);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border-radius:20px;border:1px solid rgba(255,255,255,0.08);overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.5),0 0 0 1px rgba(255,255,255,0.05);">

            {{-- Header --}}
            <div style="padding:28px 32px 20px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.06);">
                <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:4px;">
                    <span style="width:36px;height:36px;border-radius:10px;background:rgba(220,38,38,0.15);display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-key-fill" style="font-size:15px;color:#ef4444;"></i>
                    </span>
                    <span style="font-size:17px;font-weight:700;color:#fff;">নতুন পাসওয়ার্ড সেট করুন</span>
                </div>
                <p style="font-size:12.5px;color:rgba(255,255,255,0.35);margin:6px 0 0;">আপনার নতুন পাসওয়ার্ড দিন এবং নিশ্চিত করুন</p>
            </div>

            {{-- Body --}}
            <div style="padding:28px 32px 24px;">

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div style="margin-bottom:18px;">
                        <label for="email" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>ইমেইল ঠিকানা
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-envelope-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.25s;"></i>
                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="you@example.com" required autofocus readonly
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.03);border:1.5px solid rgba(255,255,255,0.06);border-radius:10px;color:rgba(255,255,255,0.5);font-size:14px;font-family:inherit;outline:none;cursor:not-allowed;box-sizing:border-box;">
                        </div>
                        @error('email')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div style="margin-bottom:18px;">
                        <label for="password" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>নতুন পাসওয়ার্ড
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-lock-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.25s;"></i>
                            <input id="password" type="password" name="password" placeholder="••••••••" required
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.25s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                        </div>
                        @error('password')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom:22px;">
                        <label for="password-confirm" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>পাসওয়ার্ড নিশ্চিত করুন
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-shield-lock-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.25s;"></i>
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder="••••••••" required
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.25s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            style="width:100%;padding:13px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:15px;font-weight:700;font-family:inherit;border:none;border-radius:10px;cursor:pointer;letter-spacing:0.3px;transition:all 0.3s cubic-bezier(0.4,0,0.2,1);box-shadow:0 4px 20px rgba(220,38,38,0.35);display:flex;align-items:center;justify-content:center;gap:8px;"
                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(220,38,38,0.5)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(220,38,38,0.35)'">
                        <i class="bi bi-check2-circle"></i> পাসওয়ার্ড রিসেট করুন
                    </button>

                </form>

            </div>

            {{-- Bottom strip --}}
            <div style="padding:12px 32px;background:rgba(220,38,38,0.04);border-top:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;gap:6px;">
                <i class="bi bi-shield-check" style="font-size:12px;color:rgba(255,255,255,0.2);"></i>
                <span style="font-size:11px;color:rgba(255,255,255,0.2);">আপনার তথ্য সম্পূর্ণ সুরক্ষিত</span>
            </div>

        </div>

        {{-- Footer --}}
        <div style="text-align:center;margin-top:24px;font-size:11.5px;color:rgba(255,255,255,0.12);">
            Developed by <span style="font-weight:700;background:linear-gradient(135deg,#ef4444,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Joty Biswas</span> &copy; {{ date('Y') }}
        </div>

    </div>

</div>

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
@keyframes cardIn {
    from { opacity: 0; transform: translateY(30px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
* { box-sizing: border-box; }
body { margin: 0; }
@media (max-width: 480px) {
    div[style*="padding:28px 32px 24px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:28px 32px 20px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:12px 32px"] { padding-left: 20px !important; padding-right: 20px !important; }
}
</style>
