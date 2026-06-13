<?php

namespace App\Http\Controllers;

use App\Models\UserMarketing;
use Illuminate\Http\Request;

class UserMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userMarketings = UserMarketing::paginate(10);
        return view('user-marketings.index', compact('userMarketings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-marketings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_marketings,email',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        UserMarketing::create($validated);

        return redirect()->route('user_marketings.index')->with('success', 'User Marketing berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userMarketing = UserMarketing::findOrFail($id);
        return view('user-marketings.show', compact('userMarketing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userMarketing = UserMarketing::findOrFail($id);
        return view('user-marketings.edit', compact('userMarketing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userMarketing = UserMarketing::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_marketings,email,' . $id,
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $userMarketing->update($validated);

        return redirect()->route('user_marketings.index')->with('success', 'User Marketing berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userMarketing = UserMarketing::findOrFail($id);
        $userMarketing->delete();

        return redirect()->route('user_marketings.index')->with('success', 'User Marketing berhasil dihapus');
    }
}
