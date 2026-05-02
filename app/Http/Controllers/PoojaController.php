<?php

namespace App\Http\Controllers;

use App\Models\Pooja;
use Illuminate\Http\Request;

class PoojaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poojas = Pooja::where('is_active', true)->paginate(12);
        return view('poojas.index', compact('poojas'));
    }

    public function adminIndex()
    {
        $poojas = Pooja::paginate(15);
        return view('admin.poojas.index', compact('poojas'));
    }

    /**
     * Show the form for creating a new resource (Admin).
     */
    public function create()
    {
        $samagris = \App\Models\SamagriItem::where('is_active', true)->get();
        return view('admin.poojas.create', compact('samagris'));
    }

    /**
     * Store a newly created resource in storage (Admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'samagri' => 'array',
            'samagri.*' => 'exists:samagri_items,id'
        ]);

        $pooja = Pooja::create($request->except('samagri'));

        if ($request->has('samagri')) {
            $syncData = [];
            foreach ($request->samagri as $sam_id) {
                $syncData[$sam_id] = ['quantity' => 1, 'is_required' => true];
            }
            $pooja->samagriItems()->sync($syncData);
        }

        return redirect()->route('admin.poojas.index')->with('success', 'Pooja created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Try to find by ID or Slug
        $pooja = Pooja::with(['packages', 'samagriItems'])->where('id', $id)->orWhere('slug', $id)->firstOrFail();
        
        return view('poojas.show', compact('pooja'));
    }

    /**
     * Show the form for editing the specified resource (Admin).
     */
    public function edit(Pooja $pooja)
    {
        $samagris = \App\Models\SamagriItem::where('is_active', true)->get();
        return view('admin.poojas.edit', compact('pooja', 'samagris'));
    }

    /**
     * Update the specified resource in storage (Admin).
     */
    public function update(Request $request, Pooja $pooja)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'samagri' => 'array',
            'samagri.*' => 'exists:samagri_items,id'
        ]);

        $pooja->update($request->except('samagri'));

        if ($request->has('samagri')) {
            $syncData = [];
            foreach ($request->samagri as $sam_id) {
                $syncData[$sam_id] = ['quantity' => 1, 'is_required' => true];
            }
            $pooja->samagriItems()->sync($syncData);
        } else {
            $pooja->samagriItems()->detach();
        }

        return redirect()->route('admin.poojas.index')->with('success', 'Pooja updated successfully.');
    }

    /**
     * Remove the specified resource from storage (Admin).
     */
    public function destroy(Pooja $pooja)
    {
        $pooja->delete();
        return redirect()->route('admin.poojas.index')->with('success', 'Pooja deleted successfully.');
    }
}
