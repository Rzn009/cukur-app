<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Riview;
use Illuminate\Http\Request;

class RiviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'barber_id' => 'required|exists:barbers,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        Riview::create([
            'user_id' => auth()->id(),
            'booking_id' => $request->booking_id,
            'barber_id' => $request->barber_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review berhasil dikirim!');
    }
}
