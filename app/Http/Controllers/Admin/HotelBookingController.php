<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    public function index()
    {
        // Showing all bookings, could paginate but get() is fine for now
        $bookings = HotelBooking::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.hotel_bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, HotelBooking $hotelBooking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $hotelBooking->update(['status' => $request->status]);

        return back()->with('success', 'Status rezerwacji został zaktualizowany.');
    }
}
