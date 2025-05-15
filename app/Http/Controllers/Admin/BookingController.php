<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Bookings::with(['user', 'barber'])->get();
        return view('pages.admin.booking.index', compact('bookings'));
    }

    public function create()
    {
        $barbers = Barber::all();
        return view('pages.admin.booking.create', compact('barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'note' => 'nullable|string',
        ]);

        Bookings::create([
            'user_id' => auth()->id(),
            'barber_id' => $request->barber_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'note' => $request->note,
        ]);

        // Cek role user yang sedang login
        if (auth()->user()->is_admin) {
            return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat!');
        } else {
            return redirect()->route('page.customer')->with('success', 'Booking berhasil dibuat!');
        }
    }

    public function show(Bookings $booking)
    {
        return view('pages.admin.booking.show', compact('booking'));
    }

    public function edit(Bookings $booking)
    {
        $barbers = Barber::all();
        return view('pages.admin.booking.edit', compact('booking', 'barbers'));
    }

    public function update(Request $request, Bookings $booking)
    {
        $request->validate([
            'barber_id'     => 'required|exists:barbers,id',
            'booking_date'  => 'required|date',
            'booking_time'  => 'required',
            'status'        => 'required|in:pending,confirmed,completed,cancelled',
            'note'          => 'nullable|string',
        ]);

        $oldStatus = $booking->status;

        // Update data booking
        $booking->update($request->only('barber_id', 'booking_date', 'booking_time', 'status', 'note'));

        // Jika status diubah ke "confirmed", kirim notifikasi ke user
        if ($oldStatus !== 'confirmed' && $booking->status === 'confirmed') {
            $booking->user->notify(new \App\Notifications\BookingConfimedNotfification($booking));
        }

        // dd($booking->user->notifications);
        return redirect()->route(route: 'bookings.index')->with('success', 'Booking berhasil diupdate!');
    }



    public function destroy(Bookings $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');

        // Cek role user yang sedang login
        if (auth()->user()->is_admin) {
            return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat!');
        } else {
            return redirect()->route('page.customer')->with('success', 'Booking berhasil dibuat!');
        }
    }
}
