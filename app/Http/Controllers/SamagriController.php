<?php

namespace App\Http\Controllers;

use App\Models\SamagriItem;
use Illuminate\Http\Request;

class SamagriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $samagris = SamagriItem::paginate(15);
        return view('admin.samagri.index', compact('samagris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.samagri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'is_active' => 'boolean'
        ]);

        SamagriItem::create($request->all());

        return redirect()->route('admin.samagri.index')->with('success', 'Samagri item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $samagri = SamagriItem::findOrFail($id);
        return view('admin.samagri.edit', compact('samagri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $samagri = SamagriItem::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'is_active' => 'boolean'
        ]);

        $samagri->update($request->all());

        return redirect()->route('admin.samagri.index')->with('success', 'Samagri item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SamagriItem::findOrFail($id)->delete();
        return redirect()->route('admin.samagri.index')->with('success', 'Samagri item deleted successfully.');
    }
}
