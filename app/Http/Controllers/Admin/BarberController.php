<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::with('user')->get();
        return view('pages.admin.barber.index', compact('barbers'));
    }

    public function create()
    {
        $users = User::where('role', 'barber')->get();
        return view('pages.admin.barber.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer',
            'speciality' => 'nullable|string|max:255',
            'available' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('barbers', 'public');
        }

        Barber::create($data);
        return redirect()->route('barber.index')->with('success', 'Barber berhasil ditambahkan.');
    }

    public function show(Barber $barber)
    {
        return view('pages.admin.barber.show', compact('barber'));
    }

    public function edit(Barber $barber)
    {
        $users = User::where('role', 'barber')->get();
        return view('pages.admin.barber.edit', compact('barber', 'users'));
    }

    public function update(Request $request, Barber $barber)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer',
            'speciality' => 'nullable|string|max:255',
            'available' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('barbers', 'public');
        }

        $barber->update($data);
        return redirect()->route('barber.index')->with('success', 'Barber berhasil diupdate.');
    }

    public function destroy(Barber $barber)
    {
        $barber->delete();
        return redirect()->route('barber.index')->with('success', 'Barber berhasil dihapus.');
    }
}
