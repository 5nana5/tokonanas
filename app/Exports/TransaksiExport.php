<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaksi::with(['userMarketing', 'customer', 'product'])
            ->get()
            ->map(function (Transaksi $transaksi) {
                return [
                    'ID' => $transaksi->id,
                    'User Marketing' => $transaksi->userMarketing?->name,
                    'Customer' => $transaksi->customer?->name,
                    'Product' => $transaksi->product?->name,
                    'Quantity' => $transaksi->quantity,
                    'Total Price' => $transaksi->total_price,
                    'Payment Status' => ucfirst($transaksi->payment_status),
                    'Transaction Date' => optional($transaksi->transaction_date)->format('Y-m-d H:i:s'),
                    'Notes' => $transaksi->notes,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Marketing',
            'Customer',
            'Product',
            'Quantity',
            'Total Price',
            'Payment Status',
            'Transaction Date',
            'Notes',
        ];
    }
}
