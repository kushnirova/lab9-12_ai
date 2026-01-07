<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index()
    {
        $services = \App\Models\Service::all();
        return view('hotel.index', compact('services'));
    }

    public function create()
    {
        return view('hotel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'guinea_pig_name' => 'required|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        \App\Models\HotelBooking::create([
            'user_id' => Auth::id(),
            'guinea_pig_name' => $request->guinea_pig_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('dashboard')->with('success', 'Wniosek o rezerwację wysłany!');
    }
}
