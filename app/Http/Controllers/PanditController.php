<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pandits.simple');
    }

    public function adminIndex()
    {
        $pandits = \App\Models\Pandit::with('user')->paginate(15);
        return view('admin.pandits.index', compact('pandits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function toggleVerify(string $id)
    {
        $pandit = \App\Models\Pandit::findOrFail($id);
        
        if ($pandit->verification_status === 'approved') {
            $pandit->verification_status = 'pending';
        } else {
            $pandit->verification_status = 'approved';
        }
        
        $pandit->save();
        return redirect()->back()->with('success', 'Pandit verification status updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pandit = \App\Models\Pandit::findOrFail($id);
        // Also delete user if it's explicitly a tied account, but let's just delete the pandit profile
        $pandit->delete();
        return redirect()->route('admin.pandits.index')->with('success', 'Pandit removed successfully.');
    }
}
