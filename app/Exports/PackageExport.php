<?php

namespace App\Exports;

use App\Models\Adspackages;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackageExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Adspackages::select(
            'name',
            'price',
            'discount',
            'final_price',
            'days',
            'item_limit',
            'status',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Price',
            'Discount',
            'Final Price',
            'Days',
            'Item Limit',
            'Status',
            'Created At'
        ];
    }
}