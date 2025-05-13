<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Shcedule;
use App\Models\Bookings;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $barbers = Barber::all();
        $services = Service::all();
        $schedules = Shcedule::all();

        // Hitung total booking
        $totalBookings = Bookings::where('user_id', Auth::id())->count();
        
        // Hitung booking yang sudah selesai
        $completedBookings = Bookings::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
        
        // Hitung booking yang akan datang
        $upcomingBookings = Bookings::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->where('booking_date', '>=', Carbon::today())
            ->count();

        // Ambil semua booking customer
        $bookings = Bookings::with(['barber'])
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->get();

        return view('pages.customer.index', compact(
            'barbers', 
            'services', 
            'schedules',
            'totalBookings',
            'completedBookings',
            'upcomingBookings',
            'bookings'
        ));

    }

    public function profilUpdate(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            
            // Upload foto baru
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('page.customer')->with('success', 'Profil berhasil diperbarui!');
    }

    public function markNotificationAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai sudah dibaca');
    }
}
