<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('userMarketing')->paginate(10);
        $userMarketings = \App\Models\UserMarketing::all();
        return view('products.index', compact('produk', 'userMarketings'));
    }

    public function create()
    {
        $userMarketings = \App\Models\UserMarketing::all();
        return view('products.create', compact('userMarketings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // ensure there is at least one UserMarketing in the system
        if (\App\Models\UserMarketing::count() === 0) {
            return redirect()->back()->withErrors(['user_marketing_id' => 'Belum ada User Marketing. Tambahkan dulu User Marketing.'])->withInput();
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = Produk::with('userMarketing')->findOrFail($id);
        return view('products.show', compact('produk'));
    }

    public function edit($id)
    {
        $item = Produk::findOrFail($id);
        $userMarketings = \App\Models\UserMarketing::all();
        return view('products.edit', compact('item', 'userMarketings'));
    }

    public function update(Request $request, $id)
    {
        $item = Produk::findOrFail($id);

        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $item->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        Produk::destroy($id);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}