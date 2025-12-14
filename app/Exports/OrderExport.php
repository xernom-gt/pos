<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil semua data order
        return Order::all();
    }

    public function headings(): array
    {
        // Judul kolom di Excel
        return ["ID", "Invoice", "Total", "User ID", "Customer ID", "Created At", "Updated At"];
    }
}