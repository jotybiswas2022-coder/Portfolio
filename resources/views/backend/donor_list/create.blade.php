@extends('backend.app')

@section('content')

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-bottom:24px;gap:12px;">
        <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#e35e6f,#dc3545);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
            <i class="bi bi-person-plus me-2" style="-webkit-text-fill-color:#e35e6f;"></i>Add New Donor
        </h4>
        <a href="{{ url('admin/donor_list') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 20px;border-radius:50px;border:1.5px solid #e8e8f0;background:#fff;color:#888;text-decoration:none;font-weight:600;font-size:0.85rem;transition:all 0.3s;"
           onmouseover="this.style.borderColor='#667eea';this.style.color='#667eea'"
           onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#888'">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:560px;">
            <div style="background:#fff;border-radius:24px;box-shadow:0 8px 40px rgba(0,0,0,0.07);border:1px solid rgba(0,0,0,0.04);overflow:hidden;">

                {{-- Card accent --}}
                <div style="height:4px;background:linear-gradient(90deg,#667eea,#764ba2,#f093fb,#e35e6f);"></div>

                <div style="padding:28px 30px;">

                    <form action="{{ url('admin/donor_list/store') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-person me-1" style="color:#667eea;"></i>Name
                            </label>
                            <input type="text" name="name" required placeholder="Enter donor name"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#667eea';this.style.boxShadow='0 0 0 4px rgba(102,126,234,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Phone --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-phone me-1" style="color:#f093fb;"></i>Phone
                            </label>
                            <input type="text" name="number" required placeholder="Enter phone number"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#f093fb';this.style.boxShadow='0 0 0 4px rgba(240,147,251,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Blood + Division side by side --}}
                        <div style="display:flex;gap:12px;margin-bottom:18px;flex-wrap:wrap;">
                            <div style="flex:1;min-width:130px;">
                                <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                    <i class="bi bi-droplet me-1" style="color:#dc3545;"></i>Blood Group
                                </label>
                                <select name="blood" required
                                        style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;appearance:none;"
                                        onfocus="this.style.borderColor='#dc3545';this.style.boxShadow='0 0 0 4px rgba(220,53,69,0.1)'"
                                        onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                                    <option value="">Select Blood Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="flex:1;min-width:130px;">
                                <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                    <i class="bi bi-geo-alt me-1" style="color:#4facfe;"></i>Division
                                </label>
                                <select name="division" required
                                        style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;appearance:none;"
                                        onfocus="this.style.borderColor='#4facfe';this.style.boxShadow='0 0 0 4px rgba(79,172,254,0.1)'"
                                        onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division }}">{{ $division }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Last Donation --}}
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:0.8rem;font-weight:600;color:#555;margin-bottom:5px;">
                                <i class="bi bi-calendar me-1" style="color:#43e97b;"></i>Last Donation Date
                            </label>
                            <input type="date" name="last_donated"
                                   style="width:100%;padding:11px 16px;border-radius:14px;border:1.5px solid #e8e8f0;font-size:0.9rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                   onfocus="this.style.borderColor='#43e97b';this.style.boxShadow='0 0 0 4px rgba(67,233,123,0.1)'"
                                   onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        </div>

                        {{-- Submit --}}
                        <div style="margin-top:24px;">
                            <button type="submit"
                                    style="width:100%;padding:13px 20px;border-radius:16px;border:none;background:linear-gradient(135deg,#e35e6f,#dc3545);color:#fff;font-size:0.95rem;font-weight:700;cursor:pointer;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 6px 20px rgba(220,53,69,0.3);display:flex;align-items:center;justify-content:center;gap:8px;"
                                    onmouseover="this.style.transform='translateY(-2px) scale(1.01)';this.style.boxShadow='0 10px 32px rgba(220,53,69,0.4)'"
                                    onmouseout="this.style.transform='';this.style.boxShadow='0 6px 20px rgba(220,53,69,0.3)'">
                                <i class="bi bi-check-circle"></i> Save Donor
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- SweetAlert --}}
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
@endif
</script>

@endsection