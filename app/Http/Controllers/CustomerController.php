<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UserMarketing;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('userMarketing')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userMarketings = UserMarketing::all();
        return view('customers.create', compact('userMarketings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        Customer::create($validated);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::with('userMarketing')->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        $userMarketings = UserMarketing::all();
        return view('customers.edit', compact('customer', 'userMarketings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $customer->update($validated);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus');
    }
}

