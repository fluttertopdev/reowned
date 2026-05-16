<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('type', 'user')
            ->select('name', 'email', 'phone', 'status', 'address')
            ->whereNotNull('id_proof_front')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status',
            'Address'
        ];
    }
}