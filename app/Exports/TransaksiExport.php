<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class TransaksiExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStrictNullComparison
{
    protected $start;
    protected $end;

    public function __construct(?string $start = null, ?string $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function query()
    {
        $query = Transaksi::query()
            ->with(['userMarketing', 'customer', 'product'])
            ->select('transactions.*');

        if ($this->start) {
            $query->whereDate('transaction_date', '>=', $this->start);
        }
        if ($this->end) {
            $query->whereDate('transaction_date', '<=', $this->end);
        }

        return $query->orderBy('transaction_date', 'desc');
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->userMarketing->name ?? '',
            $transaksi->customer->name ?? '',
            $transaksi->product->name ?? '',
            $transaksi->quantity,
            $transaksi->total_price,
            $transaksi->payment_status,
            $transaksi->transaction_date ? $transaksi->transaction_date->format('Y-m-d H:i:s') : '',
            $transaksi->notes ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama User Marketing',
            'Nama Customer',
            'Nama Produk',
            'Jumlah',
            'Total Harga',
            'Status Pembayaran',
            'Tanggal Transaksi',
            'Catatan',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
