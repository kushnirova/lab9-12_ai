<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuineaPig;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuineaPigController extends Controller
{
    public function index()
    {
        $guineaPigs = GuineaPig::with('category')->latest()->paginate(10);
        return view('admin.guinea_pigs.index', compact('guineaPigs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.guinea_pigs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'status' => 'required|in:available,adopted,pending',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('guinea_pigs', 'public');
        }

        GuineaPig::create($validated);

        return redirect()->route('admin.guinea_pigs.index')->with('success', 'Świnka została dodana pomyślnie.');
    }

    public function edit(GuineaPig $guineaPig)
    {
        $categories = Category::all();
        return view('admin.guinea_pigs.edit', compact('guineaPig', 'categories'));
    }

    public function update(Request $request, GuineaPig $guineaPig)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'status' => 'required|in:available,adopted,pending',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($guineaPig->image_path) {
                Storage::disk('public')->delete($guineaPig->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('guinea_pigs', 'public');
        }

        $guineaPig->update($validated);

        return redirect()->route('admin.guinea_pigs.index')->with('success', 'Dane świnki zostały zaktualizowane.');
    }

    public function destroy(GuineaPig $guineaPig)
    {
        if ($guineaPig->image_path) {
            Storage::disk('public')->delete($guineaPig->image_path);
        }
        
        $guineaPig->delete();

        return redirect()->route('admin.guinea_pigs.index')->with('success', 'Świnka została usunięta.');
    }
}
