<?php

namespace App\Exports;

use App\Models\Itempackage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemPackageExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Itempackage::select(
            'name',
            'price',
            'discount',
            'final_price',
            'days',
            'no_of_days',
            'item',
            'no_of_item',
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
            'Days Type',
            'No Of Days',
            'Item Type',
            'No Of Item',
            'Status',
            'Created At'
        ];
    }
}
