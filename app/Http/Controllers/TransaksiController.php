<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\UserMarketing;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['userMarketing', 'customer', 'product'])->paginate(10);
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        $userMarketings = UserMarketing::all();
        $customers = Customer::all();
        $produks = Produk::all();

        return view('transaksis.create', compact('userMarketings', 'customers', 'produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:pending,paid,cancelled',
            'transaction_date' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
        ]);

        $product = Produk::findOrFail($validated['product_id']);
        $validated['total_price'] = $product->price * $validated['quantity'];

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['userMarketing', 'customer', 'product'])->findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $userMarketings = UserMarketing::all();
        $customers = Customer::all();
        $produks = Produk::all();

        return view('transaksis.edit', compact('transaksi', 'userMarketings', 'customers', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'user_marketing_id' => 'required|exists:user_marketings,id',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:pending,paid,cancelled',
            'transaction_date' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
        ]);

        $product = Produk::findOrFail($validated['product_id']);
        $validated['total_price'] = $product->price * $validated['quantity'];

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new TransaksiExport(), 'transaksi.xlsx');
    }
}

