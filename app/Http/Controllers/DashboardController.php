<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $adoptions = $user->role === 'client' 
            ? \App\Models\Adoption::where('user_id', $user->id)->get() 
            : \App\Models\Adoption::all();
            
        $bookings = $user->role === 'client'
            ? \App\Models\HotelBooking::where('user_id', $user->id)->get()
            : \App\Models\HotelBooking::all();

        return view('dashboard', compact('adoptions', 'bookings'));
    }
}
