<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Shcedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Shcedule::with('barber')->latest()->get();
        return view('pages.admin.shcedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barbers = Barber::all();
        return view('pages.admin.shcedule.create', compact('barbers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Shcedule::create($request->all());
        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barbers = Barber::all();
        return view('pages.admin.shcedule.edit', compact('schedule', 'barbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shcedule $schedule)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $schedule->update($request->all());
        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shcedule  $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
