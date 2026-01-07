<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function index()
    {
        $guineaPigs = \App\Models\GuineaPig::where('status', 'available')->get();
        return view('adoptions.index', compact('guineaPigs'));
    }

    public function show(\App\Models\GuineaPig $guineaPig)
    {
        return view('adoptions.show', compact('guineaPig'));
    }

    public function store(Request $request, \App\Models\GuineaPig $guineaPig)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        \App\Models\Adoption::create([
            'user_id' => Auth::id(),
            'guinea_pig_id' => $guineaPig->id,
            'notes' => $request->notes,
        ]);

        return redirect()->route('dashboard')->with('success', 'Wniosek został wysłany!');
    }

    public function adminIndex()
    {
        $adoptions = \App\Models\Adoption::with(['user', 'guineaPig'])->get();
        return view('admin.adoptions.index', compact('adoptions'));
    }

    public function updateStatus(Request $request, \App\Models\Adoption $adoption)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $adoption->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $adoption->guineaPig->update(['status' => 'adopted']);
        }

        return back()->with('success', 'Status zaktualizowany!');
    }
}
