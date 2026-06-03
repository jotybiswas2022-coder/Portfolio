<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ===============================
    // Profile View
    // ===============================
    public function index()
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'division' => '',
            ]
        );

        return view('frontend.profile.index', compact('profile'));
    }

    // Profile edit
    public function edit()
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'division' => '',
            ]
        );

        return view('frontend.profile.edit', compact('profile'));
    }

    // ===============================
    // Update Profile
    // ===============================
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'blood' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'number' => 'required|string|max:20',
            'division' => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $profile = Profile::where('user_id', Auth::id())->firstOrFail();

        $profile->update([
            'name' => $request->name,
            'blood' => $request->blood,
            'number' => $request->number,
            'division' => $request->division,   
            'last_donated' => $request->last_donated,
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $user = Auth::user();

            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'avatar_url' => Auth::user()->avatar 
                    ? Storage::url(Auth::user()->avatar) 
                    : null,
            ]);
        }

        return redirect('/profile')
            ->with('success', 'Profile updated successfully.');
    }
}