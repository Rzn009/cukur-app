<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        $userCount = User::count();
        return view("pages.admin.index", compact('user', 'userCount'));
    }

        public function editProfileAdmin(){
        $admin = Auth::user();
        return view('pages.admin.editProfileAdmin', compact('admin'));
    }
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|confirmed|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|string|max:20',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($admin->photo) {
                Storage::delete('public/admin/' . $admin->photo);
            }
            
            // Upload foto baru
            $photoPath = $request->file('photo')->store('photos', 'public');
            $admin->photo = $photoPath;
        }
        $admin->save();

        return redirect()->route('dashboard.admin')->with('success', 'Profil berhasil diperbarui.');
    }
}
